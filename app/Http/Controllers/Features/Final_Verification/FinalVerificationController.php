<?php

namespace App\Http\Controllers\Features\Final_Verification;

use App\Http\Controllers\Controller;
use App\Models\BudgetSubmission;
use App\Models\Cabinet;
use App\Models\Category;
use App\Models\DigitalArchive;
use App\Models\FundingSource;
use App\Models\Notification;
use App\Models\PaymentMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FinalVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $submit_sign = BudgetSubmission::where('is_archive', 0)->paginate(10, ['*'], 'submit_no_sign');
        $pengajuans = BudgetSubmission::where('requirements_status', 'Lengkap')
            ->where('verification_status', 1)
            ->paginate(10, ['*'], 'all_submit');

        return view('features.verifikasi_final.list_verifikasi_final', compact('pengajuans', 'submit_sign'));
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
        $pengajuan = BudgetSubmission::with('user')
            ->with('finance_officer')
            ->with('revenue_officer')
            ->where('id', $id)->first();
        $cabinets = Cabinet::all();
        $payment_method = PaymentMethod::all();
        $funding_source = FundingSource::all();
        return view('features.verifikasi_final.final_verifikasi_check', compact('pengajuan', 'cabinets', 'payment_method', 'funding_source'));
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
        // supaya tidak tabrakan
        $affected = BudgetSubmission::where('id', $id)
            ->where(function ($q) {
                $q->whereNull('revenue_officer_id')
                    ->orWhere('revenue_officer_id', Auth::id());
            })
            ->update([
                'revenue_officer_id' => Auth::id(),
            ]);

        if ($affected === 0) {
            return redirect()
                ->route('bendahara.dashboard')
                ->with('error', 'Pengajuan ini sudah ditanda tangan ni oleh bendahara lain');
        }

        // setting no kuitansi
        $pengajuan = BudgetSubmission::with('user')->with('finance_officer')->with('revenue_officer')->findOrFail($id);
        if (Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
            $filePathMetadata = Storage::disk('private')->path($pengajuan->path_file_requirements_status);
            $spreadsheet = IOFactory::load($filePathMetadata);
            $worksheet = $spreadsheet->getActiveSheet();
        }
        $worksheet->getCell('B4')->setValue("Nomor : {$request->kuitansi}");
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePathMetadata);

        // simpan file
        if ($request->hasFile('file_pengajuan')) {
            if (
                $pengajuan->path_file_submission && Storage::disk('private')->exists($pengajuan->path_file_submission)
            ) {
                Storage::disk('private')->delete($pengajuan->path_file_submission);
            }

            $file = $request->file('file_pengajuan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $sourcePath = $file->storeAs('pengajuan', $filename, 'private');
        } else {
            $sourcePath = $pengajuan->path_file_submission;
        }

        // === TAMBAH WATERMARK DENGAN NOMOR KUITANSI ===
        if (Storage::disk('private')->exists($sourcePath)) {
            $noKuitansi = $pengajuan->user->role . ' ' . $request->kuitansi;
            $this->addWatermarkWithKuitansiToPdf($sourcePath, $noKuitansi);
        }

        $payment = PaymentMethod::findOrFail($request->payment_method);
        $funding = FundingSource::findOrFail($request->funding_source);
        $year = now()->year;

        // ========== CARI CATEGORY ==========
        $category = Category::with('payment_method')->with('funding_source')
            ->where('cabinet_id', $request->cabinet_id)
            ->where('year', $year)
            ->whereRelation('payment_method', 'id', $payment->id)
            ->whereRelation('funding_source', 'id', $funding->id)
            ->first();

        $idcategory = $category?->id;

        // ========== VALIDASI ==========
        if (!$idcategory) {
            return redirect()->back()->with(
                'error',
                'Gagal mengarsipkan. Kategori arsip tidak ditemukan untuk Payment atau Funding.'
            );
        }

        // === COPY FILE KE FOLDER ARCHIVE ===
        if (Storage::disk('private')->exists($sourcePath)) {
            $newPath = 'archive/' . basename($sourcePath);
            Storage::disk('private')->copy($sourcePath, $newPath);
        } else {
            return redirect()->back()->with('error', 'File pengajuan tidak ditemukan');
        }

        //Notifikasi
        Notification::create([
            'user_id' => $pengajuan->user_id,
            'title' => 'Pengajuan Disetujui',
            'message' => 'Pengajuan Anda telah <span class="font-semibold text-green-600">lengkap dan ditandatangani Bendahara</span>.',
            'type' => 'success',
            'url' => route('submit.show', $pengajuan->id),
        ]);

        // create digital archive
        $digital = DigitalArchive::create([
            'category_id' => $idcategory,
            'archive_name' => $pengajuan->budget_submission_name,
            'from_division' => $pengajuan->user->role,
            'submiter_name' => $pengajuan->user->name,
            'finance_officer_name' => $pengajuan->finance_officer->name,
            'revenue_officer_name' => Auth::user()->name,
            'file_path_archive' => $newPath,
            'archive_code' => $request->kuitansi,
            'nominal' => $request->biaya,
            'archive_by' => Auth::user()->name,
            'disposal_date' => Carbon::now()->addYear(5),
            'no_spby' => $request->no_spby,
        ]);

        // === UPDATE DB ===
        $pengajuan->update([
            'revenue_officer_id' => Auth::id(),
            'path_file_submission' => $sourcePath,
            'assigned_payment_method' => $request->payment_method,
            'assigned_funding_source' => $request->funding_source,
            'is_archive'   => 1,
            'nominal' => $request->biaya,
            'digital_archive_id' => $digital->id,
        ]);

        return redirect()
            ->route('final.index')
            ->with('success', 'Berhasil verifikasi final pengajuan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function addWatermarkWithKuitansiToPdf(string $filePath, string $kuitansi)
    {
        if (!Storage::disk('private')->exists($filePath)) {
            Log::error('File PDF tidak ditemukan: ' . $filePath);
            throw new \Exception('File PDF tidak ditemukan');
        }

        $fullPath = Storage::disk('private')->path($filePath);

        // --- PROSES GHOSTSCRIPT (START) ---
        $tempFixedPath = $fullPath . '_fixed.pdf';
        $gsBinary = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'gswin64c' : 'gs';

        // Gunakan command yang sama agar coretan tetap muncul
        $command = "{$gsBinary} -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH " .
            "-dPreserveAnnots=false " .
            "-dShowAnnots=true " .
            "-dPDFSETTINGS=/prepress " .
            "-sOutputFile=" . escapeshellarg($tempFixedPath) . " " .
            escapeshellarg($fullPath) . " 2>&1";

        $output = shell_exec($command);

        if (file_exists($tempFixedPath)) {
            rename($tempFixedPath, $fullPath);
        } else {
            Log::error("Ghostscript Gagal. Output: " . $output);
        }
        // --- PROSES GHOSTSCRIPT (END) ---

        $mpdf = new Mpdf([
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

            // === GARIS MERAH SOLID DI KIRI ===
            // $mpdf->SetAlpha(0.5);
            // $mpdf->SetDrawColor(255, 0, 0);
            // $mpdf->SetLineWidth(0.5);
            // $mpdf->Line(5, 0, 5, $size['height']);
            // $mpdf->SetAlpha(1);

            // === NOMOR KUITANSI VERTIKAL BERULANG (90° ROTASI) DI ATAS GARIS MERAH ===
            $xKuitansi = 5; // Tepat di posisi garis merah (ditimpa)
            $yStart = 10;   // Mulai dari atas
            $spacing = 30;  // Jarak antar teks kuitansi (dalam mm)

            $mpdf->SetFont('Arial', 'B', 4); // Lebih kecil (dari 10 jadi 8)
            $mpdf->SetTextColor(0, 0, 0); // Hitam (dari merah jadi hitam)
            $mpdf->SetAlpha(0.8); // Opacity 80% (dari 0.7 jadi 0.8)

            // Hitung berapa kali perlu diulang berdasarkan tinggi halaman
            $repeatCount = ceil(($size['height'] - $yStart) / $spacing);

            for ($i = 0; $i < $repeatCount; $i++) {
                $yPosition = $yStart + ($i * $spacing);

                // Pastikan tidak melebihi tinggi halaman
                if ($yPosition > $size['height']) {
                    break;
                }

                // Rotate text 90 derajat
                $mpdf->Rotate(90, $xKuitansi, $yPosition);
                $mpdf->SetXY($xKuitansi, $yPosition);
                $mpdf->Cell(0, 0, $kuitansi, 0, 0, 'L');
                $mpdf->Rotate(0); // Reset rotation
            }

            $mpdf->SetAlpha(1);
            $mpdf->SetTextColor(0, 0, 0); // Reset warna
        }

        $mpdf->Output($fullPath, 'F');

        Log::info('Watermark dengan kuitansi PDF berhasil: ' . $filePath . ' | Kuitansi: ' . $kuitansi);
    }
}
