<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangMasukController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Semua route yang butuh login dibungkus dalam grup middleware 'auth'
Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    });

    Route::resource('barangmasuks', BarangMasukController::class);
    Route::get('/electrical', [BarangMasukController::class, 'index'])->middleware('auth');
    });

    Route::get('/instrument', function () {
        return view('instrument');
    });
    Route::get('/tools', function () {
        return view('tools');
    });
    Route::get('/keluar', function () {
        return view('keluar');
    });
    Route::get('/masuk', function () {
        return view('masuk');
    });
    Route::get('/restok', function () {
        return view('restok');
    });
    Route::get('/laporan', function () {
        return view('laporan');
    });
    Route::get('/profil', function () {
        return view('profil');
    });

