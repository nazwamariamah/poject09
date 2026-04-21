<?php

namespace App\Http\Controllers\Features\Pengajuan;

use App\Http\Controllers\Controller;
use App\Models\BudgetSubmission;
use App\Models\FundingSource;
use App\Models\Notification;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_method = PaymentMethod::all();
        $funding_source = FundingSource::all();
        return view('features.pengajuan.pengajuan', compact('payment_method', 'funding_source'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'file' => 'mimes:pdf|max:51200|nullable',
            'payment_method' => 'required|integer',
            'funding_source' => 'required|integer',
        ]);

        $iduser = Auth::id();
        $status_kelengkapan = 'Belum Diperiksa';

        // simpan file pdf pengajuan
        if (isset($request->file)) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('pengajuan', $filename, 'private');
        } else {
            $path = null;
        }

        // copy file checklist untuk kelengkapan pengajuan
        $fileName = 'Checklist_main.xlsx';
        $sourcePath = 'template/' . $fileName;

        // ubah spasi menjadi underscore
        $namaPengajuan = str_replace(' ', '_', $request->name);

        // nama file checklist
        $checkName = str_replace('_main', '', $fileName);
        $newFileName = time() . '_' . $namaPengajuan . '_' . $checkName;
        $destinationPath = 'metadata_pengajuan/' . $newFileName;

        // Cek apakah file source template checklist ada
        if (Storage::disk('private')->exists($sourcePath)) {

            // Pastikan folder tujuan ada
            $destinationDir = 'metadata_pengajuan';
            if (!Storage::disk('private')->exists($destinationDir)) {
                Storage::disk('private')->makeDirectory($destinationDir);
            }

            // Copy file
            Storage::disk('private')->copy($sourcePath, $destinationPath);
        }

        $pengajuan = BudgetSubmission::create([
            'user_id' => $iduser,
            'budget_submission_name' => $request->name,
            'assigned_payment_method' => $request->payment_method,
            'assigned_funding_source' => $request->funding_source,
            'path_file_submission' => $path,
            'requirements_status' => $status_kelengkapan,
            'verification_status' => 0,
            'path_file_requirements_status' => $destinationPath,
            'is_archive' => 0,
            'is_marked' => 0,
            'is_return' => 0,
            'message' => null,
        ]);

        // tambahan code
        $keuanganUsers = User::where('role', 'Keuangan')->get();

        $message = 'Ada pengajuan baru dari
        <span class="text-blue-600 font-bold">' . e($pengajuan->user->name) . '</span>
        (Divisi <span class="text-blue-600 font-bold">' . e($pengajuan->user->role) . '</span>) yang perlu diverifikasi.';
        foreach ($keuanganUsers as $user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Pengajuan Baru',
                'message' => $message,
                'type' => 'info',
                'url' => route('verification.show', $pengajuan->id),
            ]);
        }

        // untuk tulis nama pengajuan dalam metadata nya
        if (Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
            $filePathMetadata = Storage::disk('private')->path($pengajuan->path_file_requirements_status);
            $spreadsheet = IOFactory::load($filePathMetadata);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet->setCellValue("B3", 'Nama Kegiatan : ' . $request->name);
            $writer = new Xlsx($spreadsheet);
            $writer->save($filePathMetadata);
        }

        return redirect()->route('user.monitoring')->with('success', 'Berhasil Mengirim Pengajuan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment_method = PaymentMethod::all();
        $funding_source = FundingSource::all();
        $pengajuan = BudgetSubmission::with('finance_officer')->with('revenue_officer')
            ->with('payment_method')
            ->with('funding_source')
            ->findOrFail($id);

        if (Str::contains($pengajuan->path_file_requirements_status, 'CHECKLIST')) {
            // hapus file requirement sebelumnya
            if (Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
                Storage::disk('private')->delete($pengajuan->path_file_requirements_status);
            }

            // buat file baru
            // copy file checklist untuk kelengkapan pengajuan
            $fileName = 'Checklist_main.xlsx';
            $sourcePath = 'template/' . $fileName;

            // ubah spasi menjadi underscore
            $namaPengajuan = str_replace(' ', '_', $pengajuan->budget_submission_name);

            // nama file checklist
            $checkName = str_replace('_main', '', $fileName);
            $newFileName = time() . '_' . $namaPengajuan . '_' . $checkName;
            $destinationPath = 'metadata_pengajuan/' . $newFileName;

            // Cek apakah file source template checklist ada
            if (Storage::disk('private')->exists($sourcePath)) {

                // Pastikan folder tujuan ada
                $destinationDir = 'metadata_pengajuan';
                if (!Storage::disk('private')->exists($destinationDir)) {
                    Storage::disk('private')->makeDirectory($destinationDir);
                }

                // Copy file
                Storage::disk('private')->copy($sourcePath, $destinationPath);
            }

            $pengajuan->update([
                'path_file_requirements_status' => $destinationPath,
            ]);
        }

        if (Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
            $filePathMetadata = Storage::disk('private')->path($pengajuan->path_file_requirements_status);
            $spreadsheet = IOFactory::load($filePathMetadata);
            $worksheet = $spreadsheet->getActiveSheet();
        }

        $namaKegiatan = $worksheet->getCell('B3')->getValue();
        $no = $worksheet->getCell('B4')->getValue();

        $syaratDoc = [];
        $ada = [];
        $tidakada = [];
        $tidakperlu = [];
        $lengkap = [];
        $belum = [];
        $keterangan = [];

        $startCell = 7;
        $endCell = 36;

        for ($i = $startCell; $i <= $endCell; $i++) {
            $syaratDoc[] = $worksheet->getCell("C{$i}")->getValue();
            $ada[] = $worksheet->getCell("D{$i}")->getValue();
            $tidakada[] = $worksheet->getCell("E{$i}")->getValue();
            $tidakperlu[] = $worksheet->getCell("F{$i}")->getValue();
            $lengkap[] = $worksheet->getCell("G{$i}")->getValue();
            $belum[] = $worksheet->getCell("H{$i}")->getValue();
            $keterangan[] = $worksheet->getCell("I{$i}")->getValue();
        }


        $catatan = $worksheet->getCell('B40')->getValue();

        return view("features.pengajuan.pengajuan-show", compact('pengajuan', 'namaKegiatan', 'no', 'syaratDoc', 'ada', 'tidakada', 'tidakperlu', 'lengkap', 'belum', 'keterangan', 'catatan', 'payment_method', 'funding_source'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengajuan = BudgetSubmission::findOrFail($id);
        $payment_method = PaymentMethod::all();
        $funding_source = FundingSource::all();
        return view('features.pengajuan.pengajuan-edit', compact('pengajuan', 'payment_method', 'funding_source'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengajuan = BudgetSubmission::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
            'file' => 'mimes:pdf|max:50000|nullable',
        ]);

        if ($request->file) {
            if ($pengajuan->path_file_submission && Storage::disk('private')->exists($pengajuan->path_file_submission)) {
                Storage::disk('private')->delete($pengajuan->path_file_submission);

                $file = $request->file;
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('pengajuan', $fileName, 'private');
            }
        } else {
            $path = $pengajuan->path_file_submission;
        }

        $fileName = 'Checklist_main.xlsx';
        $sourcePath = 'template/' . $fileName;

        // ubah spasi menjadi underscore
        $namaPengajuan = str_replace(' ', '_', $request->name);

        // nama file checklist
        $checkName = str_replace('_main', '', $fileName);
        $newFileName = time() . '_' . $namaPengajuan . '_' . $checkName;
        $destinationPath = 'metadata_pengajuan/' . $newFileName;

        // rename file requirements checklist
        if ($pengajuan->path_file_requirements_status && Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
            Storage::disk('private')->move($pengajuan->path_file_requirements_status, $destinationPath);
        }

        $pengajuan->update([
            'budget_submission_name' => $request->name,
            'assigned_payment_method' => $request->payment_method,
            'assigned_funding_source' => $request->funding_source,
            'path_file_submission' => $path,
            'path_file_requirements_status' => $destinationPath,
        ]);

        return redirect()->route('user.monitoring')->with('success', 'Berhasil Mengupdate Pengajuan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengajuan = BudgetSubmission::findOrFail($id);

        if (Storage::disk('private')->exists($pengajuan->path_file_submission) && $pengajuan->path_file_submission) {
            Storage::disk('private')->delete($pengajuan->path_file_submission);
        }

        if (Storage::disk('private')->exists($pengajuan->path_file_requirements_status) && $pengajuan->path_file_requirements_status) {
            Storage::disk('private')->delete($pengajuan->path_file_requirements_status);
        }

        $pengajuan->delete();

        return redirect()->route('user.monitoring')->with('success', 'Berhasil Menghapus Pengajuan');
    }
}
