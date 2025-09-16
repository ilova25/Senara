<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// Redirect root ke home
Route::get('/', [SesiController::class, 'home'])->name('home');

// Halaman publik
Route::get('/unit', [UnitController::class, 'UnitUser'])->name('unit');
Route::get('/facilities', [FasilitasController::class, 'FasilitasUser'])->name('facilities');
Route::get('/payment_upload', function(){
    return view('payment_upload');
})->name('payment_upload');

// Halaman tambahan (footer link)
Route::view('/profile', 'profile')->name('profile');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');
Route::view('/faq', 'faq')->name('faq');
Route::view('/cancellation', 'cancellation')->name('cancellation');

// Newsletter subscribe
Route::post('/newsletter/subscribe', function (\Illuminate\Http\Request $request) {
    $request->validate(['email' => 'required|email']);
    // TODO: simpan ke database atau kirim notifikasi
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

    // Booking dan Payment
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create'); // untuk form booking
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store'); // untuk submit booking
    Route::get('/admin/booking', [BookingController::class, 'admin'])->name('booking.admin');
    Route::get('/payment/{id}', [BookingController::class, 'payment'])->name('payment');
    Route::get('/detail_booking/{id}', [BookingController::class, 'detail'])->name('detil');

    // Fasilitas (CRUD)
    Route::resource('/admin/fasilitas', FasilitasController::class);

    // Unit (CRUD)
    Route::resource('/admin/unit', UnitController::class);

    // Pegawai (CRUD)
    Route::resource('/admin/pegawai', OwnerController::class);

    // Logout
    Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
});
