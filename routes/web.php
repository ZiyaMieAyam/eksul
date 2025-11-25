<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\EskulController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Auth\AuthController;

// redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Untuk menghindari error GET /logout
Route::get('/logout', function() {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard/siswa', [SiswaController::class, 'dashboard'])->name('dashboard.siswa');
    Route::get('/dashboard/guru', [GuruController::class, 'dashboard'])->name('dashboard.guru');
    Route::get('/dashboard/pembina', [PembinaController::class, 'dashboard'])->name('dashboard.pembina');

    // CRUD Resource
    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('pembina', PembinaController::class);
    Route::resource('eskul', EskulController::class);
    Route::resource('aktivitas', AktivitasController::class);
    Route::resource('kehadiran', KehadiranController::class);
    Route::resource('prestasi', PrestasiController::class);
    Route::resource('pendaftaran', PendaftaranController::class);
    // Custom routes (yang tidak ada di resource)
    Route::get('/dafes', [PendaftaranController::class, 'create'])->name('dafes');
    Route::post('/dafes', [PendaftaranController::class, 'store'])->name('dafes.store');
    Route::get('/prosis', [SiswaController::class, 'profil'])->name('prosis');
    Route::get('/kehadiran/{id_eskul}/detail', [KehadiranController::class, 'detail'])->name('kehadiran.detail');
    Route::get('/rekap-absensi', [GuruController::class, 'absensi'])->name('guru.datab');
    Route::get('/rekap-absensi/{id_eskul}/detail', [GuruController::class, 'absensiDetail'])->name('guru.absensi.detail');
    Route::get('/absensi-guru', [GuruController::class, 'absensi'])->name('guru.absensi');
    Route::get('/data-pembina-guru', [GuruController::class, 'dapim'])->name('guru.dapim');
    
    // Route siswa guru (non-resource)
    Route::get('/siswa/create', [GuruController::class, 'tamsis'])->name('guru.tamsis');
    Route::post('/siswa-store', [GuruController::class, 'storesis'])->name('guru.storesis');
    Route::get('/siswa/{id}/edit', [GuruController::class, 'edsis'])->name('guru.edsis');
    Route::put('/siswa/{id}', [GuruController::class, 'updatesis'])->name('guru.updatesis');
    Route::delete('/siswa/{id}', [GuruController::class, 'destroyis'])->name('guru.dsis');

    // Prestasi - PEMBINA lihat & kelola
    Route::get('/prestasi-pembina', [PembinaController::class, 'prestasiIndex'])->name('pembina.prestasi.index');
    Route::put('/prestasi/{id}/pembina', [PembinaController::class, 'prestasiUpdate'])->name('pembina.prestasi.update');

    // Prestasi - GURU verifikasi
    Route::get('/prestasi-verifikasi', [GuruController::class, 'prestasiVerifikasi'])->name('guru.prestasi.verifikasi');
    Route::put('/prestasi/{id}/verifikasi', [GuruController::class, 'prestasiUpdate'])->name('guru.prestasi.update');
});