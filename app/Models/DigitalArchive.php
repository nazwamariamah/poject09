<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'id',
        'category_id',
        'archive_name',
        'from_division',
        'submiter_name',
        'finance_officer_name',
        'revenue_officer_name',
        'file_path_archive',
        'archive_code',
        'nominal',
        'archive_by',
        'disposal_date',
        // 'created_at',
        // 'updated_at',
        'kode_klasifikasi',
        'indeks1',
        'indeks2',
        'no_item',
        'uraian',
        'no_spby',
        'no_spm',
        'jenis_spm',
        'no_sp2d',
        'nilai_sp2d',
        'jenis_sp2d',
        'tgl_sp2d',
        'tgl_selesai_sp2d',
        'no_invoice',
        'tgl_invoice',
        'tgl_terima',
        'tingkat_pertimbangan',
        'jumlah_halaman',
        'retensi_arsip_aktif',
        'retensi_arsip_inaktif',
        'nasib_akhir_arsip',
        'klasifikasi_keamanan',
        'status',
        'keterangan',
        'link_arsip',
    ];
}
