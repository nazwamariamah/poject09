<?php

namespace App\Http\Controllers\Features\Arsip\Year;

use App\Http\Controllers\Controller;
use App\Models\ArchiveFile;
use App\Models\Category;
use App\Models\DigitalArchive;
use App\Models\DocumentFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class YearController extends Controller
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
        return view('features.arsip.year.year_create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::findOrFail($request->category_id); // ambil categori saat ini bisa dari kategori langsung atau dari sub kateogori
        $request->validate([
            'year' => 'required|string',
        ]);

        if (isset($category->year)) { // jika kategori saat ini sudah punya year maka buat yang baru
            Category::create([
                'cabinet_id' => $category->cabinet_id,
                'category_name' => $category->category_name,
                'sub_category' => $category->sub_category,
                'category_code' => $category->category_code,
                'year' => $request->year,
            ]);
        } else {
            $category->update([ // jika belum update categori saat ini
                'year' => $request->year,
            ]);
        }
        return redirect()->route('subcategory.show', ['subcategory' => $category->id])->with('success', 'Berhasil Menambahkan Tahun');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id); // ambil categori saat ini dari year
        $result = DocumentFolder::with('category')
            ->where('category_id', $category->id)
            ->get(); // ambil rak berdasarkan category id

        $racks = collect();
        $temp  = [];

        foreach ($result as $rak) {
            if (in_array($rak->rack_name, $temp)) { // cek jika rak sudah ada maka lewati
                continue;
            }

            $temp[] = $rak->rack_name; // tambahkan rak dalam temp
            $racks->push($rak);
        }
        $digitalarchive = DigitalArchive::where('category_id', $category->id)->latest()->paginate(10, ['*'], 'digital_arsip');
        // if ($category->payment_method_id !== null) {
        // } else if ($category->funding_source_id !== null) {
        //     $digitalarchive = DigitalArchive::where('category_funding_id', $category->id)->get();
        // }
        return view('features.arsip.rack.archive-rack', compact('racks', 'category', 'digitalarchive'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $year = Category::findOrFail($id);
        return view('features.arsip.year.year_edit', compact('year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 10)
        ]);

        $year = Category::findOrFail($id);
        $cabinetId = $year->cabinet_id;

        // Cek apakah kombinasi baru sudah ada
        $exists = Category::where('cabinet_id', $year->cabinet_id)
            ->where('category_name', $year->category_name)
            ->where('sub_category', $year->sub_category)
            ->where('year', $request->year)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->route('subcategory.show', ['subcategory' => $year->id])
                ->with('error', 'Year dengan kombinasi ini sudah ada');
        }

        // Update hanya year ini saja (tidak mass update)
        $year->update(['year' => $request->year]);

        return redirect()->route('subcategory.show', ['subcategory' => $year->id])
            ->with('success', 'Berhasil edit tahun');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $year = Category::findOrFail($id);
        $cabinetId = $year->cabinet_id;

        // Cek berapa banyak year dengan sub_category yang sama
        $countSameSubCategory = Category::where('cabinet_id', $year->cabinet_id)
            ->where('sub_category', $year->sub_category)
            ->where('category_name', $year->category_name)
            ->count();

        // Jika cuma 1, set year jadi null aja, jangan dihapus
        if ($countSameSubCategory == 1) {
            $this->deleteRelatedFiles([$year->id]);
            $year->update(['year' => null]);
            $message = 'Berhasil menghapus Year (diset null)';
        } else {
            // Kalau lebih dari 1, baru hapus
            $this->deleteRelatedFiles([$year->id]);
            $year->delete();
            $message = 'Berhasil menghapus Year';
        }

        return redirect()->route('cabinet.show', ['cabinet' => $cabinetId])
            ->with('success', $message);
    }

    private function deleteRelatedFiles($categoryIds)
    {
        $folders = DocumentFolder::whereIn('category_id', $categoryIds)->pluck('id');

        if ($folders->isEmpty()) return;

        $files = ArchiveFile::whereIn('folder_id', $folders)->get();

        foreach ($files as $file) {
            if (Storage::disk('private')->exists($file->file_path)) {
                Storage::disk('private')->delete($file->file_path);
            }
        }
    }
}
