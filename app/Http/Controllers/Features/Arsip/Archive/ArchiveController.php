<?php

namespace App\Http\Controllers\Features\Arsip\Archive;

use App\Http\Controllers\Controller;
use App\Models\ArchiveFile;
use App\Models\DocumentFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
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
        $folders = DocumentFolder::findOrFail($request->folder_id);
        return view('features.arsip.archive.form-create-file', compact('folders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (isset($request->file_archive)) {
            $file = $request->file('file_archive');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('archive', $filename, 'private');
        } else {
            $path = null;
        }

        // $request->validate([
        //     // 'jenis_rak' => 'required|string|max:255',
        //     'file_name' => 'required|string|max:255',
        //     // 'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx',
        //     'kode_klasifikasi' => 'nullable|string|max:255',
        //     'indeks1' => 'nullable|string|max:255',
        //     'indeks2' => 'nullable|string|max:255',
        //     'no_item' => 'nullable|string|max:255',
        //     'uraian' => 'nullable|string',
        //     'no_spby' => 'nullable|string|max:255',
        //     'no_spm' => 'nullable|string|max:255',
        //     'jenis_spm' => 'nullable|string|max:255',
        //     'no_sp2d' => 'nullable|string|max:255',
        //     'nilai_sp2d' => 'nullable|numeric',
        //     'jenis_sp2d' => 'nullable|string|max:255',
        //     'tgl_sp2d' => 'nullable|date',
        //     'tgl_selesai_sp2d' => 'nullable|date',
        //     'no_invoice' => 'nullable|string|max:255',
        //     'tgl_invoice' => 'nullable|string|max:255',
        //     'tgl_terima' => 'nullable|date',
        //     'tingkat_pertimbangan' => 'nullable|string|max:255',
        //     'jumlah_halaman' => 'nullable|integer',
        //     'retensi_arsip_aktif' => 'nullable|integer',
        //     'retensi_arsip_inaktif' => 'nullable|integer',
        //     'nasib_akhir_arsip' => 'nullable|string|max:255',
        //     'klasifikasi_keamanan' => 'nullable|string|max:255',
        //     'status' => 'required|string|max:50',
        //     'keterangan' => 'nullable|string',
        //     'link_arsip' => 'nullable|string|max:255',
        //     'file_archive' => 'mimes:pdf|max:20480',
        // ]);

        ArchiveFile::create([
            'folder_id' => $request->folder_id,
            'file_name' => $request->file_name,
            'file_path' => $path,
            'kode_klasifikasi' => $request->kode_klasifikasi,
            'indeks1' => $request->indeks1,
            'indeks2' => $request->indeks2,
            'no_item' => $request->no_item,
            'uraian' => $request->uraian,
            'no_spby' => $request->no_spby,
            'no_spm' => $request->no_spm,
            'jenis_spm' => $request->jenis_spm,
            'no_sp2d' => $request->no_sp2d,
            'nilai_sp2d' => $request->nilai_sp2d,
            'jenis_sp2d' => $request->jenis_sp2d,
            'tgl_sp2d' => $request->tgl_sp2d,
            'tgl_selesai_sp2d' => $request->tgl_selesai_sp2d,
            'no_invoice' => $request->no_invoice,
            'tgl_invoice' => $request->tgl_invoice,
            'tgl_terima' => $request->tgl_terima,
            'tingkat_pertimbangan' => $request->tingkat_pertimbangan,
            'jumlah_halaman' => $request->jumlah_halaman,
            'retensi_arsip_aktif' => $request->retensi_arsip_aktif,
            'retensi_arsip_inaktif' => $request->retensi_arsip_inaktif,
            'nasib_akhir_arsip' => $request->nasib_akhir_arsip,
            'klasifikasi_keamanan' => $request->klasifikasi_keamanan,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'link_arsip' => $request->link_arsip,
        ]);

        return redirect()->route('folder.show', ['folder' => $request->folder_id])->with('success', 'Berhasil Upload file');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $archives = ArchiveFile::where('id', $id)->first();
        $path = $archives->path_file;

        return view('features.arsip.archive.archive-show-file', compact('archives'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $file = ArchiveFile::findOrFail($id);
        return view('features.arsip.archive.archive-file-edit-form', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $file = ArchiveFile::findOrFail($id);

        if ($request->hasFile('file_archive')) {

            if ($file->file_path && Storage::disk('private')->exists($file->file_path)) {
                Storage::disk('private')->delete($file->file_path);
            }

            $uploaded = $request->file('file_archive');
            $filename = time() . '_' . $uploaded->getClientOriginalName();
            $uploaded->storeAs('archive', $filename, 'private');

            $path = 'archive/' . $filename;
        }

        $file->update([
            'folder_id' => $file->folder_id,
            'file_name' => $request->file_name,
            'file_path' => $path ?? '',
            'kode_klasifikasi' => $request->kode_klasifikasi,
            'indeks1' => $request->indeks1,
            'indeks2' => $request->indeks2,
            'no_item' => $request->no_item,
            'uraian' => $request->uraian,
            'no_spby' => $request->no_spby,
            'no_spm' => $request->no_spm,
            'jenis_spm' => $request->jenis_spm,
            'no_sp2d' => $request->no_sp2d,
            'nilai_sp2d' => $request->nilai_sp2d,
            'jenis_sp2d' => $request->jenis_sp2d,
            'tgl_sp2d' => $request->tgl_sp2d,
            'tgl_selesai_sp2d' => $request->tgl_selesai_sp2d,
            'no_invoice' => $request->no_invoice,
            'tgl_invoice' => $request->tgl_invoice,
            'tgl_terima' => $request->tgl_terima,
            'tingkat_pertimbangan' => $request->tingkat_pertimbangan,
            'jumlah_halaman' => $request->jumlah_halaman,
            'retensi_arsip_aktif' => $request->retensi_arsip_aktif,
            'retensi_arsip_inaktif' => $request->retensi_arsip_inaktif,
            'nasib_akhir_arsip' => $request->nasib_akhir_arsip,
            'klasifikasi_keamanan' => $request->klasifikasi_keamanan,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'link_arsip' => $request->link_arsip,
        ]);

        return redirect()->route('folder.show', ['folder' => $file->folder_id])->with('success', 'File berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $archive = ArchiveFile::findOrFail($id);

        if ($archive->file_path && Storage::disk('private')->exists($archive->file_path)) {
            Storage::disk('private')->delete($archive->file_path);
        }

        $archive->delete();

        return redirect()->route('folder.show', ['folder' => $archive->folder_id])->with('success', 'File berhasil Dihapus!');
    }
}
