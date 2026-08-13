<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArchiveFile;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Dokumen tersimpan (sudah upload file)
        $dokumenTersimpan = ArchiveFile::whereNotNull('file_path')->count();

        // Dokumen tidak tersimpan (belum upload file)
        $dokumenTidakTersimpan = ArchiveFile::whereNull('file_path')->count();

        // Jumlah user
        $jumlahUser = User::count();

        // Data statistik untuk Grafik (Chart.js)
        $chartLabels = ['Dokumen Tersimpan', 'Belum Upload File'];
        $chartValues = [$dokumenTersimpan, $dokumenTidakTersimpan];

        return view('admin.admin-dashboard', compact(
            'dokumenTersimpan',
            'dokumenTidakTersimpan',
            'jumlahUser',
            'chartLabels',
            'chartValues'
        ));
    }
}