<?php

namespace App\Http\Controllers\Features\Arsip\Rack;

use App\Http\Controllers\Controller;
use App\Models\ArchiveFile;
use App\Models\Category;
use App\Models\DocumentFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RackController extends Controller
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
        return view('features.arsip.rack.rack_create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        DocumentFolder::create([
            'category_id' => $request->year_id,
            'rack_name' => $request->name,
        ]);

        return redirect()->route('year.show', ['year' => $request->year_id])->with('success', 'Berhasil Menambahkan Rack');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rack = DocumentFolder::findOrFail($id); // ambil rak saat ini
        $folders = DocumentFolder::where('rack_name', $rack->rack_name)->where('category_id', $rack->category_id)->get(); // ambil folder berdasarkan nama rak dan id categori dari year saat ini
        return view('features.arsip.folder.archive-folder', compact('folders', 'rack'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rack = DocumentFolder::findOrFail($id);
        return view('features.arsip.rack.rack_edit', compact('rack'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rack = DocumentFolder::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
        ]);

        $rack->update([
            'rack_name' => $request->name,
        ]);
        return redirect()->route('year.show', ['year' => $rack->category_id])->with('success', 'Berhasil Menambahkan Folder');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
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

        return redirect()->route('year.show', ['year' => $categoryId])
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
