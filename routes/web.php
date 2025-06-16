<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ElectricalPartController;
use App\Http\Controllers\InstrumentPartController;
use App\Http\Controllers\ToolsPartController;
use App\Http\Controllers\LinkCardController;
use App\Http\Controllers\RiwayatBarangMasukController;
use App\Http\Controllers\RiwayatBarangKeluarController;
use App\Http\Controllers\LaporanController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Semua route yang butuh login dibungkus dalam grup middleware 'auth'
Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('/', [LinkCardController::class, 'index'])->name('dashboard');

    Route::resource('electrical', ElectricalPartController::class);
    Route::resource('instrument', InstrumentPartController::class); 
    Route::resource('tools', ToolsPartController::class);
    Route::resource('masuk', RiwayatBarangMasukController::class);
    Route::resource('keluar', RiwayatBarangKeluarController::class);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');



    Route::get('/restok', function () {
        return view('restok');
    });
    Route::get('/profil', function () {
        return view('profil');
    });
});
