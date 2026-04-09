<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CategoryController;
use Filament\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InvoiceController;


// Route::middleware(['web'])->group(function () {
//     Route::get('/admin/login', [LoginController::class, 'create'])->name('filament.admin.auth.login');
//     Route::post('/admin/login', [LoginController::class, 'store']);
// });
// Route::post('/admin/logout', function () {
//     auth()->logout();
//     request()->session()->invalidate();
//     request()->session()->regenerateToken();
//     return redirect('/admin/login');
// })->name('admin.logout');


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');

Route::middleware(['auth', 'user.only'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');
    Route::get('aboutus', [DashboardController::class, 'aboutus'])
        ->middleware(['auth', 'verified'])
        ->name('aboutus');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori.semua');
Route::get('/kategori/{id}', [CategoryController::class, 'show'])->name('kategori.show');

// Tampilkan halaman detail kamar dengan modal pemesanan
Route::get('/rooms/{id}', [App\Http\Controllers\BookingController::class, 'show'])->name('rooms.show');

// Proses pemesanan
Route::post('/bookings', [App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store')->middleware('auth');

// Halaman sukses pemesanan
Route::get('/bookings/success', [App\Http\Controllers\BookingController::class, 'success'])->name('bookings.success');


Route::middleware('auth')->group(function () {
    // Daftar pesanan user
    Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'index'])->name('bookings.index');
    
    // Detail pesanan
    Route::get('/bookings/{id}', [App\Http\Controllers\BookingController::class, 'detail'])->name('bookings.detail');
    
    // Proses pemesanan
    Route::post('/bookings', [App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
});


require __DIR__.'/auth.php';
