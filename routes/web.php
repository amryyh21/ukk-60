<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriesController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

#login
// Menampilkan halaman login
Route::get('/', function () {
    return view('pages/login');
})->name('login');
// Menampilkan halaman login admin
Route::get('/logAdmin', function () {
    return view('admin/logAdmin');
})->name('login.admin');


// Memproses data login user
Route::post('/login', [AuthController::class, 'login'])->name('login.post');




#logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

#siswa
Route::middleware('auth')->group(function () {
    Route::get('/siswa', [SiswaController::class, 'dashboard'])->name('dashboard.siswa');
    Route::get('/aspirasi', [SiswaController::class, 'createAspirasi'])->name('aspirasi');
    Route::post('/aspirasi', [SiswaController::class, 'storeAspirasi'])->name('aspirasi.store');
    Route::get('/profil', [SiswaController::class, 'profile'])->name('profil');
    Route::get('/history', [SiswaController::class, 'history'])->name('history');
});

#admin
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard.admin');
    Route::get('/manageAspirasi', [AdminController::class, 'reports'])->name('manageAspirasi');
    Route::patch('/manageAspirasi/{report}/status', [AdminController::class, 'updateReportStatus'])->name('manageAspirasi.status');
    Route::get('/manajemenSiswa', [AdminController::class, 'students'])->name('manajemenSiswa');
    Route::get('/addKategori', [KategoriesController::class, 'index'])->name('addKategori');
    Route::post('/addKategori', [KategoriesController::class, 'store'])->name('addKategori.store');
    Route::delete('/addKategori/{kategories}', [KategoriesController::class, 'destroy'])->name('addKategori.destroy');
});
