<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Untuk validasi unique

class UnitController extends Controller
{
    /**
     * Menampilkan daftar semua unit (Req #10)
     */
    public function index()
    {
        $units = Unit::with('categories')->latest()->get();
        // Anda perlu membuat file view: resources/views/admin/units/index.blade.php
        return view('admin.units.index', compact('units'));
    }

    /**
     * Menampilkan form untuk membuat unit baru
     */
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori untuk ditampilkan di form
        // Anda perlu membuat file view: resources/views/admin/units/create.blade.php
        return view('admin.units.create', compact('categories'));
    }

    /**
     * Menyimpan unit baru ke database (Req #10, #17)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_unit' => 'required|string|unique:units', // Validasi unik (Req #8a, #17)
            'nama_unit' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:tersedia,disewa,perawatan',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'categories' => 'required|array', // Req #7
            'categories.*' => 'exists:categories,id' // Pastikan ID kategori valid
        ]);

        // Handle image upload (optional)
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $extension = $imageFile->getClientOriginalExtension();
            $finalName = $request->kode_unit . '.' . strtolower($extension);
            $targetDir = public_path('images/units');
            if (! is_dir($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $imageFile->move($targetDir, $finalName);
            $validated['image_path'] = 'images/units/' . $finalName;
        }

        $unit = Unit::create($validated);
        $unit->categories()->sync($request->categories); // Simpan relasi kategori (Req #7)

        return redirect()->route('admin.units.index')->with('success', 'Unit berhasil ditambah.');
    }

    /**
     * Menampilkan detail 1 unit (Opsional, tapi baik untuk ada)
     */
    public function show(Unit $unit)
    {
        // Anda perlu membuat file view: resources/views/admin/units/show.blade.php
        return view('admin.units.show', compact('unit'));
    }

    /**
     * Menampilkan form untuk mengedit unit
     */
    public function edit(Unit $unit)
    {
        $categories = Category::all();
        // Anda perlu membuat file view: resources/views/admin/units/edit.blade.php
        return view('admin.units.edit', compact('unit', 'categories'));
    }

    /**
     * Mengupdate data unit di database (Req #10)
     */
    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            // Validasi unik, tapi abaikan ID unit ini sendiri
            'kode_unit' => ['required', 'string', Rule::unique('units')->ignore($unit->id)],
            'nama_unit' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:tersedia,disewa,perawatan',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        // If kode_unit changes and we upload file, use new kode
        $kodeUnitForName = $validated['kode_unit'];

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $extension = $imageFile->getClientOriginalExtension();
            $finalName = $kodeUnitForName . '.' . strtolower($extension);
            $targetDir = public_path('images/units');
            if (! is_dir($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $imageFile->move($targetDir, $finalName);
            $validated['image_path'] = 'images/units/' . $finalName;
        }

        $unit->update($validated);
        $unit->categories()->sync($request->categories); // Update relasi kategori

        return redirect()->route('admin.units.index')->with('success', 'Unit berhasil diperbarui.');
    }

    /**
     * Menghapus unit dari database (Req #10)
     */
    public function destroy(Unit $unit)
    {
        // Tambahan: Cek dulu apakah unit sedang disewa?
        if ($unit->status == 'disewa') {
            return redirect()->route('admin.units.index')->with('error', 'Tidak bisa menghapus unit yang sedang disewa.');
        }

        $unit->categories()->detach(); // Hapus relasi pivot
        $unit->delete();

        return redirect()->route('admin.units.index')->with('success', 'Unit berhasil dihapus.');
    }
}
