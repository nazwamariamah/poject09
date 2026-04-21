<?php

namespace App\Http\Controllers\Features\Arsip\SubCategory;

use App\Http\Controllers\Controller;
use App\Models\ArchiveFile;
use App\Models\Category;
use App\Models\DocumentFolder;
use App\Models\FundingSource;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
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
        $payment = PaymentMethod::all();
        $funding = FundingSource::all();
        return view('features.arsip.sub_category.sub_category_create', compact('category', 'payment', 'funding'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::findOrFail($request->category_id); // category saat ini
        $request->validate([
            'name' => 'required|string',
            'payment_method' => 'nullable',
            'funding_source' => 'nullable',
        ]);

        if (isset($category->sub_category)) { // jika categori saat ini sudah memiliki sub kategori maka buat yang baru
            Category::create([
                'cabinet_id' => $category->cabinet_id,
                'category_name' => $category->category_name,
                'payment_method_id' => $request->payment_method,
                'funding_source_id' => $request->funding_source,
                'sub_category' => $request->name,
            ]);
        } else {
            $category->update([ // jika belum punya update category saat ini
                'sub_category' => $request->name,
                'payment_method_id' => $request->payment_method,
                'funding_source_id' => $request->funding_source,
            ]);
        }

        return redirect()->route('category.show', ['category' => $category->id])->with('success', 'Berhasil Menambahkan Sub Category');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id); // ambil category dari sub category saat ini
        $years = Category::where('sub_category', $category->sub_category)->get();
        return view('features.arsip.year.year', compact('years', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $subcategory = Category::findOrFail($id);
        $category = Category::findOrFail($request->category_id);
        $payment = PaymentMethod::all();
        $funding = FundingSource::all();
        return view('features.arsip.sub_category.sub_category_edit', compact('subcategory', 'payment', 'funding', 'category'));
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

        $category = Category::findOrFail($request->category_id);
        $subcategory = Category::findOrFail($id);
        $cabinetId = $subcategory->cabinet_id;

        $oldSubCategory = $subcategory->sub_category;
        $newSubCategory = $request->name;

        // Cek duplikat
        // $exists = Category::where('cabinet_id', $subcategory->cabinet_id)
        //     ->where('category_name', $subcategory->category_name)
        //     ->where('sub_category', $newSubCategory)
        //     ->exists();

        // if ($exists) {
        //     return redirect()
        //         ->route('cabinet.show', ['cabinet' => $cabinetId])
        //         ->with('error', 'Sub Category dengan nama ini sudah ada di Category yang sama');
        // }

        // UPDATE
        Category::where('cabinet_id', $subcategory->cabinet_id)
            ->where('category_name', $subcategory->category_name)
            ->where('sub_category', $oldSubCategory)
            ->update([
                'sub_category'  => $newSubCategory,
                'payment_method_id' => $request->payment_method,
                'funding_source_id' => $request->funding_source,
            ]);

        return redirect()
            ->route('category.show', ['category' => $category->id])
            ->with('success', 'Berhasil edit Sub Category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = Category::findOrFail($id);
        $cabinetId = $subcategory->cabinet_id;

        // Cek berapa banyak sub_category dengan category_name yang sama
        $countSameCategory = Category::where('cabinet_id', $subcategory->cabinet_id)
            ->where('category_name', $subcategory->category_name)
            ->whereNotNull('sub_category')
            ->distinct('sub_category')
            ->count('sub_category');

        // Ambil semua years dengan sub_category yang sama
        $years = Category::where('cabinet_id', $subcategory->cabinet_id)
            ->where('sub_category', $subcategory->sub_category)
            ->where('category_name', $subcategory->category_name)
            ->get();

        $this->deleteRelatedFiles($years->pluck('id')->toArray());

        // Jika cuma 1 sub_category tersisa, set null aja
        if ($countSameCategory == 1) {
            Category::where('cabinet_id', $subcategory->cabinet_id)
                ->where('sub_category', $subcategory->sub_category)
                ->update(['sub_category' => null]);
            $message = 'Berhasil menghapus Sub Category (diset null)';
        } else {
            // Kalau lebih dari 1, hapus semua years dengan sub_category ini
            Category::where('cabinet_id', $subcategory->cabinet_id)
                ->where('sub_category', $subcategory->sub_category)
                ->delete();
            $message = 'Berhasil menghapus Sub Category';
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
