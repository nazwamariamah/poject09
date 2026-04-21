<?php

namespace App\Http\Controllers\Features\File_Access;

use App\Http\Controllers\Controller;
use App\Models\BudgetSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileAccessController extends Controller
{
    function stream($id)
    {
        $file_pengajuan = BudgetSubmission::findOrFail($id);

        $path = Storage::disk('private')->path($file_pengajuan->path_file_submission);

        // $fileName = basename($file_pengajuan->path_file_pengajuan);

        return response()->file($path);
    }

    function download($id)
    {
        $file_metadata = BudgetSubmission::findOrFail($id);

        $path = Storage::disk('private')->path($file_metadata->path_file_submission);

        $fileName = basename($file_metadata->path_file_submission);

        return response()->download($path, $fileName);
    }

    function download_metadata($id) // download metadata pengajuan
    {
        $file_metadata = BudgetSubmission::findOrFail($id);

        $path = Storage::disk('private')->path($file_metadata->path_file_requirements_status);

        $fileName = basename($file_metadata->path_file_requirements_status);

        return response()->download($path, $fileName);
    }
}
