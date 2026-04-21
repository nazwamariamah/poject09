<?php

namespace App\Http\Controllers\Features\Arsip\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\ArchiveFile;
use App\Models\Cabinet;
use App\Models\Category;
use App\Models\DocumentFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cabinets = Cabinet::all();

        // return view('admin.archive.archive-rack', compact('raks', 'categories'));
        return view('features.arsip.cabinet.cabinet', compact('cabinets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('features.arsip.cabinet.cabinet_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'code' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        Cabinet::create([
            'cabinet_name' => $request->name,
            'cabinet_code' => $request->code,
            'total_racks' => 0,
            'description' => $request->deskripsi,
        ]);

        return redirect()->route('cabinet.index')->with('success', 'Berhasil Menambahkan Cabinet');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cabinet = Cabinet::findOrFail($id);
        $result = Category::where('cabinet_id', $cabinet->id)->get(); // ambil category berdasarkan cabinet

        $categories = collect();
        $temp  = [];

        // ambil kategori kabinet dan yang sama dilewati
        foreach ($result as $category) {
            if (in_array($category->category_name, $temp)) {
                continue;
            }

            $temp[] = $category->category_name;
            $categories->push($category);
        }
        return view('features.arsip.category.category', compact('cabinet', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cabinet = Cabinet::findOrFail($id);

        return view('features.arsip.cabinet.cabinet_edit', compact('cabinet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'code' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $cabinet = Cabinet::findOrFail($id);

        $cabinet->update([
            'cabinet_name' => $request->name,
            'cabinet_code' => $request->code,
            'description' => $request->deskripsi,
        ]);

        return redirect()->route('cabinet.index')->with('success', 'Berhasil Mengupdate Cabinet');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cabinet = Cabinet::findOrFail($id);

        // 1. Ambil semua categories dalam cabinet ini
        $categoryIds = Category::where('cabinet_id', $cabinet->id)->pluck('id');

        if ($categoryIds->isNotEmpty()) {
            // 2. Ambil semua folders dari categories tersebut
            $folderIds = DocumentFolder::whereIn('category_id', $categoryIds)->pluck('id');

            if ($folderIds->isNotEmpty()) {
                // 3. Ambil semua files dari folders tersebut
                $files = ArchiveFile::whereIn('folder_id', $folderIds)->get();

                // 4. Delete physical files dari storage
                foreach ($files as $file) {
                    if (Storage::disk('private')->exists($file->file_path)) {
                        Storage::disk('private')->delete($file->file_path);
                    }
                }

                // 5. Delete records dari database (cascade dari bawah ke atas)
                ArchiveFile::whereIn('folder_id', $folderIds)->delete();
                DocumentFolder::whereIn('category_id', $categoryIds)->delete();
            }

            Category::where('cabinet_id', $cabinet->id)->delete();
        }

        // 6. Terakhir delete cabinet
        $cabinet->delete();

        return redirect()->route('cabinet.index')
            ->with('success', 'Berhasil menghapus Cabinet beserta seluruh isinya');
    }
}
