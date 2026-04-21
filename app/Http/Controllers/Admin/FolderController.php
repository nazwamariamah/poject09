<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArchiveFile;
use App\Models\Category;
use App\Models\DocumentFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FolderController extends Controller
{
    // store rak,folder sudah
    // show rak, folder sudah
    // create rak, folder sudah
    // update folder, rack sudah
    // edit folder, rack sudah
    // destroy folder, rack sudah
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
    public function create_rack($id) // id categori
    {
        $category = Category::findOrFail($id);
        return view('admin.input_archive.rack.form-create-rack', compact('category'));
    }

    public function create_folder($id)
    {
        $folder = DocumentFolder::findOrFail($id);
        return view('admin.input_archive.folder.form-create-folder', compact('folder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function add_rack(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        DocumentFolder::create([
            'category_id' => $request->year_id,
            'rack_name' => $request->name,
        ]);

        return redirect()->route('year.show', ['id' => $request->year_id])->with('success', 'Berhasil Menambahkan Rack');
    }

    public function add_folder(Request $request, $id)
    {
        $folder = DocumentFolder::findOrFail($id); // ambil id folder dari rak saat ini
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
        //
    }

    public function rack_show($id) // id folder saat ini
    {
        $rack = DocumentFolder::findOrFail($id); // ambil rak saat ini
        $folders = DocumentFolder::where('rack_name', $rack->rack_name)->where('category_id', $rack->category_id)->get(); // ambil folder berdasarkan nama rak dan id categori dari year saat ini
        return view('admin.input_archive.folder.archive-folder', compact('folders', 'rack'));
    }

    public function folder_show($id)
    {
        $folder = DocumentFolder::findOrFail($id);
        $archives = ArchiveFile::where('folder_id', $folder->id)->get();
        return view('admin.input_archive.document.archive-file', compact('archives', 'folder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_folder(string $id)
    {
        $folder = DocumentFolder::findOrFail($id);
        return view('admin.input_archive.folder.archive-folder-edit-form', compact('folder'));
    }

    public function edit_rack(string $id)
    {
        $rack = DocumentFolder::findOrFail($id);
        return view('admin.input_archive.rack.archive-rack-edit-form', compact('rack'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_folder(Request $request, string $id)
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
        return redirect()->route('rack.show', ['id' => $folder->id])->with('success', 'Berhasil Menambahkan Folder');
    }

    public function update_rack(Request $request, string $id)
    {
        $rack = DocumentFolder::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
        ]);

        $rack->update([
            'rack_name' => $request->name,
        ]);
        return redirect()->route('year.show', ['id' => $rack->category_id])->with('success', 'Berhasil Menambahkan Folder');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Helper method untuk delete files dari folders
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

    public function destroy_folder(string $id)
    {
        $folder = DocumentFolder::findOrFail($id);
        $categoryId = $folder->category_id;

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

        return redirect()->route('year.show', ['id' => $categoryId])
            ->with('success', $message);
    }

    public function destroy_rack(string $id)
    {
        $thisrack = DocumentFolder::findOrFail($id);
        $categoryId = $thisrack->category_id;

        // Cek berapa banyak distinct rack dalam category ini
        $countDistinctRacks = DocumentFolder::where('category_id', $thisrack->category_id)
            ->whereNotNull('rack_name')
            ->distinct('rack_name')
            ->count('rack_name');

        // Ambil semua folders dalam rack yang sama
        $racksAndFolders = DocumentFolder::where('category_id', $thisrack->category_id)
            ->where('rack_name', $thisrack->rack_name)
            ->get();

        $this->deleteFolderFiles($racksAndFolders->pluck('id')->toArray());

        // Jika cuma 1 rack tersisa, set rack_name jadi null
        if ($countDistinctRacks == 1) {
            DocumentFolder::where('category_id', $thisrack->category_id)
                ->where('rack_name', $thisrack->rack_name)
                ->update(['rack_name' => null]);
            $message = 'Berhasil menghapus Rack (diset null)';
        } else {
            // Kalau lebih dari 1, hapus semua folders dalam rack ini
            DocumentFolder::where('category_id', $thisrack->category_id)
                ->where('rack_name', $thisrack->rack_name)
                ->delete();
            $message = 'Berhasil menghapus Rack';
        }

        return redirect()->route('year.show', ['id' => $categoryId])
            ->with('success', $message);
    }
}
