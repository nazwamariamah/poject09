<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\BudgetSubmission;
use App\Models\DigitalArchive;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DigitalArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = DigitalArchive::all();
        return view('bendahara.digital_arsip.digital_archive', compact('result'));
    }

    public function name_file($id) // id arsip
    {
        $file = DigitalArchive::findOrFail($id);

        $path = Storage::disk('private')->path($file->file_path_archive);

        return response()->file($path);
    }

    public function download_file($id)
    {
        $file = DigitalArchive::findOrFail($id);

        $path = Storage::disk('private')->path($file->file_path_archive);

        $originalName = basename($file->file_path);

        return response()->download($path, $originalName);
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
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $archive = DigitalArchive::findOrFail($id);
        // $tahun_archive = DigitalArchive::where('divisi_name', $archive->divisi_name)->get();
        return view('bendahara.digital_arsip.show-digital-archive', compact('archive'));
    }

    // public function show_in_year($id)
    // {
    //     $allArchive = BudgetSubmission::where('digital_archive_id', $id)->get();
    //     return view('bendahara.digital_arsip.all-digital-archive', compact('allArchive', 'id'));
    // }

    // public function show_digital_archive($id)
    // {
    //     $pengajuan = BudgetSubmission::with('user')
    //         ->with('finance_officer')
    //         ->with('category_archive')
    //         ->findOrFail($id);
    //     return view('bendahara.digital_arsip.show-digital-archive', compact('pengajuan', 'id'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $digital = DigitalArchive::findOrFail($id);
        return view('bendahara.digital_arsip.digital_archives_form_edit', compact('digital'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        // Ambil data arsip
        $archive = DigitalArchive::findOrFail($id);

        // Validasi data (sesuaikan jika perlu)
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'digital_name' => 'required|string|max:255',
            'from_division' => 'nullable|string|max:255',
            'submiter_name' => 'nullable|string|max:255',
            'finance_officer_name' => 'nullable|string|max:255',
            'revenue_officer_name' => 'nullable|string|max:255',
            'archive_code' => 'nullable|string|max:100',
            'nominal' => 'nullable|numeric',
            'archive_by' => 'nullable|string|max:255',
            'disposal_date' => 'nullable|date',
            'status' => 'nullable|required',
            'keterangan' => 'nullable|string',
            'link_arsip' => 'nullable|string',
            // field lain otomatis ikut karena fillable
        ]);

        // Handle upload file jika ada
        if ($request->hasFile('file_path_archive')) {

            // hapus file lama
            if (
                $archive->file_path_archive &&
                Storage::disk('private')->exists($archive->file_path_archive)
            ) {
                Storage::disk('private')->delete($archive->file_path_archive);
            }

            // simpan file baru
            $file = $request->file('file_path_archive');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('archive', $fileName, 'private');

            // masukkan path ke data update
            $validated['file_path_archive'] = $filePath;
        }

        // Update data (AMAN)
        $archive->update($validated);

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
        // Cari data arsip
        $archive = DigitalArchive::findOrFail($id);
        $pengajuan = BudgetSubmission::where('digital_archive_id',$archive->id)->first();
        
        // Hapus file path_file_requirements_status jika ada
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
        
        // Hapus data arsip dari database
        $archive->delete();
        $pengajuan->delete();
        
        // Redirect dengan pesan sukses
        return redirect()
            ->route('year.show', $archive->category_id)
            ->with('success', 'Arsip digital berhasil dihapus!');
    }
}
