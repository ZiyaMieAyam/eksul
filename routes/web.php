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

Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/siswa', [SiswaController::class, 'dashboard'])->name('dashboard.siswa');
    Route::get('/dashboard/guru', [GuruController::class, 'dashboard'])->name('dashboard.guru');
    Route::get('/dashboard/pembina', [PembinaController::class, 'dashboard'])->name('dashboard.pembina');

    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('pembina', PembinaController::class);
    Route::resource('eskul', EskulController::class);
    Route::resource('aktivitas', AktivitasController::class);
    Route::resource('kehadiran', KehadiranController::class);
    Route::resource('prestasi', PrestasiController::class);
    Route::resource('pendaftaran', PendaftaranController::class);

    Route::get('/dafes', [PendaftaranController::class, 'create'])->name('dafes');
    Route::post('/dafes', [PendaftaranController::class, 'store'])->name('dafes.store');
    Route::get('/prosis', [SiswaController::class, 'profil'])->name('prosis');
    Route::get('/kehadiran/{id_eskul}/detail', [KehadiranController::class, 'detail'])->name('kehadiran.detail');
    Route::get('/rekap-absensi', [GuruController::class, 'absensi'])->name('guru.datab');
    Route::get('/rekap-absensi/{id_eskul}/detail', [GuruController::class, 'absensiDetail'])->name('guru.absensi.detail');
    Route::get('/absensi-guru', [GuruController::class, 'absensi'])->name('guru.absensi');
    Route::get('/absensi-guru/{id_eskul}/detail', [GuruController::class, 'absensiDetail'])->name('guru.absensi.detail');
    Route::get('/data-pembina-guru', [GuruController::class, 'dapim'])->name('guru.dapim');
    
    // GURU routes untuk siswa
    Route::get('/siswa/create', [GuruController::class, 'tamsis'])->name('guru.tamsis');
    Route::post('/siswa-store', [GuruController::class, 'storesis'])->name('guru.storesis');
    Route::get('/siswa/{id}/edit', [GuruController::class, 'edsis'])->name('guru.edsis');
    Route::put('/siswa/{id}', [GuruController::class, 'updatesis'])->name('guru.updatesis');
    Route::delete('/siswa/{id}', [GuruController::class, 'destroyis'])->name('guru.dsis');

    // GURU routes untuk pembina (PENTING!)
    Route::get('/guru/pembina/tambah', [GuruController::class, 'tampim'])->name('guru.tampim');
    Route::post('/guru/pembina/simpan', [GuruController::class, 'storeim'])->name('guru.storeim');
    Route::get('/guru/pembina/{id}/edit', [GuruController::class, 'edpim'])->name('guru.edpim');
    Route::put('/guru/pembina/{id}', [GuruController::class, 'updateim'])->name('guru.updateim');
    Route::delete('/guru/pembina/{id}', [GuruController::class, 'destroyim'])->name('guru.destroyim');

    Route::get('/prestasi-pembina', [PembinaController::class, 'prestasiIndex'])->name('pembina.prestasi.index');
    Route::put('/prestasi/{id}/pembina', [PembinaController::class, 'prestasiUpdate'])->name('pembina.prestasi.update');
    Route::get('/prestasi-verifikasi', [GuruController::class, 'prestasiVerifikasi'])->name('guru.prestasi.verifikasi');
    Route::put('/prestasi/{id}/verifikasi', [GuruController::class, 'prestasiUpdate'])->name('guru.prestasi.update');

    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/eskul/{id_eskul}', [PendaftaranController::class, 'showEskul'])->name('pendaftaran.eskul'); // detail pendaftaran untuk eskul
    Route::put('/pendaftaran/{id}', [PendaftaranController::class, 'update'])->name('pendaftaran.update'); // terima/tolak

    // route untuk menyajikan file bukti (storage/app/public/{path})
    Route::get('prestasi/bukti/{path}', [PrestasiController::class, 'bukti'])
        ->where('path', '.*')
        ->name('prestasi.bukti');
});