<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit; // Pastikan Unit di-import

class HomeController extends Controller
{
    /**
     * Menampilkan Homepage (Landing Page).
     * Sekarang mengambil 3 unit "featured" dan data untuk pencarian.
     */
    public function index(Request $request)
    {
        // Ambil hingga 3 unit untuk "Featured Products" di landing page
        // Prioritaskan yang statusnya 'tersedia', jika kurang dari 3, lengkapi dari unit terbaru lainnya
        $featuredUnits = Unit::where('status', 'tersedia')
            ->latest()
            ->take(3)
            ->get();

        if ($featuredUnits->count() < 3) {
            $additionalUnits = Unit::whereNotIn('id', $featuredUnits->pluck('id'))
                ->latest()
                ->take(3 - $featuredUnits->count())
                ->get();
            $featuredUnits = $featuredUnits->concat($additionalUnits);
        }

        // Ambil semua unit untuk "Check Jadwal" (jika ada search)
        $query = Unit::query()->where('status', 'tersedia');
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_unit', 'like', '%'.$request->search.'%');
        }
        $units = $query->paginate(9); // 9 produk per halaman

        // Kirim kedua data ke view welcome
        return view('welcome', compact('featuredUnits', 'units'));
    }

    /**
     * Menampilkan halaman "Product" (Semua Produk).
     */
    public function products(Request $request)
    {
        // Logika sama seperti "Check Jadwal" di homepage
        $query = Unit::query()->where('status', 'tersedia');
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_unit', 'like', '%'.$request->search.'%');
        }
        $units = $query->paginate(12); // 12 produk per halaman

        // Kita perlu membuat file view baru untuk halaman ini
        // Sesuai rencana, kita akan buat file: resources/views/pages/products.blade.php
        return view('pages.products', compact('units'));
    }

    /**
     * Menampilkan halaman "About Us".
     */
    public function about()
    {
        // Kita perlu membuat file view baru untuk halaman ini
        // Sesuai rencana: resources/views/pages/about.blade.php
        return view('pages.about');
    }

    /**
     * Menampilkan halaman "Review".
     */
    public function reviews()
    {
        // Kita perlu membuat file view baru untuk halaman ini
        // Sesuai rencana: resources/views/pages/review.blade.php
        return view('pages.review');
    }

    /**
     * Menampilkan halaman statis (HANYA UNTUK USER LOGIN).
     */
    public function caraPemesanan()
    {
        return view('pages.cara-pemesanan');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Menampilkan halaman detail unit.
     */
    public function show(Unit $unit)
    {
        return view('pages.unit-detail', compact('unit'));
    }

    public function produk()
    {
        $units = \App\Models\Unit::all(); // Ambil semua data produk
        return view('pages.produk', compact('units'));
    }
}