<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SekertarisController;
use App\Http\Controllers\TambahAnggotaController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\RekapDataPenggunaController;
use App\Http\Controllers\TambahDataPenggunaController;

// Route untuk menampilkan form login (GET)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk memproses form login (POST)
Route::post('/loginm', [LoginController::class, 'login'])->name('login.post');

// Route untuk logout (POST)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Middleware untuk melindungi route berdasarkan peran (role) Sekretaris
Route::middleware(['auth', 'role:sekertaris'])->group(function () {
    Route::get('/sekertaris/dashboard', [SekertarisController::class, 'index'])->name('sekertaris.dashboard');
    Route::get('/anggota', [TambahAnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/create', [TambahAnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota', [TambahAnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/{id}/edit', [TambahAnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{id}', [TambahAnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{id}', [TambahAnggotaController::class, 'destroy'])->name('anggota.destroy');
});

// Route untuk role 'bendahara'
Route::middleware(['auth', 'role:bendahara'])->group(function () {
    Route::get('/bendahara/dashboard', [BendaharaController::class, 'index'])->name('bendahara.dashboard');
    Route::get('/bendahara/data-pengguna', [TambahDataPenggunaController::class, 'DataPengguna'])->name('bendahara.DataPengguna');
    Route::get('bendahara/tambah-pengguna', [TambahDataPenggunaController::class, 'create'])->name('bendahara.tambahPengguna');
    Route::post('bendahara/tambah-pengguna', [TambahDataPenggunaController::class, 'store'])->name('bendahara.storePengguna');
    Route::get('/pengguna/{id}/edit', [TambahDataPenggunaController::class, 'edit'])->name('bendahara.editPengguna');
    Route::delete('/pengguna/{id}', [TambahDataPenggunaController::class, 'destroy'])->name('bendahara.hapusPengguna');
    Route::put('/bendahara/updatePengguna/{id}', [TambahDataPenggunaController::class, 'update'])->name('bendahara.updatePengguna');
    Route::get('/bendahara/rekap-data', [RekapDataPenggunaController::class, 'RekapData'])->name('bendahara.RekapData');
    Route::get('/bendahara/tambahRekap', [RekapDataPenggunaController::class, 'tambahRekap'])->name('bendahara.TambahRekap');
    Route::post('/bendahara/storeRekap', [RekapDataPenggunaController::class, 'storeRekap'])->name('bendahara.storeRekap');
    Route::get('/bendahara/rekap/edit/{id}', [RekapDataPenggunaController::class, 'editRekap'])->name('bendahara.EditRekap');
    Route::post('/bendahara/rekap/update/{id}', [RekapDataPenggunaController::class, 'updateRekap'])->name('bendahara.updateRekap');
    Route::delete('/bendahara/rekap/delete/{id}', [RekapDataPenggunaController::class, 'hapusRekap'])->name('bendahara.hapusRekap');

});


// Route untuk role 'anggota'
Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/anggota/dashboard', [AnggotaController::class, 'index'])->name('anggota.dashboard');
});





// Route::middleware(['auth', 'role:' . Role::SEKERTARIS])->group(function () {
//     Route::get('/sekretaris', [SekertarisController::class, 'index']);
// });
