<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ManualBookingController;
use App\Http\Controllers\Admin\ProductImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman landing tamu
Route::get('/', [GuestController::class, 'index'])->name('home');

// Detail produk (akses publik, tamu & user bisa lihat)
Route::get('/produk/{slug}', [GuestController::class, 'show'])->name('produk.detail');

// Setelah login, redirect sesuai role
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Area login & user
Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin area
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');

        // CRUD Produk
        Route::resource('products', ProductController::class);

        // CRUD Gambar Produk
        Route::delete('/products/images/{id}', [ProductController::class, 'destroyImage'])->name('products.images.destroy');
        Route::delete('/products/images/bulk-delete', [ProductImageController::class, 'bulkDelete'])->name('products.images.bulkDelete');
        Route::post('/products/images/reorder', [ProductImageController::class, 'reorder'])->name('products.images.reorder');

        // Manual Booking
        Route::get('/bookings', [ManualBookingController::class, 'index'])->name('blocking.index');
        Route::get('/bookings/create', [ManualBookingController::class, 'create'])->name('blocking.create');
        Route::post('/bookings', [ManualBookingController::class, 'store'])->name('blocking.store');
        Route::delete('/bookings/{id}', [ManualBookingController::class, 'destroy'])->name('blocking.destroy');
        Route::delete('/bookings/batch-destroy', [ManualBookingController::class, 'batchDestroy'])->name('blocking.batchDestroy');
        Route::get('/bookings/unavailable-dates/{product}', [ManualBookingController::class, 'getUnavailableDates'])->name('bookings.unavailable-dates');

        // Export PDF
        Route::get('/bookings/export/aktif', [ManualBookingController::class, 'exportAktif'])->name('blocking.export.aktif');
        Route::get('/bookings/export/riwayat', [ManualBookingController::class, 'exportRiwayat'])->name('blocking.export.riwayat');

        // Manajemen User
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

// Auth bawaan Laravel
require __DIR__.'/auth.php';
