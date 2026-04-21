<?php

namespace App\Http\Controllers\Features\Verifikasi;

use App\Http\Controllers\Controller;
use App\Models\BudgetSubmission;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_submit = BudgetSubmission::latest()->paginate(10, ['*'], 'all_submit');
        $not_check_submit = BudgetSubmission::where('requirements_status', 'Belum Diperiksa')->latest()->paginate('10', ['*'], 'not_check');
        $my_proses = BudgetSubmission::where('requirements_status', 'Belum Lengkap')
            ->where('verification_status', 0)
            ->where('finance_officers_id', Auth::id())->latest()
            ->paginate(5, ['*'], 'my_proses');

        return view('features.verifikasi.list_verifikasi', compact('all_submit', 'not_check_submit', 'my_proses'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengajuan = BudgetSubmission::findOrFail($id);

        // apakah file nya versi lama atau tidak
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
        $noKuitansi = $worksheet->getCell('B4')->getValue();

        $startCell = 7;
        $endCell = 36;

        $syaratDoc = [];
        $ada = [];
        $tidakada = [];
        $tidakperlu = [];
        $lengkap = [];
        $belum = [];
        $keterangan = [];

        for ($i = $startCell; $i <= $endCell; $i++) {
            $syaratDoc[] = $worksheet->getCell("C{$i}")->getValue();

            // auto checklist
            if (
                $worksheet->getCell("D{$i}")->getValue() === null &&
                $worksheet->getCell("E{$i}")->getValue() === null &&
                $worksheet->getCell("F{$i}")->getValue() === null
            ) {
                $worksheet->setCellValue("D{$i}", 'Y');
                $writer = new Xlsx($spreadsheet);
                $writer->save($filePathMetadata);
            }

            if (
                $worksheet->getCell("G{$i}")->getValue() === null &&
                $worksheet->getCell("H{$i}")->getValue() === null
            ) {
                $worksheet->setCellValue("G{$i}", 'Y');
                $writer = new Xlsx($spreadsheet);
                $writer->save($filePathMetadata);
            }

            $ada[] = $worksheet->getCell("D{$i}")->getValue();
            $tidakada[] = $worksheet->getCell("E{$i}")->getValue();
            $tidakperlu[] = $worksheet->getCell("F{$i}")->getValue();
            $lengkap[] = $worksheet->getCell("G{$i}")->getValue();
            $belum[] = $worksheet->getCell("H{$i}")->getValue();
            $keterangan[] = $worksheet->getCell("I{$i}")->getValue();
        }

        $catatan = $worksheet->getCell('B40')->getValue();

        return view('features.verifikasi.check-pengajuan', compact('pengajuan', 'namaKegiatan', 'noKuitansi', 'syaratDoc', 'ada', 'tidakada', 'tidakperlu', 'lengkap', 'belum', 'keterangan', 'catatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // agar tidak tabrakan
        $affected = BudgetSubmission::where('id', $id)
            ->where(function ($q) {
                $q->whereNull('finance_officers_id')
                    ->orWhere('finance_officers_id', Auth::id());
            })
            ->update([
                'finance_officers_id' => Auth::id(),
            ]);

        if ($affected === 0) {
            return redirect()
                ->route('keuangan.dashboard')
                ->with('error', 'Pengajuan ini sedang diperiksa oleh petugas keuangan lain');
        }

        $pengajuan = BudgetSubmission::with('user')->with('finance_officer')->findOrFail($id);

        if (Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
            $filePathMetadata = Storage::disk('private')->path($pengajuan->path_file_requirements_status);
            $spreadsheet = IOFactory::load($filePathMetadata);
            $worksheet = $spreadsheet->getActiveSheet();
        }

        $startCell = 7;
        $endCell = 36;
        $syaratDoc = [];

        for ($i = 0; $startCell <= $endCell; $i++) {

            // baca syarat doc
            $syaratDoc[] = $worksheet->getCell("C{$startCell}")->getValue();

            $ada =  $request->ada[$i] ?? null;
            $ttd =  $request->ttd[$i] ?? null;
            $ket =  $request->keterangan[$i] ?? null;

            $worksheet->setCellValue("D{$startCell}", ($ada == 1) ? 'Y' : '');
            $worksheet->setCellValue("E{$startCell}", ($ada == 0) ? 'Y' : '');
            $worksheet->setCellValue("F{$startCell}", ($ada == 2) ? 'Y' : '');

            $worksheet->setCellValue("G{$startCell}", ($ttd == 1) ? 'Y' : '');
            $worksheet->setCellValue("H{$startCell}", ($ttd == 0) ? 'Y' : '');

            $worksheet->setCellValue("I{$startCell}", $ket);

            $startCell++;
        }

        $worksheet->setCellValue("B41", $request->catatan);

        // save jika sudah ditulis
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePathMetadata);

        $startCekCell = 7;
        $endCekCell = 36;
        $status_lengkap = '';
        $status_verifikasi = false;

        for ($i = $startCekCell; $i <= $endCekCell; $i++) {

            $valueADA = $worksheet->getCell("D{$i}")->getValue();
            $valueADAtidakperlu = $worksheet->getCell("F{$i}")->getValue();
            $valueLengkap = $worksheet->getCell("G{$i}")->getValue();

            if ($valueADAtidakperlu === 'Y') {
                $status_lengkap = 'Lengkap';
                $status_verifikasi = true;
                // $is_marked = 1;
            } else {
                if ($valueADA === '' || $valueADA === null) {
                    $status_lengkap = 'Belum Lengkap';
                    $status_verifikasi = false;
                    // $is_marked = 0;
                    break;
                }
                if ($valueLengkap === '' || $valueLengkap === null) {
                    $status_lengkap = 'Belum Lengkap';
                    $status_verifikasi = false;
                    // $is_marked = 0;
                    break;
                }
            }
            $status_lengkap = 'Lengkap';
            // $is_marked = 1;
            $status_verifikasi = true;
        }

        if (
            $pengajuan->path_file_submission &&
            Storage::disk('private')->exists($pengajuan->path_file_submission) &&
            $status_lengkap == 'Lengkap' &&
            $status_verifikasi
            // $is_marked
        ) {
            $sourcePath = $pengajuan->path_file_submission;
            // === TAMBAH WATERMARK ===
            $this->addWatermarkToPdf($sourcePath);

            // $sendername = $pengajuan->user->role;
            // $senderemail = $pengajuan->user->role;
            // $senderdivisi = $pengajuan->user->role;
            // $senderverifikator = $pengajuan->finance_officer->name;
            // $senderverifikatoremail = $pengajuan->finance_officer->email;

            // $bendahara = User::where('role', 'Bendahara')->get();

            // FacadesNotification::send($bendahara, new BudgetSubmitToBendaharaNotification($sendername, $senderemail, $senderdivisi, $senderverifikator, $senderverifikatoremail));
        } else {
            // $senderverifikator = $pengajuan->finance_officer->name;
            // $senderverifikatoremail = $pengajuan->finance_officer->email;
            // $userPengajuan = User::where('id', $pengajuan->user_id)->where('name', $pengajuan->user->name)->where('email', $pengajuan->user->email);
            // FacadesNotification::send($userPengajuan, new BudgetSubmitToReturnNotification($senderverifikator, $senderverifikatoremail));
        }

        $pengajuan->update([
            'finance_officers_id' => Auth::user()->id,
            'message' => $request->catatan,
            'requirements_status' => $status_lengkap,
            'verification_status' => $status_verifikasi,
            'is_marked' => ($status_lengkap == 'Lengkap' && $status_verifikasi == 1 ? 1 : 0),
            'is_return' => ($status_lengkap == 'Lengkap' && $status_verifikasi == 1 ? 0 : 1),
        ]);

        // === NOTIFIKASI SETELAH VERIFIKASI KEUANGAN ===
        if ($status_verifikasi === false) {

            // ke USER
            Notification::create([
                'user_id' => $pengajuan->user_id,
                'title' => 'Pengajuan Dikembalikan',
                'message' => 'Pengajuan Anda perlu perbaikan dokumen.',
                'type' => 'warning',
                'url' => route('submit.show', $pengajuan->id),
            ]);
        } else {

            Notification::create([
                'user_id' => $pengajuan->user_id,
                'title' => 'Berkas Diverifikasi Keuangan',
                'message' => 'Berkas pengajuan Anda telah <span class="font-semibold text-blue-600">diverifikasi oleh Keuangan</span> dan siap ke tahap berikutnya.',
                'type' => 'success',
                'url' => route('submit.show', $pengajuan->id),
            ]);

            // ke BENDAHARA
            $bendaharaUsers = User::where('role', 'Bendahara')->get();

            foreach ($bendaharaUsers as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Pengajuan Siap Diverifikasi',
                    'message' => 'Pengajuan "' . $pengajuan->pengajuan_name . '" siap ditandatangani.',
                    'type' => 'success',
                    'url' => route('final.show', $pengajuan->id),
                ]);
            }
        }

        return redirect()->route('verification.index')->with('success', 'Berhasil kirim tanggapan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function addWatermarkToPdf(string $filePath)
    {
        if (!Storage::disk('private')->exists($filePath)) {
            Log::error('File PDF tidak ditemukan: ' . $filePath);
            throw new \Exception('File PDF tidak ditemukan');
        }

        $fullPath = Storage::disk('private')->path($filePath);

        // --- PROSES GHOSTSCRIPT (START) ---
        $tempFixedPath = $fullPath . '_fixed.pdf';
        $gsBinary = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'gswin64c' : 'gs';

        // Command Flattening: Menyatukan coretan/TTD agar tidak hilang saat versi turun
        $command = "{$gsBinary} -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH " .
            "-dPreserveAnnots=false " .    // Meratakan coretan ke background
            "-dShowAnnots=true " .         // Tampilkan coretan sebelum diratakan
            "-dPDFSETTINGS=/prepress " .   // Kualitas tinggi untuk TTD
            "-sOutputFile=" . escapeshellarg($tempFixedPath) . " " .
            escapeshellarg($fullPath) . " 2>&1";

        $output = shell_exec($command);

        if (file_exists($tempFixedPath)) {
            rename($tempFixedPath, $fullPath);
            Log::info("Ghostscript Berhasil meratakan layer & merubah versi ke 1.4");
        } else {
            Log::error("Ghostscript Gagal. Output: " . $output);
            throw new \Exception("Gagal memproses PDF: " . $output);
        }
        // --- PROSES GHOSTSCRIPT (END) ---

        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => storage_path('app/mpdf'),
        ]);

        // === LOAD FILE PDF ASLI ===
        $pageCount = $mpdf->SetSourceFile($fullPath);


        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

            $tplId = $mpdf->ImportPage($pageNo);
            $size  = $mpdf->getTemplateSize($tplId);

            $mpdf->AddPageByArray([
                'orientation' => $size['orientation'],
                'width'       => $size['width'],
                'height'      => $size['height'],
            ]);

            $mpdf->UseTemplate($tplId);

            // === GARIS MERAH SOLID DI KIRI (LEBIH TIPIS + OPACITY 50%) ===
            $mpdf->SetAlpha(0.5); // Opacity 50%
            $mpdf->SetDrawColor(255, 0, 0); // Merah
            $mpdf->SetLineWidth(0.5); // Lebih tipis (dari 2 jadi 0.5)
            $mpdf->Line(5, 0, 5, $size['height']);
            $mpdf->SetAlpha(1); // Reset opacity

            // === WATERMARK GAMBAR (60% HALAMAN, CENTER, OPACITY 50%) ===
            $watermarkPath = storage_path('app/public/images/watermark.png');

            if (file_exists($watermarkPath)) {

                [$imgW, $imgH] = getimagesize($watermarkPath);
                $imgRatio = $imgW / $imgH;

                // Target maksimum 60% halaman (dari 80% jadi 60%)
                $maxW = $size['width'] * 0.6;
                $maxH = $size['height'] * 0.6;

                // Hitung ukuran dengan menjaga rasio
                if ($maxW / $maxH > $imgRatio) {
                    // tinggi pembatas
                    $wmHeight = $maxH;
                    $wmWidth  = $wmHeight * $imgRatio;
                } else {
                    // lebar pembatas
                    $wmWidth  = $maxW;
                    $wmHeight = $wmWidth / $imgRatio;
                }

                // Center posisi
                $x = ($size['width']  - $wmWidth)  / 2;
                $y = ($size['height'] - $wmHeight) / 2;

                $mpdf->SetAlpha(0.2); // Opacity 50% (dari 0.2 jadi 0.5)
                $mpdf->Image($watermarkPath, $x, $y, $wmWidth, $wmHeight);
                $mpdf->SetAlpha(1); // Reset opacity
            }
        }

        $mpdf->Output($fullPath, 'F');

        Log::info('Watermark PDF berhasil: ' . $filePath);
    }
}
