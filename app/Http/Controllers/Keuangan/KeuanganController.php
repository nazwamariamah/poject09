<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\BudgetSubmission;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        // ================= QUERY DASAR =================
        $query = BudgetSubmission::with('user');

        // ================= FILTER =================
        if ($request->search) {
            $query->where('pengajuan_name', 'like', '%' . $request->search . '%');
        }

        if ($request->status) {
            switch ($request->status) {
                case 'belum_diperiksa':
                    $query->where('requirements_status', 'Belum Diperiksa');
                    break;

                case 'belum_lengkap':
                    $query->where('requirements_status', 'Belum Lengkap');
                    break;

                case 'lengkap':
                    $query->where('requirements_status', 'Lengkap');
                    break;

                case 'belum_diverifikasi':
                    $query->where('verification_status', 0);
                    break;

                case 'diverifikasi':
                    $query->where('verification_status', 1);
                    break;

                case 'diarsipkan':
                    $query->where('is_archive', 1);
                    break;
            }
        }

        $pengajuans = $query->latest()->get();



        // ================= STATISTIK =================
        $total_pengajuan = BudgetSubmission::count();

        $perlu_diperiksa = BudgetSubmission::whereIn('requirements_status', [
            'Belum Lengkap',
            'Belum Diperiksa'
        ])->count();

        $belum_diverifikasi = BudgetSubmission::where('verification_status', 0)->count();

        $sudah_diverifikasi = BudgetSubmission::where('verification_status', 1)->count();

        return view('keuangan.dashboard', compact(
            'pengajuans',
            'total_pengajuan',
            'perlu_diperiksa',
            'belum_diverifikasi',
            'sudah_diverifikasi'
        ));
    }

    public function input_arsip()
    {
        return redirect()->route('admin.archive');
    }

    public function all_submit() // tidak dipakai lagi
    {
        $all_submit = BudgetSubmission::latest()->paginate(10, ['*'], 'all_submit');
        $not_check_submit = BudgetSubmission::where('requirements_status', 'Belum Diperiksa')->latest()->paginate('10', ['*'], 'not_check');
        $my_proses = BudgetSubmission::where('requirements_status', 'Belum Lengkap')
            ->where('verification_status', 0)
            ->where('finance_officers_id', Auth::id())->latest()
            ->paginate(5, ['*'], 'my_proses');

        return view('keuangan.pengajuan', compact('all_submit', 'not_check_submit', 'my_proses'));
    }

    public function check_pengajuan($id) // tidak dipakai lagi
    {
        $pengajuan = BudgetSubmission::with('user')->findOrFail($id);

        if (Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
            $filePathMetadata = Storage::disk('private')->path($pengajuan->path_file_requirements_status);
            $spreadsheet = IOFactory::load($filePathMetadata);
            $worksheet = $spreadsheet->getActiveSheet();
        }

        $namaKegiatan = $worksheet->getCell('B3')->getValue();
        $nokuitansi = $worksheet->getCell('B4')->getValue();
        $kuitansi = trim(preg_replace('/^Nomor\s*:\s*/i', '', $nokuitansi));

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

                if (
                    $worksheet->getCell("D{$currentRow}")->getValue() !== null ||
                    $worksheet->getCell("E{$currentRow}")->getValue() !== null ||
                    $worksheet->getCell("F{$currentRow}")->getValue() !== null
                ) {
                    $worksheet->setCellValue("D{$currentRow}", 'Y');
                    $writer = new Xlsx($spreadsheet);
                    $writer->save($filePathMetadata);
                    // $dataada = $worksheet->getCell("D{$currentRow}")->getValue();
                } else {
                    $worksheet->setCellValue("D{$currentRow}", 'Y');
                    $writer = new Xlsx($spreadsheet);
                    $writer->save($filePathMetadata);
                    $dataada = $worksheet->getCell("D{$currentRow}")->getValue();
                }

                if (
                    $worksheet->getCell("G{$currentRow}")->getValue() !== null ||
                    $worksheet->getCell("H{$currentRow}")->getValue() !== null
                ) {
                    $worksheet->setCellValue("D{$currentRow}", 'Y');
                    $writer = new Xlsx($spreadsheet);
                    $writer->save($filePathMetadata);
                    // $lengkap = $worksheet->getCell("G{$currentRow}")->getValue();
                } else {
                    $worksheet->setCellValue("G{$currentRow}", 'Y');
                    $writer = new Xlsx($spreadsheet);
                    $writer->save($filePathMetadata);
                    $datalengkap = $worksheet->getCell("G{$currentRow}")->getValue();
                }

                $ada[] = $worksheet->getCell("D{$currentRow}")->getValue();
                $tidakada[] = $worksheet->getCell("E{$currentRow}")->getValue();
                $tidakperlu[] = $worksheet->getCell("F{$currentRow}")->getValue();
                $lengkap[] = $worksheet->getCell("G{$currentRow}")->getValue();
                $belum[] = $worksheet->getCell("H{$currentRow}")->getValue();
                $keterangan[] = $worksheet->getCell("I{$currentRow}")->getValue();

                // dokumen
            }

            $currentRow++;
        }
        // while ($startCell <= $endCell) {
        //     $datasyarat = $worksheet->getCell("C{$startCell}")->getValue();
        //     if($startCell == 21){
        //         $startCell++;
        //         continue;
        //     }
        //     $syaratDoc[] = $datasyarat;
        //     $startCell++;
        // }

        // // ======== dokumen
        // $startCell = 7;
        // $ada = [];
        // while ($startCell <= $endCell) {
        //     if($startCell == 21){
        //         $startCell++;
        //         continue;
        //     }
        //     if (
        //         $worksheet->getCell("D{$startCell}")->getValue() !== null ||
        //         $worksheet->getCell("E{$startCell}")->getValue() !== null ||
        //         $worksheet->getCell("F{$startCell}")->getValue() !== null
        //     ) {
        //         $dataada = $worksheet->getCell("D{$startCell}")->getValue();
        //     } else {
        //         $worksheet->setCellValue("D{$startCell}", 'Y');
        //         $writer = new Xlsx($spreadsheet);
        //         $writer->save($filePathMetadata);
        //         $dataada = $worksheet->getCell("D{$startCell}")->getValue();
        //     }
        //     $ada[] = $dataada;
        //     $startCell++;
        // }
        // $startCell = 7;
        // $tidakada = [];
        // while ($startCell <= $endCell) {
        //     if($startCell == 21){
        //         $startCell++;
        //         continue;
        //     }
        //     $datatidakada = $worksheet->getCell("E{$startCell}")->getValue();
        //     $tidakada[] = $datatidakada;
        //     $startCell++;
        // }
        // $startCell = 7;
        // $tidakperlu = [];
        // while ($startCell <= $endCell) {
        //     if($startCell == 21){
        //         $startCell++;
        //         continue;
        //     }
        //     $datatidakperlu = $worksheet->getCell("F{$startCell}")->getValue();
        //     $tidakperlu[] = $datatidakperlu;
        //     $startCell++;
        // }

        // // ========== tanda tangan
        // $startCell = 7;
        // $lengkap = [];
        // while ($startCell <= $endCell) {
        //     if($startCell == 21){
        //         $startCell++;
        //         continue;
        //     }
        //     if (
        //         $worksheet->getCell("G{$startCell}")->getValue() !== null ||
        //         $worksheet->getCell("H{$startCell}")->getValue() !== null ||
        //         $worksheet->getCell("I{$startCell}")->getValue() !== null
        //     ) {
        //         $datalengkap = $worksheet->getCell("G{$startCell}")->getValue();
        //     } else {
        //         $worksheet->setCellValue("G{$startCell}", 'Y');
        //         $writer = new Xlsx($spreadsheet);
        //         $writer->save($filePathMetadata);
        //         $datalengkap = $worksheet->getCell("G{$startCell}")->getValue();
        //     }
        //     $lengkap[] = $datalengkap;
        //     $startCell++;
        // }
        // $startCell = 7;
        // $belum = [];
        // while ($startCell <= $endCell) {
        //     if($startCell == 21){
        //         $startCell++;
        //         continue;
        //     }
        //     $databelum = $worksheet->getCell("H{$startCell}")->getValue();
        //     $belum[] = $databelum;
        //     $startCell++;
        // }

        // $startCell = 7;
        // $keterangan = [];
        // while ($startCell <= $endCell) {
        //     if($startCell == 21){
        //         $startCell++;
        //         continue;
        //     }
        //     $dataketerangan = $worksheet->getCell("I{$startCell}")->getValue();
        //     $keterangan[] = $dataketerangan;
        //     $startCell++;
        // }

        $catatan = $worksheet->getCell('B40')->getValue();

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePathMetadata);

        return view('keuangan.check-pengajuan', compact('pengajuan', 'namaKegiatan', 'kuitansi', 'syaratDoc', 'ada', 'tidakada', 'tidakperlu', 'lengkap', 'belum', 'keterangan', 'catatan'));
    }

    public function search_pengajuan(Request $request) // tidak dipakai lagi
    {
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $submit = BudgetSubmission::with('user')
                ->where('budget_submission_name', 'LIKE', '%' . $request->search . '%')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->latest()->get();
        } else {
            $submit = BudgetSubmission::with('user')
                ->where('budget_submission_name', 'LIKE', '%' . $request->search . '%')
                // ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->latest()->get();
        }
        return view('keuangan.search.search_result', compact('submit'));
    }

    public function report(Request $request)
    {
        if (isset($request->from_date) && isset($request->target_date)) {
            $submission = BudgetSubmission::with('user')->whereBetween('updated_at', [$request->from_date, $request->target_date])->paginate(10, ['*'], 'submit_result_filter');
            return view('keuangan.report.report', compact('submission'));
        }
        $submission = BudgetSubmission::with('user')->paginate(10, ['*'], 'result_no_filter');
        return view('keuangan.report.report', compact('submission'));
    }

    public function report_all_submission(Request $request)
    {
        $pengajuan = BudgetSubmission::with('user')
            ->whereBetween('updated_at', [$request->from_date, $request->target_date])
            ->get();

        $data = [
            'title' => 'Laporan Semua Pengajuan',
            'pengajuan' => $pengajuan,
            'tanggal_awal' => $request->from_date,
            'tanggal_akhir' => $request->target_date,
            'watermark' => storage_path('app/public/images/watermark.png'),
        ];

        $html = view('keuangan.report.all_submission_report', $data)->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('Laporan Semua Pengajuan.pdf', 'S'))->header('Content-Type', 'application/pdf');
    }

    public function report_verification_submission(Request $request)
    {
        $pengajuan = BudgetSubmission::with('user')->with('finance_officer')
            ->where('verification_status', 1)
            ->whereBetween('updated_at', [$request->from_date, $request->target_date])
            ->get();

        $data = [
            'title' => 'Laporan Pengajuan diverifikasi',
            'pengajuan' => $pengajuan,
            'tanggal_awal' => $request->from_date,
            'tanggal_akhir' => $request->target_date,
            'watermark' => storage_path('app/public/images/watermark.png'),
        ];

        $html = view('keuangan.report.verify_submission', $data)->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('Laporan Pengajuan Diverifikasi.pdf', 'S'))->header('Content-Type', 'application/pdf');
    }
}
