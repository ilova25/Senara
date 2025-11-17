<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\MasukanController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

// Redirect root ke home
Route::get('/', [SesiController::class, 'home'])->name('home');

// Halaman publik
Route::get('/unit', [UnitController::class, 'UnitUser'])->name('unit');
Route::get('/facilities', [FasilitasController::class, 'FasilitasUser'])->name('facilities');


Route::get('/booking/history', function(){
    return view('booking_history');
})->name('booking.history');

Route::get('/double/profil2', function(){
    return view('double.profile2');
})->name('double.profile2');

Route::get('/booking/detail', function(){
    return view('detail_booking');
})->name('detail_booking');

// Halaman tambahan (footer link)
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

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// Area yang butuh login
Route::middleware('auth')->group(function () {
    // Dashboard dan profil

    Route::get('/profile/{id}', [ProfilController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfilController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfilController::class, 'updatePassword'])->name('profile.updatePassword');

    // Booking dan Payment
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create'); // untuk form booking
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store'); // untuk submit booking
    
    Route::get('/admin/kalender', [KalenderController::class, 'index'])->name('admin.kalender');
    Route::get('/admin/kalender/bookings', [KalenderController::class, 'getBookings'])->name('kalender.bookings');
    Route::get('/payment/{id}', [BookingController::class, 'payment'])->name('payment');
    Route::get('/detail_booking/{id}', [BookingController::class, 'detail'])->name('detil');
    Route::get('/check-availability', [BookingController::class, 'checkAvailability'])->name('check.availability');
    Route::put('/admin/booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');
    Route::get('/booking/{id}', [BookingController::class, 'exportPdf'])->name('booking.pdf');
    Route::get('/booking/history', [BookingController::class, 'history'])->name('booking.history');
    Route::put('/admin/booking/{id}/status_pemesanan', [BookingController::class, 'updatePesanan'])->name('booking.updatePesanan');

    // payment
    Route::get('/payment_upload/{id}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment_upload/{id}', [PaymentController::class, 'store'])->name('payment.store');

    // masukan
    Route::post('/masukan', [MasukanController::class, 'store'])->name('masukan.store');
    Route::get('/admin/masukan', [MasukanController::class,'admin'])->name('masukan.admin');

    

    // Logout
    Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
});

// Fasilitas (CRUD)
    Route::resource('/admin/fasilitas', FasilitasController::class);

    // Unit (CRUD)
    Route::resource('/admin/unit', UnitController::class);

    // Pegawai (CRUD)
    Route::resource('/admin/pegawai', OwnerController::class);
Route::get('/admin/booking', [BookingController::class, 'admin'])->name('booking.admin');