<?php

namespace App\Http\Controllers\Features\Arsip\Category;

use App\Http\Controllers\Controller;
use App\Models\ArchiveFile;
use App\Models\Cabinet;
use App\Models\Category;
use App\Models\DocumentFolder;
use App\Models\FundingSource;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // if ($request->filled('id_cabinet')) {
        //     $id = $request->query('id_cabinet');
        // } else {
        //     $id = $request->id_cabinet;
        // }
        $id = $request->id_cabinet;
        $cabinet = Cabinet::findOrFail($id);
        $result = Category::where('cabinet_id', $cabinet->id)->get(); // ambil category berdasarkan cabinet

        $categories = collect();
        $temp  = [];

        // ambil kategori yang sama dilewati
        foreach ($result as $category) {
            if (in_array($category->category_name, $temp)) {
                continue;
            }

            $temp[] = $category->category_name;
            $categories->push($category);
        }

        return view('features.arsip.category.category_list', compact('categories', 'cabinet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $cabinet = Cabinet::findOrFail($request->cabinet_id);
        $payment = PaymentMethod::all();
        $funding = FundingSource::all();

        return view('features.arsip.category.category-create', compact('cabinet', 'payment', 'funding'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cabinet_id' => 'required|exists:cabinets,id',
            'name'       => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'url'        => 'nullable|string',
        ]);

        // $code = strtoupper(Str::slug($request->name, '-'));
        // Category::create([
        //     'cabinet_id' => $request->cabinet_id,
        //     'category_name' => $request->name,
        //     'category_code' => $code,
        //     'name' => 'required|string',
        //     'payment_method' => 'nullable',
        //     'funding_source' => 'nullable',
        //     'deskripsi' => 'nullable|string',
        //     'url' => 'nullable|string',
        // ]);

        Category::create([
            'cabinet_id' => $request->cabinet_id,
            'category_name' => $request->name,
            'description' => $request->deskripsi,
            'payment_method_id' => $request->payment_method,
            'funding_source_id' => $request->funding_source,
            'url_icon' => $request->url,
        ]);

        return redirect()->route('category.index', ['id_cabinet' => $request->cabinet_id])->with('success', 'Berhasil Membuat Category');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id); // category yang dipilih
        // $cabinet = Cabinet::findOrFail($category->cabinet_id);
        if (isset($category->sub_category)) {
            $result = Category::where('category_name', $category->category_name)->get(); // ambil sub category dari category

            $subcategories = collect();
            $temp  = [];

            // ambil sub kategori dari category dan yang sama dilewati
            foreach ($result as $category) {
                if (in_array($category->sub_category, $temp)) { // cek jika sub Kategori sudah ada maka lewati
                    continue;
                }

                $temp[] = $category->sub_category; // simpan sub kategori dalam memori
                $subcategories->push($category);
            }
            return view('features.arsip.sub_category.sub_category', compact('subcategories', 'category'));
        } else {
            $years = Category::where('category_name', $category->category_name)->get(); // cari tahun berdasarkan categori
            return view('features.arsip.year.year', compact('years', 'category'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $cabinet = Cabinet::findOrFail($category->cabinet_id);
        $payment = PaymentMethod::all();
        $funding = FundingSource::all();

        return view('features.arsip.category.category-edit', compact(
            'category',
            'cabinet',
            'payment',
            'funding',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'payment_method' => 'nullable',
            'funding_source' => 'nullable',
        ]);

        $category = Category::findOrFail($id);
        $cabinetId = $category->cabinet_id;
        $oldCategoryName = $category->category_name;
        $newCategoryName = $request->name;

        // Update semua records dengan category_name yang sama di cabinet yang sama
        // Termasuk yang punya sub_category dan year berbeda
        Category::where('cabinet_id', $category->cabinet_id)
            ->where('category_name', $oldCategoryName)
            ->update(['category_name' => $newCategoryName, 'payment_method_id' => $request->payment_method, 'funding_source_id' => $request->funding_source]);

        // Update juga di field sub_category yang mereferensi category_name ini
        // Category::where('cabinet_id', $category->cabinet_id)
        //     ->where('sub_category', $oldCategoryName)
        //     ->update(['sub_category' => $newCategoryName]);

        return redirect()->route('category.index', ['id_cabinet' => $cabinetId])
            ->with('success', 'Berhasil edit Category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $cabinetId = $category->cabinet_id;

        // Ambil semua records dengan category_name yang sama
        $categories = Category::where('cabinet_id', $category->cabinet_id)
            ->where('category_name', $category->category_name)
            ->get();

        $this->deleteRelatedFiles($categories->pluck('id')->toArray());

        // Hapus semua category beserta sub_category dan year-nya
        Category::where('cabinet_id', $category->cabinet_id)
            ->where('category_name', $category->category_name)
            ->delete();

        return redirect()->route('cabinet.show', ['cabinet' => $cabinetId])
            ->with('success', 'Berhasil menghapus Category');
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
