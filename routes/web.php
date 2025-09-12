<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/room', function () {return view('rooms');})->name('rooms');
Route::get('/facilities', function () {return view('facilities');})->name('facilities');
Route::get('/payment', function () {return view('payment');})->name('payment');

// Login & Register (hanya guest)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SesiController::class, 'formLogin'])->name('login');
    Route::post('/login', [SesiController::class, 'prosesLogin'])->name('login.post');

    Route::get('/register', [SesiController::class, 'formRegister'])->name('register');
    Route::post('/register', [SesiController::class, 'prosesRegister'])->name('register.post');
    
});

// Area yang butuh login
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [SesiController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/booking', [SesiController::class, 'booking'])->name('booking');
    Route::get('/payment', function () {return view('payment');})->name('payment');

    //fasilitas
    Route::resource('/admin/fasilitas', FasilitasController::class);

    //unit
    Route::resource('/admin/unit', UnitController::class);

    //karyawan
    Route::resource('/admin/pegawai', OwnerController::class);

    // Logout (POST)
    Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
});

// Register GET (tampilkan form)
Route::get('/register', function () {
    return view('register');
})->name('register');

// Register POST (simulasi simpan user dan redirect ke login)
Route::post('/register', function (Request $request) {
    // Belum menyimpan ke database, hanya redirect
    return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
});

// LOGIN dan LOGOUT pakai CONTROLLER
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Booking Page (simulasi)
Route::get('/booking', function () {
    if (!session('user')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
    return "Halaman Booking (Belum ada view).";
})->name('booking');

Route::get('/rooms', function () {
    return view('rooms');
})->name('rooms');

Route::get('/home2', function () {
    return view('home2');
})->name('home2');

Route::get('/facilities', function () {
    return view('facilities'); 
})->name('facilities');

Route::get('/rooms2', function () {
    return view('rooms2');
})->name('rooms2');

Route::get('/facilities2', function () {
    return view('facilities2');
})->name('facilities2');

Route::get('/booking', function () {
    return view('booking');
})->name('booking');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::post('/payment', function () {
    return view('payment');
})->name('payment');

Route::get('/payment2', function () {
    return view('payment2');
})->name('payment2');