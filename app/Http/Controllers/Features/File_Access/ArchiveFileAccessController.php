<?php

namespace App\Http\Controllers\Features\File_Access;

use App\Http\Controllers\Controller;
use App\Models\ArchiveFile;
use App\Models\BudgetSubmission;
use App\Models\DigitalArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveFileAccessController extends Controller
{
    function stream_digital_archive($id)
    {
        $file_digital_arsip = DigitalArchive::findOrFail($id);

        $path = Storage::disk('private')->path($file_digital_arsip->file_path_archive);

        // $fileName = basename($file_pengajuan->path_file_pengajuan);

        return response()->file($path);
    }

    function download_digital_archive($id)
    {
        $file_digital_arsip = DigitalArchive::findOrFail($id);

        $path = Storage::disk('private')->path($file_digital_arsip->file_path_archive);

        $fileName = basename($file_digital_arsip->file_path_archive);

        return response()->download($path, $fileName);
    }

    function stream_archive($id)
    {
        $file_arsip = ArchiveFile::findOrFail($id);

        $path = Storage::disk('private')->path($file_arsip->file_path);

        // $fileName = basename($file_pengajuan->path_file_pengajuan);

        return response()->file($path);
    }

    function download_archive($id)
    {
        $file_arsip = ArchiveFile::findOrFail($id);

        $path = Storage::disk('private')->path($file_arsip->file_path);

        $fileName = basename($file_arsip->file_path);

        return response()->download($path, $fileName);
    }
}
