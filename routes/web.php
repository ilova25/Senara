<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

// Redirect root ke home
Route::get('/', function () {
    return redirect()->route('home');
});

// Halaman publik
Route::view('/home', 'home')->name('home');
Route::view('/rooms', 'rooms')->name('rooms');
Route::view('/facilities', 'facilities')->name('facilities');
Route::view('/payment', 'payment')->name('payment');
Route::view('/profile', 'profile')->name('profile');

// Halaman tambahan (footer link)
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');
Route::view('/faq', 'faq')->name('faq');
Route::view('/cancellation', 'cancellation')->name('cancellation');

// Newsletter subscribe
Route::post('/newsletter/subscribe', function (\Illuminate\Http\Request $request) {
    $request->validate(['email' => 'required|email']);
    // simpan ke database atau kirim notifikasi
    return back()->with('newsletter_success', 'Terima kasih sudah berlangganan!');
})->name('newsletter.subscribe');

// Login & Register (hanya untuk guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [SesiController::class, 'formLogin'])->name('login');
    Route::post('/login', [SesiController::class, 'prosesLogin'])->name('login.post');

    Route::get('/register', [SesiController::class, 'formRegister'])->name('register');
    Route::post('/register', [SesiController::class, 'prosesRegister'])->name('register.post');
});

// Area yang butuh login
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Booking
    Route::get('/booking', [SesiController::class, 'booking'])->name('booking');

    // Fasilitas
    Route::resource('/admin/fasilitas', FasilitasController::class);

    // Unit
    Route::resource('/admin/unit', UnitController::class);

    // Pegawai
    Route::resource('/admin/pegawai', OwnerController::class);

    // Logout
    Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
});
