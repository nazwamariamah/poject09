<?php

namespace App\Http\Controllers\Features\PPSPM_Verification;

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

class PPSPMVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $submit_sign = BudgetSubmission::where('is_archive', 0)->paginate(10, ['*'], 'submit_no_sign');
        $my_proses = BudgetSubmission::where('requirements_status', 'Belum Lengkap')
            ->where('verification_status', 0)
            ->where('finance_officers_id', Auth::id())->latest()
            ->paginate(5, ['*'], 'my_proses');
        $pengajuans = BudgetSubmission::latest()->paginate(10, ['*'], 'all_submit');
        return view('features.verifikasi_ppspm.list_verifikasi_ppspm', compact('pengajuans', 'my_proses'));
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
        $doc = BudgetSubmission::with('user')->findOrFail($id);
        $payment_method = PaymentMethod::all();
        $funding_source = FundingSource::all();
        $cabinets = Cabinet::all();
        return view('features.verifikasi_ppspm.ppspm_verifikasi_check', compact('doc', 'payment_method', 'funding_source', 'cabinets'));
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
    public function update(Request $request, string $id) // untuk bagian verifikasi
    {
        $doc = BudgetSubmission::findOrFail($id);
        // $payment = PaymentMethod::findOrFail($request->payment_method);
        // $funding = FundingSource::findOrFail($request->funding_source);

        if ($request->hasFile('file_pengajuan')) {
            $request->validate([
                'file_pengajuan' => 'mimes:pdf|max:51200|nullable',
            ]);

            if ($doc->path_file_submission && Storage::disk('private')->exists($doc->path_file_submission)) {

                Storage::disk('private')->delete($doc->path_file_submission);

                $file = $request->file('file_pengajuan');
                $fileName = time() . ' ' . $file->getClientOriginalName();
                $path = $file->storeAs('pengajuan', $fileName, 'private');
            }
        } else {
            $path = $doc->path_file_submission;
        }

        // === TAMBAH WATERMARK DENGAN NOMOR KUITANSI ===
        if (Storage::disk('private')->exists($path)) {
            $noKuitansi = $doc->user->role . ' ' . $request->kuitansi;
            $this->addWatermarkWithKuitansiToPdf($path, $noKuitansi);
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
        if (Storage::disk('private')->exists($path)) {
            $newPath = 'archive/' . basename($path);
            Storage::disk('private')->copy($path, $newPath);
        } else {
            return redirect()->back()->with('error', 'File pengajuan tidak ditemukan');
        }

        //Notifikasi
        Notification::create([
            'user_id' => $doc->user_id,
            'title' => 'Pengajuan Disetujui',
            'message' => 'Pengajuan Anda telah <span class="font-semibold text-green-600">lengkap dan ditandatangani Bendahara</span>.',
            'type' => 'success',
            'url' => route('submit.show', $doc->id),
        ]);

        // digital arsip
        // create digital archive
        $digital = DigitalArchive::create([
            'category_id' => $idcategory,
            'archive_name' => $doc->budget_submission_name,
            'from_division' => $doc->user->role,
            'submiter_name' => $doc->user->name,
            'finance_officer_name' => Auth::user()->name,
            'revenue_officer_name' => Auth::user()->name,
            'file_path_archive' => $newPath,
            'archive_code' => $request->kuitansi,
            'nominal' => $request->biaya,
            'archive_by' => Auth::user()->name,
            'disposal_date' => Carbon::now()->addYear(5),
            'no_spby' => $request->no_spby,
        ]);

        $doc->update([
            'revenue_officer_id' => Auth::id(),
            'path_file_submission' => $path,
            'assigned_payment_method' => $request->payment_method,
            'assigned_funding_source' => $request->funding_source,
            'verification_status' => 1,
            'requirements_status' => 'Lengkap',
            'nominal' => $request->biaya,
            'is_archive' => 1,
            'digital_archive_id' => $digital->id,
        ]);

        return redirect()->route('validation.index')->with('success', 'Berhasil kirim tanggapan');
    }

    public function return(string $id) // kembalikan dokumen
    {
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

        $doc = BudgetSubmission::findOrFail($id);
        $doc->update([
            'finance_officers_id' => Auth::user()->id,
            // 'message' => $request->catatan,
            'requirements_status' => 'Belum Lengkap',
            'verification_status' => 0,
            'is_marked' => 0,
            'is_return' => 1,
        ]);

        Notification::create([
            'user_id' => $doc->user_id,
            'title' => 'Dokumen Dikembalikan',
            'message' => 'Dokumen Anda perlu perbaikan dokumen.',
            'type' => 'warning',
            'url' => route('submit.show', $doc->id),
        ]);

        return redirect()->route('validation.index')->with('success', 'Berhasil kirim tanggapan');
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

            // === GARIS MERAH SOLID DI KIRI (LEBIH TIPIS + OPACITY 50%) ===
            $mpdf->SetAlpha(0.5); // Opacity 50%
            $mpdf->SetDrawColor(255, 0, 0); // Merah
            $mpdf->SetLineWidth(0.5); // Lebih tipis (dari 2 jadi 0.5)
            $mpdf->Line(5, 0, 5, $size['height']);
            $mpdf->SetAlpha(1); // Reset opacity

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

            $mpdf->SetAlpha(1);
            $mpdf->SetTextColor(0, 0, 0); // Reset warna
        }

        $mpdf->Output($fullPath, 'F');

        Log::info('Watermark dengan kuitansi PDF berhasil: ' . $filePath . ' | Kuitansi: ' . $kuitansi);
    }
}
