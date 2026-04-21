<?php

namespace App\Http\Controllers\Features\Final_Verification;

use App\Http\Controllers\Controller;
use App\Models\BudgetSubmission;
use Illuminate\Http\Request;

class SearchFinalVerificationController extends Controller
{
    public function search(Request $request)
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
        return view('features.verifikasi_final.search_result', compact('submit'));
    }
}
