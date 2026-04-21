<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BudgetSubmission;
use App\Models\Category;
use App\Models\DigitalArchive;
use App\Models\FundingSource;
use App\Models\PaymentMethod;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\BudgetSubmitToArchiveNotification;
use App\Notifications\BudgetSubmitToBendaharaNotification;
use App\Notifications\BudgetSubmitToKeuanganNotification;
use App\Notifications\BudgetSubmitToRepairedNotification;
use App\Notifications\BudgetSubmitToReturnNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;

class BudgetSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // tidak dipakai lagi
    {
        // $users = User::where('role', 'Bendahara')->get();
        $payment_method = PaymentMethod::all();
        $funding_source = FundingSource::all();
        return view('user.pengajuan.pengajuan', compact('payment_method', 'funding_source'));
    }

    public function update_check(Request $request, $id) // tidak dipakai lagi
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

        $pengajuan = BudgetSubmission::with('user')->with('finance_officer')->findOrFail($id);
        // if (
        //     $pengajuan->finance_officer->id != null &&
        //     $pengajuan->finance_officer->name != Auth::user()->name &&
        //     $pengajuan->finance_officer->email != Auth::user()->email
        // ) {
        //     return redirect()->route('keuangan.dashboard')->with('error', 'Pengajuan ini sudah diperiksa oleh petugas keuangan lain!!');
        // }

        // $pengajuan->update([
        //     'finance_officers_id' => Auth::id(),
        // ]);

        if (Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
            $filePathMetadata = Storage::disk('private')->path($pengajuan->path_file_requirements_status);
            $spreadsheet = IOFactory::load($filePathMetadata);
            $worksheet = $spreadsheet->getActiveSheet();
        }

        $index = 0;      // mengikuti array dari Blade
        $startCell = 7;
        // $endCell = 36;
        $currentRow = $startCell;
        $maxRows = 100;

        $syaratDoc = [];
        while (count($syaratDoc) < 30 && $currentRow < $maxRows) {
            $datasyarat = $worksheet->getCell("C{$currentRow}")->getValue();

            // Cek apakah cell C kosong (baik null, spasi, atau empty string)
            if ($datasyarat !== null && trim($datasyarat) !== '') {
                $syaratDoc[] = $datasyarat;

                $ada = $request->ada[$index] ?? null;
                $ttd = $request->ttd[$index] ?? null;
                $ket = $request->keterangan[$index] ?? '';

                $worksheet->setCellValue("D{$currentRow}", ($ada == 1) ? 'Y' : '');
                $worksheet->setCellValue("E{$currentRow}", ($ada == 0) ? 'Y' : '');
                $worksheet->setCellValue("F{$currentRow}", ($ada == 2) ? 'Y' : '');

                $worksheet->setCellValue("G{$currentRow}", ($ttd == 1) ? 'Y' : '');
                $worksheet->setCellValue("H{$currentRow}", ($ttd == 0) ? 'Y' : '');

                $worksheet->setCellValue("I{$currentRow}", $ket);

                // $syaratDoc[] = $datasyarat;
                // $ada[] = $worksheet->getCell("D{$currentRow}")->getValue();
                // $tidakada[] = $worksheet->getCell("E{$currentRow}")->getValue();
                // $tidakperlu[] = $worksheet->getCell("F{$currentRow}")->getValue();
                // $lengkap[] = $worksheet->getCell("G{$currentRow}")->getValue();
                // $belum[] = $worksheet->getCell("H{$currentRow}")->getValue();
                // $keterangan[] = $worksheet->getCell("I{$currentRow}")->getValue();
            }

            $index++;
            $currentRow++;
        }

        $worksheet->setCellValue("B41", $request->catatan);

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePathMetadata);

        // while ($row <= $endRow) {
        //     if($row == 21){
        //         $row++;
        //         continue;
        //     }

        //     $ada = $request->ada[$index] ?? null;
        //     $ttd = $request->ttd[$index] ?? null;
        //     $ket = $request->keterangan[$index] ?? '';

        //     // D = Ada
        //     // E = Tidak Ada
        //     // F = TTD Lengkap
        //     // G = TTD Belum
        //     // H = Keterangan

        //     $worksheet->setCellValue("D{$row}", ($ada == 1) ? 'Y' : '');
        //     $worksheet->setCellValue("E{$row}", ($ada == 0) ? 'Y' : '');
        //     $worksheet->setCellValue("F{$row}", ($ada == 2) ? 'Y' : '');

        //     $worksheet->setCellValue("G{$row}", ($ttd == 1) ? 'Y' : '');
        //     $worksheet->setCellValue("H{$row}", ($ttd == 0) ? 'Y' : '');

        //     $worksheet->setCellValue("I{$row}", $ket);

        //     // NEXT
        //     $row++;
        //     $index++;
        // }


        // check kondisi kelengkapan
        $startCell = 7;
        // $endCell = 36;
        $currentRow = $startCell;
        $maxRows = 100;
        $status_lengkap = false;

        $syaratDocAgain = [];
        while (count($syaratDocAgain) < 30 && $currentRow < $maxRows) {
            $datasyarat = $worksheet->getCell("C{$currentRow}")->getValue();

            // Cek apakah cell C kosong (baik null, spasi, atau empty string)
            if ($datasyarat !== null && trim($datasyarat) !== '') {
                $syaratDocAgain[] = $datasyarat;

                $valueADA = $worksheet->getCell("D{$currentRow}")->getValue();
                $valueADAtidakperlu = $worksheet->getCell("F{$currentRow}")->getValue();
                $valueLengkap = $worksheet->getCell("G{$currentRow}")->getValue();

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

                // $ada = $request->ada[$index] ?? null;
                // $ttd = $request->ttd[$index] ?? null;
                // $ket = $request->keterangan[$index] ?? '';

                // $worksheet->setCellValue("D{$currentRow}", ($ada == 1) ? 'Y' : '');
                // $worksheet->setCellValue("E{$currentRow}", ($ada == 0) ? 'Y' : '');
                // $worksheet->setCellValue("F{$currentRow}", ($ada == 2) ? 'Y' : '');

                // $worksheet->setCellValue("G{$currentRow}", ($ttd == 1) ? 'Y' : '');
                // $worksheet->setCellValue("H{$currentRow}", ($ttd == 0) ? 'Y' : '');

                // $worksheet->setCellValue("I{$currentRow}", $ket);

                // $syaratDoc[] = $datasyarat;
                // $ada[] = $worksheet->getCell("D{$currentRow}")->getValue();
                // $tidakada[] = $worksheet->getCell("E{$currentRow}")->getValue();
                // $tidakperlu[] = $worksheet->getCell("F{$currentRow}")->getValue();
                // $lengkap[] = $worksheet->getCell("G{$currentRow}")->getValue();
                // $belum[] = $worksheet->getCell("H{$currentRow}")->getValue();
                // $keterangan[] = $worksheet->getCell("I{$currentRow}")->getValue();
            }

            // $index++;
            $currentRow++;
        }

        // while ($row <= $endRow) {
        //     if($row == 21){
        //         $row++;
        //         continue;
        //     }
        //     $valueADA = $worksheet->getCell("D{$row}")->getValue();
        //     $valueADAtidakperlu = $worksheet->getCell("F{$row}")->getValue();
        //     $valueLengkap = $worksheet->getCell("G{$row}")->getValue();

        //     if ($valueADAtidakperlu === 'Y') {
        //         $status_lengkap = 'Lengkap';
        //         $status_verifikasi = true;
        //     } else {
        //         if ($valueADA === '' || $valueADA === null) {
        //             $status_lengkap = 'Belum Lengkap';
        //             $status_verifikasi = false;
        //             break;
        //         }
        //         if ($valueLengkap === '' || $valueLengkap === null) {
        //             $status_lengkap = 'Belum Lengkap';
        //             $status_verifikasi = false;
        //             break;
        //         }
        //     }
        //     $status_lengkap = 'Lengkap';
        //     $status_verifikasi = true;

        //     $row++;
        // }

        // === TENTUKAN FILE SOURCE ===
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
                'url' => route('pengajuan.show', $pengajuan->id),
            ]);
        } else {

            Notification::create([
                'user_id' => $pengajuan->user_id,
                'title' => 'Berkas Diverifikasi Keuangan',
                'message' => 'Berkas pengajuan Anda telah <span class="font-semibold text-blue-600">diverifikasi oleh Keuangan</span> dan siap ke tahap berikutnya.',
                'type' => 'success',
                'url' => route('pengajuan.show', $pengajuan->id),
            ]);

            // ke BENDAHARA
            $bendaharaUsers = User::where('role', 'Bendahara')->get();

            foreach ($bendaharaUsers as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Pengajuan Siap Diverifikasi',
                    'message' => 'Pengajuan "' . $pengajuan->pengajuan_name . '" siap ditandatangani.',
                    'type' => 'success',
                    'url' => route('bendahara.sign', $pengajuan->id),
                ]);
            }
        }

        return redirect()->route('keuangan.pengajuan')->with('success', 'Berhasil kirim tanggapan');
    }


    private function addWatermarkToPdf(string $filePath) // tidak dipakai lagi
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

    public function perbaikan(Request $request, $id) // tidak dipakai lagi
    {
        $pengajuan = BudgetSubmission::with('user')->with('finance_officer')->findOrFail($id);
        $request->validate([
            'file_pengajuan' => 'mimes:pdf|max:20480|nullable',
        ]);

        if ($request->file_pengajuan) {
            if ($pengajuan->path_file_submission && Storage::disk('private')->exists($pengajuan->path_file_submission)) {
                Storage::disk('private')->delete($pengajuan->path_file_submission);

                $file = $request->file('file_pengajuan');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('pengajuan', $filename, 'private');
            }
        } else {
            $path = $pengajuan->path_file_submission;
        }

        // $fileName = 'CHECKLIST.xlsx';
        // $sourcePath = 'template/' . $fileName;
        // // ubah spasi menjadi underscore
        // $namaPengajuan = str_replace(' ', '_', $request->nama_pengajuan);
        // $newFileName = $namaPengajuan . '_' . $fileName;
        // $destinationPath = 'metadata_pengajuan/' . $newFileName;

        // if ($pengajuan->path_file_status_kelengkapan && Storage::disk('public')->exists($pengajuan->path_file_status_kelengkapan)) {
        //     Storage::disk('public')->move($pengajuan->path_file_status_kelengkapan, $destinationPath);
        // }

        // $sendername = User::where('id', $pengajuan->user_id)->where('name', $pengajuan->user->name)->first();
        // $senderemail = User::where('id', $pengajuan->user_id)->where('email', $pengajuan->user->email)->first();
        // $senderdivisi = User::where('id', $pengajuan->user_id)->where('role', $pengajuan->user->role)->first();

        // $receivername = User::where('id', $pengajuan->finance_officers_id)->where('name', $pengajuan->finance_officer->name)->first();
        // $receiveremail = User::where('id', $pengajuan->finance_officers_id)->where('role', $pengajuan->finance_officer->email)->first();
        // $receiver = User::where('id', $pengajuan->finance_officers_id)->first();

        // FacadesNotification::send($receiver, new BudgetSubmitToRepairedNotification($sendername, $senderemail, $senderdivisi, $receivername, $receiveremail));

        $pengajuan->update([
            'path_file_submission' => $path,
            'assigned_payment_method' => $request->payment_method,
            'assigned_funding_source' => $request->funding_source,
            'is_marked' => 0,
            'is_return' => 0,
            // 'path_file_status_kelengkapan' => $destinationPath,
        ]);

        // tambahan code
        $keuanganUsers = User::where('role', 'Keuangan')->get();

        foreach ($keuanganUsers as $user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Pengajuan Diperbarui',
                'message' => 'Pengajuan yang sebelumnya gagal telah diperbarui oleh pengaju.',
                'type' => 'warning',
                'url' => route('keuangan.check', $pengajuan->id),
            ]);
        }

        return redirect()->route('user.worklist')->with('success', 'Berhasil Mengirim Pengajuan');
    }

    public function download_pengajuan($id) // tidak dipakai lagi
    {
        $file_metadata = BudgetSubmission::findOrFail($id);

        $path = Storage::disk('private')->path($file_metadata->path_file_submission);

        $fileName = basename($file_metadata->path_file_submission);

        return response()->download($path, $fileName);
    }

    public function download_metadata_pengajuan($id) // tidak dipakai lagi
    {
        $file_metadata = BudgetSubmission::findOrFail($id);

        $path = Storage::disk('private')->path($file_metadata->path_file_requirements_status);

        $fileName = basename($file_metadata->path_file_requirements_status);

        return response()->download($path, $fileName);
    }

    public function lihat_pengajuan($id) // jika sudah diarsipkan // tidak dipakai lagi
    {
        $file_pengajuan = BudgetSubmission::findOrFail($id);

        $path = Storage::disk('private')->path($file_pengajuan->path_file_submission);

        // $fileName = basename($file_pengajuan->path_file_pengajuan);

        return response()->file($path);
    }

    public function final_verification(Request $request, $id) // tidak dipakai lagi
    {
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

        $pengajuan = BudgetSubmission::with('user')->with('finance_officer')->with('revenue_officer')->findOrFail($id);
        if (Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
            $filePathMetadata = Storage::disk('private')->path($pengajuan->path_file_requirements_status);
            $spreadsheet = IOFactory::load($filePathMetadata);
            $worksheet = $spreadsheet->getActiveSheet();
        }
        $worksheet->getCell('B4')->setValue("Nomor : {$request->kuitansi}");
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePathMetadata);

        // === TENTUKAN FILE SOURCE ===
        if ($request->hasFile('file_pengajuan')) {

            if (
                $pengajuan->path_file_submission &&
                Storage::disk('private')->exists($pengajuan->path_file_submission)
            ) {
                Storage::disk('private')->delete($pengajuan->path_file_submission);
            }

            $file = $request->file('file_pengajuan');
            $filename = $file->getClientOriginalName();
            $sourcePath = $file->storeAs('pengajuan', $filename, 'private');
        } else {
            $sourcePath = $pengajuan->path_file_submission;
        }

        // === TAMBAH WATERMARK DENGAN NOMOR KUITANSI ===
        if (Storage::disk('private')->exists($sourcePath)) {
            $this->addWatermarkWithKuitansiToPdf($sourcePath, $request->kuitansi);
        }


        // add to digital archive
        // check bendahara divisi apa?
        $payment = PaymentMethod::findOrFail($request->payment_method);
        $funding = FundingSource::findOrFail($request->funding_source);
        $year = now()->year;

        $idPayment = null;
        $idFunding = null;

        // ========== CARI CATEGORY PAYMENT ==========
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

        
        // $sendername = User::where('id', $pengajuan->revenue_officer->id)->where('name', $pengajuan->revenue_officer->name);
        // $senderemail = User::where('id', $pengajuan->revenue_officer->id)->where('email', $pengajuan->revenue_officer->email);

        // $receiver = User::where('id', $pengajuan->user_id)->where('email', $pengajuan->user->email)->first();
        
        // FacadesNotification::send($receiver, new BudgetSubmitToArchiveNotification($sendername, $senderemail));

        Notification::create([
            'user_id' => $pengajuan->user_id,
            'title' => 'Pengajuan Disetujui',
            'message' => 'Pengajuan Anda telah <span class="font-semibold text-green-600">lengkap dan ditandatangani Bendahara</span>.',
            'type' => 'success',
            'url' => route('pengajuan.show', $pengajuan->id),
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
            ->route('bendahara.dashboard')
            ->with('success', 'Berhasil verifikasi final pengajuan');
    }

    // Function BARU untuk watermark dengan nomor kuitansi
    private function addWatermarkWithKuitansiToPdf(string $filePath, string $kuitansi) // tidak dipakai lagi
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
    public function store(Request $request) // revisi tanggal // tidak dipakai lagi
    {
        $request->validate([
            'nama_pengajuan' => 'required|string',
            'file' => 'mimes:pdf|max:51200|nullable',
        ]);

        $iduser = Auth::id();
        $status_kelengkapan = 'Belum Diperiksa';
        $status_verifikasi = 0;

        // simpan file pdf pengajuan
        if (isset($request->file)) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('pengajuan', $filename, 'private');
        } else {
            $path = null;
        }

        // copy file checklist untuk kelengkapan pengajuan
        $fileName = 'CHECKLIST.xlsx';
        $sourcePath = 'template/' . $fileName;

        // ubah spasi menjadi underscore
        $namaPengajuan = str_replace(' ', '_', $request->nama_pengajuan);
        $newFileName = time() . '_' . $namaPengajuan . '_' . $fileName;
        $destinationPath = 'metadata_pengajuan/' . $newFileName;

        // Cek apakah file source ada
        if (Storage::disk('private')->exists($sourcePath)) {

            // Pastikan folder tujuan ada
            $destinationDir = 'metadata_pengajuan';
            if (!Storage::disk('private')->exists($destinationDir)) {
                Storage::disk('private')->makeDirectory($destinationDir);
            }

            // Copy file
            Storage::disk('private')->copy($sourcePath, $destinationPath);
        }

        // $sendername = Auth::user()->name;
        // $senderemail = Auth::user()->email;
        // $senderrole = Auth::user()->role;
        // $keuangan = User::where('role', 'Keuangan')->get();

        // FacadesNotification::send($keuangan, new BudgetSubmitToKeuanganNotification($sendername, $senderemail, $senderrole));

        $pengajuan = BudgetSubmission::create([
            'user_id' => $iduser,
            'budget_submission_name' => $request->nama_pengajuan,
            'assigned_payment_method' => $request->payment_method,
            'assigned_funding_source' => $request->funding_source,
            'path_file_submission' => $path,
            'requirements_status' => $status_kelengkapan,
            'verification_status' => $status_verifikasi,
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
                'url' => route('keuangan.check', $pengajuan->id),
            ]);
        }

        if (Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
            $filePathMetadata = Storage::disk('private')->path($pengajuan->path_file_requirements_status);
            $spreadsheet = IOFactory::load($filePathMetadata);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet->setCellValue("B3", 'Nama Kegiatan : ' . $request->nama_pengajuan);
            $writer = new Xlsx($spreadsheet);
            $writer->save($filePathMetadata);
        }

        return redirect()->route('user.worklist')->with('success', 'Berhasil Mengirim Pengajuan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) // tidak dipakai lagi
    {
        $payment_method = PaymentMethod::all();
        $funding_source = FundingSource::all();
        $pengajuan = BudgetSubmission::with('finance_officer')->with('revenue_officer')
            ->with('payment_method')
            ->with('funding_source')
            ->findOrFail($id);
            
        if (Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
            $filePathMetadata = Storage::disk('private')->path($pengajuan->path_file_requirements_status);
            $spreadsheet = IOFactory::load($filePathMetadata);
            $worksheet = $spreadsheet->getActiveSheet();
        }

        $namaKegiatan = $worksheet->getCell('B3')->getValue();
        $no = $worksheet->getCell('B4')->getValue();

        $startCell = 7;
        // $endCell = 36;
        $currentRow = $startCell;
        $maxRows = 100;

        // Inisialisasi array
        $syaratDoc = [];
        $ada = [];
        $tidakada = [];
        $tidakperlu = [];
        $lengkap = [];
        $belum = [];
        $keterangan = [];

        while (count($syaratDoc) < 30 && $currentRow < $maxRows) {
            $datasyarat = $worksheet->getCell("C{$currentRow}")->getValue();

            // Cek apakah cell C kosong (baik null, spasi, atau empty string)
            if ($datasyarat !== null && trim($datasyarat) !== '') {
                $syaratDoc[] = $datasyarat;
                $ada[] = $worksheet->getCell("D{$currentRow}")->getValue();
                $tidakada[] = $worksheet->getCell("E{$currentRow}")->getValue();
                $tidakperlu[] = $worksheet->getCell("F{$currentRow}")->getValue();
                $lengkap[] = $worksheet->getCell("G{$currentRow}")->getValue();
                $belum[] = $worksheet->getCell("H{$currentRow}")->getValue();
                $keterangan[] = $worksheet->getCell("I{$currentRow}")->getValue();
            }

            $currentRow++;
        }

        // for ($startCell = 7; $startCell <= $endCell; $startCell++) {
        //     // if ($startCell   == 21) {
        //     //     continue;
        //     // }
        //     $syaratDoc[] = $worksheet->getCell("C{$startCell}")->getValue();
        //     $data[] = $worksheet->getCell("D{$startCell}")->getValue();
        //     $tidakada[] = $worksheet->getCell("E{$startCell}")->getValue();
        //     $tidakperlu[] = $worksheet->getCell("F{$startCell}")->getValue();
        //     $lengkap[] = $worksheet->getCell("G{$startCell}")->getValue();
        //     $belum[] = $worksheet->getCell("H{$startCell}")->getValue();
        //     $keterangan[] = $worksheet->getCell("I{$startCell}")->getValue();
        // }

        // Loop untuk mengambil data dengan skip baris kosong
        // while ($startCell <= $endCell) {
        //     if($startCell == 21){
        //         $startCell++;
        //         continue;
        //     }
        //     $datasyarat = $worksheet->getCell("C{$startCell}")->getValue();

        //     // Skip jika nama dokumen kosong
        //     if (trim($datasyarat) !== '' && $datasyarat !== null) {
        //         $syaratDoc[] = $datasyarat;
        //         $ada[] = $worksheet->getCell("D{$startCell}")->getValue();
        //         $tidakada[] = $worksheet->getCell("E{$startCell}")->getValue();
        //         $tidakperlu[] = $worksheet->getCell("F{$startCell}")->getValue();
        //         $lengkap[] = $worksheet->getCell("G{$startCell}")->getValue();
        //         $belum[] = $worksheet->getCell("H{$startCell}")->getValue();
        //         $keterangan[] = $worksheet->getCell("I{$startCell}")->getValue();
        //     }

        //     $startCell++;
        // }

        $catatan = $worksheet->getCell('B40')->getValue();

        return view('user.pengajuan.pengajuan-show', compact('pengajuan', 'namaKegiatan', 'no', 'syaratDoc', 'ada', 'tidakada', 'tidakperlu', 'lengkap', 'belum', 'keterangan', 'catatan', 'payment_method', 'funding_source'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) // tidak dipakai lagi
    {
        $pengajuan = BudgetSubmission::findOrFail($id);
        $payment_method = PaymentMethod::all();
        $funding_source = FundingSource::all();
        return view('user.pengajuan.pengajuan-edit', compact('pengajuan', 'payment_method', 'funding_source'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) // belum sempurna  // tidak dipakai lagi
    {
        $pengajuan = BudgetSubmission::findOrFail($id);
        $request->validate([
            'nama_pengajuan' => 'required|string',
            'file' => 'mimes:pdf|max:50000|nullable',
        ]);

        if ($request->file) {
            if ($pengajuan->path_file_submission && Storage::disk('private')->exists($pengajuan->path_file_submission)) {
                Storage::disk('private')->delete($pengajuan->path_file_submission);

                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('pengajuan', $filename, 'private');
            }
        } else {
            $path = $pengajuan->path_file_submission;
        }

        $fileName = 'CHECKLIST.xlsx';
        $sourcePath = 'template/' . $fileName;
        // ubah spasi menjadi underscore
        $namaPengajuan = str_replace(' ', '_', $request->nama_pengajuan);
        $newFileName = time() . '_' . $namaPengajuan . '_' . $fileName;
        $destinationPath = 'metadata_pengajuan/' . $newFileName;

        if ($pengajuan->path_file_requirements_status && Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
            Storage::disk('private')->move($pengajuan->path_file_requirements_status, $destinationPath);
        }

        $pengajuan->update([
            'budget_submission_name' => $request->nama_pengajuan,
            'assigned_payment_method' => $request->payment_method,
            'assigned_funding_source' => $request->funding_source,
            'path_file_submission' => $path,
            'path_file_requirements_status' => $destinationPath,
        ]);

        return redirect()->route('user.worklist')->with('success', 'Berhasil Mengirim Pengajuan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) // oke // tidak dipakai lagi
    {
        $pengajuan = BudgetSubmission::findOrFail($id);

        if ($pengajuan->path_file_submission && Storage::disk('private')->exists($pengajuan->path_file_submission)) {
            Storage::disk('private')->delete($pengajuan->path_file_submission);
        }

        if ($pengajuan->path_file_requirements_status && Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
            Storage::disk('private')->delete($pengajuan->path_file_requirements_status);
        }

        $pengajuan->delete();

        return redirect()->route('user.worklist')->with('success', 'Berhasil Mengirim Pengajuan');
    }
}
