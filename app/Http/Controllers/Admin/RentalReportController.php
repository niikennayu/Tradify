<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalReportController extends Controller
{
    /**
     * Dashboard utama admin.
     * Admin dapat melihat semua penyewaan aktif dan daftar user yang memiliki riwayat.
     */
    public function index()
    {
        // Ambil data rental aktif
        $activeRentals = Rental::with(['user', 'unit'])
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil user yang memiliki riwayat rental
        $usersWithHistory = User::whereHas('rentals')->get();

        return view('admin.rentals.index', compact('activeRentals', 'usersWithHistory'));
    }

    /**
     * Proses pengembalian unit sewaan.
     * Admin dapat memproses penyelesaian penyewaan dan menghitung denda otomatis.
     */
    public function processReturn(Rental $rental)
    {
        $dueDate = Carbon::parse($rental->due_date);
        $returnDate = Carbon::now();

        $fineAmount = 0;
        $status = 'selesai';

        // Hitung denda jika terlambat
        if ($returnDate->gt($dueDate)) {
            $daysLate = $returnDate->diffInDays($dueDate);
            $finePerDay = 50000; // Bisa diatur sesuai kebijakan
            $fineAmount = $daysLate * $finePerDay;
            $status = 'selesai_terlambat';
        }

        // Update data rental
        $rental->update([
            'return_date' => $returnDate,
            'fine_amount' => $fineAmount,
            'status' => $status,
        ]);

        // Kembalikan status unit menjadi tersedia
        $rental->unit->update(['status' => 'tersedia']);

        // Pesan sukses
        $message = $fineAmount > 0
            ? "Unit dikembalikan terlambat. Denda: Rp " . number_format($fineAmount, 0, ',', '.')
            : "Unit berhasil dikembalikan tepat waktu.";

        return redirect()->route('admin.rentals.index')->with('success', $message);
    }

    /**
     * Menampilkan riwayat rental untuk satu user.
     * Admin dapat melihat semua penyewaan user termasuk yang sudah selesai.
     */
    public function showUserHistory(User $user)
    {
        $rentals = Rental::with('unit')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.rentals.history', compact('user', 'rentals'));
    }

    /**
     * Halaman versi cetak riwayat penyewaan user.
     */
    public function printUserHistory(User $user)
    {
        $rentals = Rental::with('unit')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.rentals.print', compact('user', 'rentals'));
    }

    /**
     * (Opsional) Filter laporan berdasarkan tanggal.
     * Berguna jika admin ingin melihat laporan mingguan/bulanan.
     */
    public function filter(Request $request)
    {
        $startDate = $request->input('start_date')
            ? Carbon::parse($request->input('start_date'))->startOfDay()
            : Carbon::minValue();

        $endDate = $request->input('end_date')
            ? Carbon::parse($request->input('end_date'))->endOfDay()
            : Carbon::now();

        $rentals = Rental::with(['user', 'unit'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.rentals.filtered', compact('rentals', 'startDate', 'endDate'));
    }
}