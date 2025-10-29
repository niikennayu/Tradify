<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Pastikan Carbon di-import untuk menghitung tanggal

class UserRentalController extends Controller
{
    /**
     * Display the user's dashboard with their active rentals.
     * (Req #15)
     * * INI ADALAH FUNGSI YANG MEMPERBAIKI ERROR ANDA
     */
    public function index()
    {
        // Ambil data peminjaman HANYA untuk user yang sedang login
        // Kita juga 'eager load' relasi 'unit' agar lebih efisien
        $rentals = Rental::with('unit')
                        ->where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Kirim data $rentals ke view 'dashboard' menggunakan compact()
        // Inilah yang akan memperbaiki error "Undefined variable $rentals"
        return view('dashboard', compact('rentals'));
    }

    /**
     * Process the rental request from a user.
     * (Req #11, #12)
     */
    public function sewa(Unit $unit)
    {
        $userId = Auth::id();

        // 1. Cek apakah unit tersedia
        if ($unit->status != 'tersedia') {
            return redirect()->route('dashboard')->with('error', 'Maaf, unit ini sedang tidak tersedia.');
        }

        // 2. Cek apakah user sudah meminjam 2 unit (Req #11)
        $activeRentalsCount = Rental::where('user_id', $userId)
                                    ->where('status', 'dipinjam')
                                    ->count();

        if ($activeRentalsCount >= 2) {
            return redirect()->route('dashboard')->with('error', 'Anda sudah mencapai batas maksimal 2 unit peminjaman aktif.');
        }

        // 3. Jika lolos, buat data rental baru
        Rental::create([
            'user_id' => $userId,
            'unit_id' => $unit->id,
            'rental_date' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(5), // Req #12 (maksimal 5 hari)
            'status' => 'dipinjam',
        ]);

        // 4. Ubah status unit menjadi 'disewa'
        $unit->status = 'disewa';
        $unit->save();

        // 5. Redirect ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Berhasil menyewa unit! Harap kembalikan sebelum 5 hari.');
    }
}