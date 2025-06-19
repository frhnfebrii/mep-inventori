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
use App\Http\Controllers\RestokController;
use App\Http\Controllers\DashboardExecutiveController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});

// Semua route yang butuh login dibungkus dalam grup middleware 'auth'
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])->group(function () {

    Route::get('/admin/dashboard', [LinkCardController::class, 'index'])->name('dashboard');
    Route::resource('/admin/electrical', ElectricalPartController::class);
    Route::resource('/admin/instrument', InstrumentPartController::class); 
    Route::resource('/admin/tools', ToolsPartController::class);
    Route::resource('/admin/masuk', RiwayatBarangMasukController::class);
    Route::resource('/admin/keluar', RiwayatBarangKeluarController::class);
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.exportPdf');
    Route::get('/admin/restok', [RestokController::class, 'index']);
    Route::get('/admin/profil', function () {
        return view('/admin/profil');
    });
});

Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':executive'])->group(function () {
    Route::get('/executive/dashboard', [DashboardExecutiveController::class, 'index'])->name('executive.dashboard');;
});
