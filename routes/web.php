<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\BukuController;

// Route untuk menampilkan daftar buku, dapat diakses oleh semua pengguna
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

// Route untuk menambah buku, hanya dapat diakses oleh pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
    Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
    Route::get('/buku/ubah/{id}', [BukuController::class,'edit'])->name('buku.edit');
    Route::post('/buku/simpan/{id}', [BukuController::class,'update'])->name('buku.update');
    Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
});


use App\Http\Controllers\Auth\LoginRegisterController;
Route::controller(LoginRegisterController::class)->group(function() {
 Route::get('/register', 'register')->name('register');
 Route::post('/store', 'store')->name('store');
 Route::get('/login', 'login')->name('login');
 Route::post('/authenticate', 'authenticate')->name('authenticate');
 Route::get('/dashboard', 'dashboard')->name('dashboard');
 Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('portfolio', \App\Http\Controllers\PortfolioController::class);
    Route::get('cv', [\App\Http\Controllers\PortfolioController::class, 'cv'])->name('cv.show');
    Route::get('cv/edit', [\App\Http\Controllers\PortfolioController::class, 'edit'])->name('cv.edit');
    Route::post('cv/update', [\App\Http\Controllers\PortfolioController::class, 'update'])->name('cv.update');
});

