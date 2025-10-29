<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori (Req #10)
     */
    public function index()
    {
        $categories = Category::latest()->get();
        // Anda perlu membuat file view: resources/views/admin/categories/index.blade.php
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru
     */
    public function create()
    {
        // Anda perlu membuat file view: resources/views/admin/categories/create.blade.php
        return view('admin.categories.create');
    }

    /**
     * Menyimpan kategori baru ke database (Req #10)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories|max:255', // Validasi (Req #17)
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambah.');
    }

    /**
     * Menampilkan form untuk mengedit kategori
     */
    public function edit(Category $category)
    {
        // Anda perlu membuat file view: resources/views/admin/categories/edit.blade.php
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Mengupdate data kategori di database (Req #10)
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)],
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori dari database (Req #10)
     */
    public function destroy(Category $category)
    {
        // Tambahan: Cek dulu apakah kategori ini dipakai oleh unit
        if ($category->units()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Tidak bisa menghapus kategori yang sedang digunakan oleh unit.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}