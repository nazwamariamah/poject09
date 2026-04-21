<?php

namespace App\Http\Controllers\Features\Arsip\DigitalArchive;

use App\Http\Controllers\Controller;
use App\Models\BudgetSubmission;
use App\Models\Category;
use App\Models\DigitalArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function Symfony\Component\Clock\now;

class DigitalArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $category = Category::findOrFail($request->category_id);
        return view('features.arsip.digital_archive.digital_archives_form_create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::findOrFail($request->category_id);
        $validated = $request->validate([
            // 'category_id' => 'required|exists:categories,id',
            // 'submiter_name' => 'nullable|string|max:255',
            // 'finance_officer_name' => 'nullable|string|max:255',
            // 'revenue_officer_name' => 'nullable|string|max:255',
            // 'archive_by' => 'nullable|string|max:255',

            // Basic Information
            'digital_name' => 'required|string|max:255',
            'digital_code' => 'nullable|string|max:100',
            'from_division' => 'nullable|string|max:255',

            // Classification & Indexing
            'kode_klasifikasi' => 'nullable|string|max:100',
            'indeks1' => 'nullable|string|max:100',
            'indeks2' => 'nullable|string|max:100',
            'no_item' => 'nullable|string|max:100',

            // Financial Information
            'nominal' => 'nullable|numeric|min:0',
            'uraian' => 'nullable|string',

            // SPBy & SPM
            'no_spby' => 'nullable|string|max:100',
            'no_spm' => 'nullable|string|max:100',
            'jenis_spm' => 'nullable|string|max:100',

            // SP2D Information
            'no_sp2d' => 'nullable|string|max:100',
            'nilai_sp2d' => 'nullable|numeric|min:0',
            'jenis_sp2d' => 'nullable|string|max:100',
            'tgl_sp2d' => 'nullable|date',
            'tgl_selesai_sp2d' => 'nullable|date|after_or_equal:tgl_sp2d',

            // Invoice Information
            'no_invoice' => 'nullable|string|max:100',
            'tgl_invoice' => 'nullable|string|max:100', // bisa diubah ke 'date' jika formatnya date
            'tgl_terima' => 'nullable|date',

            // Archive Management
            'tingkat_pertimbangan' => 'nullable|string|max:100',
            'jumlah_halaman' => 'nullable|integer|min:0',
            'retensi_arsip_aktif' => 'nullable|integer|min:0',
            'retensi_arsip_inaktif' => 'nullable|integer|min:0',
            'nasib_akhir_arsip' => 'nullable|string|max:100',
            'klasifikasi_keamanan' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:100',
            'disposal_date' => 'nullable|date',

            // Personnel Information
            'submiter_name' => 'nullable|string|max:255',
            'finance_officer_name' => 'nullable|string|max:255',
            'revenue_officer_name' => 'nullable|string|max:255',

            // File & Link
            'file_path_digital' => 'nullable|file|mimes:pdf|max:50120', // max 20MB
            'link_arsip' => 'nullable|url|max:500',

            // Additional Notes
            'keterangan' => 'nullable|string',

            // field lain otomatis ikut karena fillable
        ]);

        if ($request->hasFile('file_path_digital')) {

            // hapus file lama
            // if (
            //     $archive->file_path_archive &&
            //     Storage::disk('private')->exists($archive->file_path_archive)
            // ) {
            //     Storage::disk('private')->delete($archive->file_path_archive);
            // }

            // simpan file baru
            $file = $request->file('file_path_digital');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('archive', $fileName, 'private');

            // masukkan path ke data update
            $validated['file_path_digital'] = $filePath;
        }

        DigitalArchive::create([
            'category_id' => $category->id,
            'archive_name' => $validated['digital_name'],
            'from_division' => $validated['from_division'],
            'submiter_name' => $validated['submiter_name'] ?? '',
            'finance_officer_name' => $validated['finance_officer_name'] ?? '',
            'revenue_officer_name' => $validated['revenue_officer_name'] ?? '',
            'file_path_archive' => $filePath ?? '', // path file yang sudah diupload
            'archive_code' => $validated['digital_code'] ?? '',
            'nominal' => $validated['nominal'] ?? 0,
            'archive_by' => $validated['revenue_officer_name'] ?? Auth::user()->name, // user yang sedang login
            'disposal_date' => $validated['disposal_date'] ?? now(),
            'kode_klasifikasi' => $validated['kode_klasifikasi'],
            'indeks1' => $validated['indeks1'],
            'indeks2' => $validated['indeks2'],
            'no_item' => $validated['no_item'],
            'uraian' => $validated['uraian'],
            'no_spby' => $validated['no_spby'],
            'no_spm' => $validated['no_spm'],
            'jenis_spm' => $validated['jenis_spm'],
            'no_sp2d' => $validated['no_sp2d'],
            'nilai_sp2d' => $validated['nilai_sp2d'],
            'jenis_sp2d' => $validated['jenis_sp2d'],
            'tgl_sp2d' => $validated['tgl_sp2d'],
            'tgl_selesai_sp2d' => $validated['tgl_selesai_sp2d'],
            'no_invoice' => $validated['no_invoice'],
            'tgl_invoice' => $validated['tgl_invoice'],
            'tgl_terima' => $validated['tgl_terima'],
            'tingkat_pertimbangan' => $validated['tingkat_pertimbangan'],
            'jumlah_halaman' => $validated['jumlah_halaman'],
            'retensi_arsip_aktif' => $validated['retensi_arsip_aktif'],
            'retensi_arsip_inaktif' => $validated['retensi_arsip_inaktif'],
            'nasib_akhir_arsip' => $validated['nasib_akhir_arsip'],
            'klasifikasi_keamanan' => $validated['klasifikasi_keamanan'],
            'status' => $validated['status'],
            'keterangan' => $validated['keterangan'],
            'link_arsip' => $validated['link_arsip'],
            'jenis_rak' => '',
            'folder' => '',
        ]);

        return redirect()
            ->route('year.show', $category->id)
            ->with('success', 'Arsip digital berhasil diperbarui!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $archive = DigitalArchive::findOrFail($id);
        // $tahun_archive = DigitalArchive::where('divisi_name', $archive->divisi_name)->get();
        return view('features.arsip.digital_archive.show-digital-archive', compact('archive'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $digital = DigitalArchive::findOrFail($id);
        return view('features.arsip.digital_archive.digital_archives_form_edit', compact('digital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $archive = DigitalArchive::findOrFail($id);

        // Validasi data (sesuaikan jika perlu)
        $validated = $request->validate([
            // 'category_id' => 'required|exists:categories,id',
            // 'submiter_name' => 'nullable|string|max:255',
            // 'finance_officer_name' => 'nullable|string|max:255',
            // 'revenue_officer_name' => 'nullable|string|max:255',
            // 'archive_by' => 'nullable|string|max:255',

            // Basic Information
            'digital_name' => 'required|string|max:255',
            'digital_code' => 'nullable|string|max:100',
            'from_division' => 'nullable|string|max:255',

            // Classification & Indexing
            'kode_klasifikasi' => 'nullable|string|max:100',
            'indeks1' => 'nullable|string|max:100',
            'indeks2' => 'nullable|string|max:100',
            'no_item' => 'nullable|string|max:100',

            // Financial Information
            'nominal' => 'nullable|numeric|min:0',
            'uraian' => 'nullable|string',

            // SPBy & SPM
            'no_spby' => 'nullable|string|max:100',
            'no_spm' => 'nullable|string|max:100',
            'jenis_spm' => 'nullable|string|max:100',

            // SP2D Information
            'no_sp2d' => 'nullable|string|max:100',
            'nilai_sp2d' => 'nullable|numeric|min:0',
            'jenis_sp2d' => 'nullable|string|max:100',
            'tgl_sp2d' => 'nullable|date',
            'tgl_selesai_sp2d' => 'nullable|date|after_or_equal:tgl_sp2d',

            // Invoice Information
            'no_invoice' => 'nullable|string|max:100',
            'tgl_invoice' => 'nullable|string|max:100', // bisa diubah ke 'date' jika formatnya date
            'tgl_terima' => 'nullable|date',

            // Archive Management
            'tingkat_pertimbangan' => 'nullable|string|max:100',
            'jumlah_halaman' => 'nullable|integer|min:0',
            'retensi_arsip_aktif' => 'nullable|integer|min:0',
            'retensi_arsip_inaktif' => 'nullable|integer|min:0',
            'nasib_akhir_arsip' => 'nullable|string|max:100',
            'klasifikasi_keamanan' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:100',
            'disposal_date' => 'nullable|date',

            // Personnel Information
            'submiter_name' => 'nullable|string|max:255',
            'finance_officer_name' => 'nullable|string|max:255',
            'revenue_officer_name' => 'nullable|string|max:255',

            // File & Link
            'file_path_digital' => 'nullable|file|mimes:pdf|max:50120', // max 20MB
            'link_arsip' => 'nullable|url|max:500',

            // Additional Notes
            'keterangan' => 'nullable|string',

            // field lain otomatis ikut karena fillable
        ]);

        // Handle upload file jika ada
        if ($request->hasFile('file_path_digital')) {

            // hapus file lama
            if (
                $archive->file_path_archive &&
                Storage::disk('private')->exists($archive->file_path_archive)
            ) {
                Storage::disk('private')->delete($archive->file_path_archive);
            }

            // simpan file baru
            $file = $request->file('file_path_digital');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('archive', $fileName, 'private');

            // masukkan path ke data update
            $validated['file_path_digital'] = $filePath;
        }

        // Update data (AMAN)
        $archive->update([
            'category_id' => $archive->category_id,
            'archive_name' => $validated['digital_name'],
            'from_division' => $validated['from_division'],
            'submiter_name' => $validated['submiter_name'] ?? '',
            'finance_officer_name' => $validated['finance_officer_name'] ?? '',
            'revenue_officer_name' => $validated['revenue_officer_name'] ?? '',
            'file_path_archive' => $filePath ?? '', // path file yang sudah diupload
            'archive_code' => $validated['digital_code'] ?? '',
            'nominal' => $validated['nominal'],
            'archive_by' => $validated['revenue_officer_name'] ?? Auth::user()->name, // user yang sedang login
            'disposal_date' => $validated['disposal_date'] ?? now(),
            'kode_klasifikasi' => $validated['kode_klasifikasi'],
            'indeks1' => $validated['indeks1'],
            'indeks2' => $validated['indeks2'],
            'no_item' => $validated['no_item'],
            'uraian' => $validated['uraian'],
            'no_spby' => $validated['no_spby'],
            'no_spm' => $validated['no_spm'],
            'jenis_spm' => $validated['jenis_spm'],
            'no_sp2d' => $validated['no_sp2d'],
            'nilai_sp2d' => $validated['nilai_sp2d'],
            'jenis_sp2d' => $validated['jenis_sp2d'],
            'tgl_sp2d' => $validated['tgl_sp2d'],
            'tgl_selesai_sp2d' => $validated['tgl_selesai_sp2d'],
            'no_invoice' => $validated['no_invoice'],
            'tgl_invoice' => $validated['tgl_invoice'],
            'tgl_terima' => $validated['tgl_terima'],
            'tingkat_pertimbangan' => $validated['tingkat_pertimbangan'],
            'jumlah_halaman' => $validated['jumlah_halaman'],
            'retensi_arsip_aktif' => $validated['retensi_arsip_aktif'],
            'retensi_arsip_inaktif' => $validated['retensi_arsip_inaktif'],
            'nasib_akhir_arsip' => $validated['nasib_akhir_arsip'],
            'klasifikasi_keamanan' => $validated['klasifikasi_keamanan'],
            'status' => $validated['status'],
            'keterangan' => $validated['keterangan'],
            'link_arsip' => $validated['link_arsip'],
            'jenis_rak' => '',
            'folder' => '',
        ]);

        // Redirect sukses
        return redirect()
            ->route('year.show', $archive->category_id)
            ->with('success', 'Arsip digital berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $archive = DigitalArchive::findOrFail($id);
        $pengajuan = BudgetSubmission::where('digital_archive_id', $archive->id)->first();

        // Hapus file path_file_requirements_status jika ada
        if (isset($pengajuan)) {
            if ($pengajuan->path_file_requirements_status && Storage::disk('private')->exists($pengajuan->path_file_requirements_status)) {
                Storage::disk('private')->delete($pengajuan->path_file_requirements_status);
            }

            // Hapus file path_file_submission jika ada
            if ($pengajuan->path_file_submission && Storage::disk('private')->exists($pengajuan->path_file_submission)) {
                Storage::disk('private')->delete($pengajuan->path_file_submission);
            }

            // Hapus file arsip jika ada
            if ($archive->file_path_archive && Storage::disk('private')->exists($archive->file_path_archive)) {
                Storage::disk('private')->delete($archive->file_path_archive);
            }

            $pengajuan->delete();
        }

        // Hapus data arsip dari database
        $archive->delete();

        // Redirect dengan pesan sukses
        return redirect()
            ->route('year.show', $archive->category_id)
            ->with('success', 'Arsip digital berhasil dihapus!');
    }
}
