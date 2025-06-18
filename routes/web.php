<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ElectricalPartController;
use App\Http\Controllers\InstrumentPartController;
use App\Http\Controllers\ToolsPartController;
use App\Http\Controllers\LinkCardController;
use App\Http\Controllers\RiwayatBarangMasukController;
use App\Http\Controllers\RiwayatBarangKeluarController;
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


// Admin Routes
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [LinkCardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/electrical', ElectricalPartController::class);
    Route::resource('/admin/instrument', InstrumentPartController::class);
    Route::resource('/admin/tools', ToolsPartController::class);
    Route::resource('/admin/masuk', RiwayatBarangMasukController::class);
    Route::resource('/admin/keluar', RiwayatBarangKeluarController::class);

    Route::get('/admin/restok', function () {
        return view('restok');
    })->name('admin.restok');

    Route::get('/admin/laporan', function () {
        return view('admin.laporan');
    })->name('admin.laporan');

    Route::get('/admin/profil', function () {
        return view('admin.profil');
    })->name('admin.profil');
});

// Executive Routes
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':executive'])->group(function () {
    Route::get('/executive/dashboard', [DashboardExecutiveController::class, 'index'])->name('executive.dashboard');;
});
