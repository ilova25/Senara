<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\InformasiController;
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

// // Newsletter subscribe
// Route::post('/newsletter/subscribe', function (\Illuminate\Http\Request $request) {
//     $request->validate(['email' => 'required|email']);
//     // TODO: simpan ke database atau kirim notifikasi
//     return back()->with('newsletter_success', 'Terima kasih sudah berlangganan!');
// })->name('newsletter.subscribe');


    Route::get('/unit/detail/{id}', [UnitController::class, 'detailUser'])->name('detail.unit');

// Login & Register (hanya untuk guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [SesiController::class, 'formLogin'])->name('login');
    Route::post('/login', [SesiController::class, 'prosesLogin'])->name('login.post');

    Route::get('/register', [SesiController::class, 'formRegister'])->name('register');
    Route::post('/register', [SesiController::class, 'prosesRegister'])->name('register.post');
});

// Area yang butuh login
Route::middleware('auth')->group(function () {
    Route::middleware(['cekadmin'])->group(function (){
        Route::middleware(['cekowner'])->group(function (){
            // Fasilitas (CRUD)
            Route::resource('/admin/fasilitas', FasilitasController::class);
        
            // Unit (CRUD)
            Route::get('/admin/unit/search', [UnitController::class, 'search'])->name('unit.search');
            Route::resource('/admin/unit', UnitController::class);

            Route::get('unit/{id}/fasilitas',[UnitController::class, 'fasilitasIndex'])->name('unit.fasilitas.index');
            Route::delete('unit/{id}/fasilitas/{fasilitas}', [UnitController::class, 'destroyFasilitas'])->name('unit.fasilitas.destroy');

            // Endpoint AJAX data pegawai
            Route::get('/admin/pegawai/data', [OwnerController::class, 'data'])->name('pegawai.data');

            // Resource CRUD pegawai
            Route::resource('/admin/pegawai', OwnerController::class);

            // Endpoint AJAX data informasi
            Route::get('/admin/informasi/data', [InformasiController::class, 'data'])->name('informasi.data');

            // Resource CRUD informasi
            Route::resource('/admin/informasi', InformasiController::class);
        });
        // data fasilitas per unit untuk AJAX
        Route::get('admin/unit/{unit}/fasilitas/data', [FasilitasController::class, 'data'])->name('unit.fasilitas.data');

        Route::get('/admin/masukan', [MasukanController::class,'admin'])->name('masukan.admin');
        // Dashboard admin (sebaiknya juga pakai auth, tapi ini mengikuti punyamu)
        Route::get('/admin/dashboard/data', [AdminController::class, 'data'])->name('admin.dashboard.data');

        // Dashboard admin (sebaiknya juga pakai auth, tapi ini mengikuti punyamu)
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // Booking admin 
        Route::get('/admin/booking', [BookingController::class, 'admin'])->name('booking.admin');
        Route::get('/admin/booking/data', [BookingController::class, 'data'])->name('booking.data');
        Route::get('/admin/booking/export/pdf', [BookingController::class, 'exportPdfAdmin'])->name('laporan.booking.pdf');
        Route::put('/admin/booking/{id}/update_waktu', [BookingController::class, 'updatePesanan'])->name('booking.updatePesanan');

    });

    // Profil
        Route::get('/profile/{id}', [ProfilController::class, 'show'])->name('profile');
        Route::put('/profile', [ProfilController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfilController::class, 'updatePassword'])->name('profile.updatePassword');
    // end Profil

    // Booking dan Payment (user & admin)
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create'); // untuk form booking
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store'); // untuk submit booking

    
    Route::get('/booking/{id}/payment', [BookingController::class, 'paymentPage'])->name('booking.payment');
    Route::get('/payment/{id}', [BookingController::class, 'payment'])->name('payment');
    Route::get('/detail_booking/{id}', [BookingController::class, 'detail'])->name('detil');
    Route::get('/check-availability', [BookingController::class, 'checkAvailability'])->name('check.availability');
    Route::put('/admin/booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');
    Route::get('/booking/{id}', [BookingController::class, 'exportPdf'])->name('booking.pdf');
    Route::get('/booking/history', [BookingController::class, 'history'])->name('riwayat.booking');

    // payment
    Route::get('/pay/{id}', [BookingController::class,'paymentMidtrans'])->name('pay');
    Route::post('/payment/callback', [PaymentController::class, 'notification'])->name('payment.callback')->withoutMiddleware(['csrf']);

    // masukan
        Route::get('/ulasan/{booking}', [MasukanController::class, 'create'])->name('ulasan.create');    
        Route::post('/ulasan/{booking}', [MasukanController::class, 'store'])->name('ulasan.store');
        Route::get('/ulasan/{booking}/show', [MasukanController::class,'show'])->name('ulasan.show');
    // end masukan

    // // midtrans
    // Route::get('/payment', [PaymentController::class, 'index']);
    // //end midtrans

    // Logout
    Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
});

// Route untuk halaman Tata Cara Pesan
Route::get('/tata-cara-pesan', function () {
    return view('tata-cara');
})->name('tata.cara');

// Booking dan Payment (user & admin)
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create'); // untuk form booking
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store'); // untuk submit booking

    
    Route::get('/booking/{id}/payment', [BookingController::class, 'paymentPage'])->name('booking.payment');
    Route::get('/payment/{id}', [BookingController::class, 'payment'])->name('payment');
    Route::get('/detail_booking/{id}', [BookingController::class, 'detail'])->name('detil');
    Route::get('/check-availability', [BookingController::class, 'checkAvailability'])->name('check.availability');
    Route::put('/admin/booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');
    Route::get('/booking/{id}', [BookingController::class, 'exportPdf'])->name('booking.pdf');
    Route::get('/booking/history', [BookingController::class, 'history'])->name('riwayat.booking');
    Route::put('/admin/booking/{id}/status_pemesanan', [BookingController::class, 'updatePesanan'])->name('booking.updatePesanan');
    Route::put('/admin/booking/{id}/update_waktu', [BookingController::class, 'updateWaktu'])->name('booking.update_waktu');


    // payment
    Route::get('/pay/{id}', [BookingController::class,'paymentMidtrans'])->name('pay');
    Route::post('/payment/callback', [PaymentController::class, 'notification'])->name('payment.callback');
// end booking