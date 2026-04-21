<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\BudgetSubmission;
use App\Models\Cabinet;
use App\Models\FundingSource;
use App\Models\PaymentMethod;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BendaharaController extends Controller
{
    public function index(Request $request)
    {
        // ================= QUERY DASAR LIST =================
        $query = BudgetSubmission::with('user')
            ->where('requirements_status', 'Lengkap')
            ->where('verification_status', 1);

        // ================= FILTER SEARCH =================
        if ($request->filled('search')) {
            $query->where('budget_submission_name', 'like', '%' . $request->search . '%');
        }

        // ================= FILTER STATUS ARSIP =================
        if ($request->status === 'sudah_diarsipkan') {
            $query->where('is_archive', 1);
        }

        if ($request->status === 'belum_diarsipkan') {
            $query->where('is_archive', 0);
        }

        // ================= DATA LIST =================
        $pengajuans = $query->orderBy('created_at', 'desc')->get();

        // ================= STATISTIK =================
        $total_terverifikasi = BudgetSubmission::where('requirements_status', 'Lengkap')
            ->where('verification_status', 1)
            ->count();

        $menunggu_verifikasi = BudgetSubmission::where('requirements_status', 'Lengkap')
            ->where('verification_status', 1)
            ->where('is_archive', 0)
            ->count();

        $sudah_diarsipkan = BudgetSubmission::where('is_archive', 1)->count();

        $selesai_hari_ini = BudgetSubmission::whereDate('updated_at', Carbon::today())
            ->where('is_archive', 1)
            ->count();

        // ================= PROGRESS (%) =================
        $progress = 0;
        if ($total_terverifikasi > 0) {
            $progress = round(
                ($sudah_diarsipkan / $total_terverifikasi) * 100
            );
        }

        // ================= RETURN VIEW =================
        return view('bendahara.dashboard', compact(
            'pengajuans',
            'total_terverifikasi',
            'menunggu_verifikasi',
            'sudah_diarsipkan',
            'selesai_hari_ini',
            'progress'
        ));
    }

    public function document_sign($id) // tidak dipakai lagi
    {
        $pengajuan = BudgetSubmission::with('user')
            ->with('finance_officer')
            ->with('revenue_officer')
            ->where('id', $id)->first();
        $cabinets = Cabinet::all();
        $payment_method = PaymentMethod::all();
        $funding_source = FundingSource::all();
        return view('bendahara.final-verifikasi', compact('pengajuan', 'cabinets', 'payment_method', 'funding_source'));
    }

    public function pengajuan() // tidak dipakai lagi
    {
        $submit_sign = BudgetSubmission::where('is_archive', 0)->paginate(10, ['*'], 'submit_no_sign');
        $pengajuans = BudgetSubmission::where('requirements_status', 'Lengkap')
            ->where('verification_status', 1)
            ->paginate(10, ['*'], 'all_submit');

        return view('bendahara.pengajuan', compact('pengajuans', 'submit_sign'));
    }

    public function report()
    {
        if (isset($request->from_date) && isset($request->target_date)) {
            $submission = BudgetSubmission::with('user')->where('verification_status', 1)->whereBetween('updated_at', [$request->from_date, $request->target_date])->paginate(10, ['*'], 'submit_result_filter');
            return view('keuangan.report.report', compact('submission'));
        }
        $submission = BudgetSubmission::with('user')->where('verification_status', 1)->paginate(10, ['*'], 'result_no_filter');
        return view('bendahara.report.report', compact('submission'));
    }

    public function report_sign_submission(Request $request)
    {
        $pengajuan = BudgetSubmission::with('user')->with('revenue_officer')
            ->where('revenue_officer_id', Auth::id())
            ->where('is_archive', 1)
            ->whereBetween('updated_at', [$request->from_date, $request->target_date])
            ->get();

        $data = [
            'title' => 'Laporan Semua Pengajuan yang ditanda tangani',
            'pengajuan' => $pengajuan,
            'name' => Auth::user()->name,
            'tanggal_awal' => $request->from_date,
            'tanggal_akhir' => $request->target_date,
            'watermark' => storage_path('app/public/images/watermark.png'),
        ];

        $html = view('bendahara.report.report_submission_sign', $data)->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('Laporan Semua Pengajuan ditanda tangani.pdf', 'S'))->header('Content-Type', 'application/pdf');
    }

    public function report_sign_submission_nominal(Request $request)
    {
        $pengajuan = BudgetSubmission::with('user')->with('revenue_officer')
            ->where('revenue_officer_id', Auth::id())
            ->where('is_archive', 1)
            ->whereBetween('updated_at', [$request->from_date, $request->target_date])
            ->get();

        $totalNominal = $pengajuan->sum('nominal');

        $data = [
            'title' => 'Laporan Nominal Pengajuan yang ditanda tangani',
            'pengajuan' => $pengajuan,
            'name' => Auth::user()->name,
            'totalNominal' => $totalNominal,
            'tanggal_awal' => $request->from_date,
            'tanggal_akhir' => $request->target_date,
            'watermark' => storage_path('app/public/images/watermark.png'),
        ];

        $html = view('bendahara.report.report_submission_sign_nominal', $data)->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('Laporan Nominal Pengajuan yang ditanda tangani.pdf', 'S'))->header('Content-Type', 'application/pdf');
    }

    public function report_all_sign_submission(Request $request)
    {
        $pengajuan = BudgetSubmission::with('user')->with('revenue_officer')
            ->where('is_archive', 1)
            ->whereBetween('updated_at', [$request->from_date, $request->target_date])
            ->get();

        $data = [
            'title' => 'Laporan Semua Pengajuan yang ditanda tangani',
            'pengajuan' => $pengajuan,
            'tanggal_awal' => $request->from_date,
            'tanggal_akhir' => $request->target_date,
            'watermark' => storage_path('app/public/images/watermark.png'),
        ];

        $html = view('bendahara.report.report_all_sign_submission', $data)->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('Laporan Semua Pengajuan yang ditanda tangani.pdf', 'S'))->header('Content-Type', 'application/pdf');
    }

    public function search_pengajuan(Request $request) // tidak dipakai lagi
    {
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $submit = BudgetSubmission::with('user')
                ->where('budget_submission_name', 'LIKE', '%' . $request->search . '%')
                ->where('verification_status', 1)
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->latest()->get();
        } else {
            $submit = BudgetSubmission::with('user')
                ->where('budget_submission_name', 'LIKE', '%' . $request->search . '%')
                // ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->where('verification_status', 1)
                ->latest()->get();
        }
        return view('bendahara.search.search_result', compact('submit'));
    }
}
