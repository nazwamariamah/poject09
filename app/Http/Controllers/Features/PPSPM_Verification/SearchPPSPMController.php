<?php

namespace App\Http\Controllers\Features\PPSPM_Verification;

use App\Http\Controllers\Controller;
use App\Models\BudgetSubmission;
use Illuminate\Http\Request;

class SearchPPSPMController extends Controller
{
    public function search(Request $request)
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
        return view('features.verifikasi_ppspm.search_result', compact('submit'));
    }
}
