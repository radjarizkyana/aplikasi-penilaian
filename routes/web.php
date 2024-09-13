<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Middleware auth untuk role admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('peserta', [PesertaController::class , 'index'])->name('peserta.index');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/penilaian-peserta', [AdminController::class, 'managePenilaianPeserta'])->name('admin.penilaian_peserta');
    Route::post('/admin/update-nilai/{id}', [AdminController::class, 'updateNilai'])->name('admin.updateNilai');    
    Route::resource('peserta', PesertaController::class);
    Route::resource('pengajar', PengajarController::class);
    Route::resource('pelatihan', PelatihanController::class);
    Route::resource('terminal', TerminalController::class);
});

// Middleware auth untuk role peserta
Route::middleware(['auth', 'role:peserta'])->group(function () {
    Route::get('/peserta/penilaian/form', [PesertaController::class, 'showPenilaianForm'])->name('peserta.penilaian.form');
    Route::post('/peserta/penilaian/store', [PesertaController::class, 'storePenilaian'])->name('peserta.penilaian.store');
});

// Middleware auth untuk role pengajar
Route::middleware(['auth', 'role:pengajar'])->group(function () {
    Route::get('pengajar\penilaian_peserta', [PengajarController::class, 'penilaianPeserta'])->name('pengajar\penilaian_peserta');
    Route::post('/pengajar/update-nilai/{id}', [PengajarController::class, 'updateNilai'])->name('pengajar.updateNilai');    
});

// Route untuk login dan registrasi
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

