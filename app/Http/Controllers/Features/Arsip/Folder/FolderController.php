<?php

namespace App\Http\Controllers\Features\Arsip\Folder;

use App\Http\Controllers\Controller;
use App\Models\ArchiveFile;
use App\Models\DocumentFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FolderController extends Controller
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
        $rack = DocumentFolder::findOrFail($request->rack_id);
        return view('features.arsip.folder.form-create-folder', compact('rack'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $folder = DocumentFolder::findOrFail($request->rack_id); // ambil id folder dari rak saat ini
        if (isset($folder->folder_name)) { // jika rak saat ini sudah memiliki folder buat yang baru
            DocumentFolder::create([
                'category_id' => $folder->category_id,
                'rack_name' => $folder->rack_name,
                'folder_name' => $request->name,
                'description' => $request->deskripsi,
            ]);
        } else { // jika belum update rak saat ini
            $folder->update([
                'folder_name' => $request->name,
                'description' => $request->deskripsi,
            ]);
        }

        return redirect()->route('rack.show', ['rack' => $folder->id])->with('success', 'Berhasil Menambahkan Folder');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $folder = DocumentFolder::findOrFail($id);
        $archives = ArchiveFile::where('folder_id', $folder->id)->get();
        return view('features.arsip.archive.archive-file', compact('archives', 'folder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $folder = DocumentFolder::findOrFail($id);
        return view('features.arsip.folder.form-edit-folder', compact('folder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $folder = DocumentFolder::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
            'deskripsi' => 'required|string'
        ]);

        $folder->update([
            'folder_name' => $request->name,
            'description' => $request->deskripsi,
        ]);
        return redirect()->route('rack.show', ['rack' => $folder->id])->with('success', 'Berhasil Menambahkan Folder');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $folder = DocumentFolder::findOrFail($id);
        $categoryId = $folder->category_id;
        $rack = $folder->rack_name;

        // Cek berapa banyak folder dalam rack yang sama
        $countSameRack = DocumentFolder::where('category_id', $folder->category_id)
            ->where('rack_name', $folder->rack_name)
            ->count();

        // Jika cuma 1 folder di rack ini, set folder_name jadi null aja
        if ($countSameRack == 1) {
            $this->deleteFolderFiles([$folder->id]);
            $folder->update(['folder_name' => null]);
            $message = 'Berhasil menghapus Folder (diset null)';
        } else {
            // Kalau lebih dari 1, baru hapus
            $this->deleteFolderFiles([$folder->id]);
            $folder->delete();
            $message = 'Berhasil menghapus Folder';
        }

        $rackobj = DocumentFolder::where('category_id', $categoryId)->where('rack_name', $rack)->first();

        return redirect()->route('rack.show', ['rack' => $rackobj->id])
            ->with('success', $message);
    }

    private function deleteFolderFiles($folderIds)
    {
        if (empty($folderIds)) return;

        $files = ArchiveFile::whereIn('folder_id', $folderIds)->get();

        foreach ($files as $file) {
            if (Storage::disk('private')->exists($file->file_path)) {
                Storage::disk('private')->delete($file->file_path);
            }
        }
    }
}
