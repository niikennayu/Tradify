<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserRentalController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RentalReportController;
use Illuminate\Support\Facades\Route;


// =================================================================
// RUTE LANDING PAGE (SAAT LOGOUT)
// =================================================================
Route::get('/', [HomeController::class, 'index'])->name('home');
// Ini adalah rute yang akan memperbaiki error Anda:
Route::get('/products', [HomeController::class, 'products'])->name('products.index');
Route::get('/about-us', [HomeController::class, 'about'])->name('about');
Route::get('/reviews', [HomeController::class, 'reviews'])->name('reviews');

// Rute statis lama (sekarang hanya untuk user yang login)
Route::get('/cara-pemesanan', [HomeController::class, 'caraPemesanan'])->name('cara.pemesanan');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Rute detail unit (bisa diakses publik)
Route::get('/unit/{unit}', [HomeController::class, 'show'])->name('unit.show');
Route::get('/produk', [HomeController::class, 'produk'])->name('produk');



// =================================================================
// RUTE YANG BUTUH LOGIN (USER BIASA & ADMIN)
// =================================================================
Route::middleware('auth')->group(function () {
    // Dashboard User (Dibedakan: admin diarahkan ke /admin)
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            // Kalau admin login, langsung arahkan ke dashboard admin
            return redirect()->route('admin.dashboard');
        }
        // Kalau bukan admin, tampilkan dashboard penyewa
        return app(UserRentalController::class)->index();
    })->name('dashboard');
    
    // Proses menyewa unit
    Route::post('/sewa/{unit}', [UserRentalController::class, 'sewa'])->name('sewa.store');

    // Profile (Ubah data user)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// =================================================================
// RUTE KHUSUS ADMIN
// =================================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard utama admin diarahkan ke laporan rental
    Route::get('/', [RentalReportController::class, 'index'])->name('dashboard');
    
    // CRUD Unit
    Route::resource('units', UnitController::class);
    // CRUD Category
    Route::resource('categories', CategoryController::class);
    // CRUD User
    Route::resource('users', UserController::class);

    // Laporan
    Route::get('rentals', [RentalReportController::class, 'index'])->name('rentals.index');
    Route::get('rentals/user/{user}', [RentalReportController::class, 'showUserHistory'])->name('rentals.userHistory');
    Route::get('rentals/print/{user}', [RentalReportController::class, 'printUserHistory'])->name('rentals.printHistory');
    
    // Pengembalian
    Route::post('rentals/return/{rental}', [RentalReportController::class, 'processReturn'])->name('rentals.return');
});


// =================================================================
// AUTH ROUTES (LOGIN, REGISTER, DLL.)
// =================================================================
require __DIR__.'/auth.php';
