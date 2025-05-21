<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    HomeController,
    ArtikelController,
    KoleksiController,
    FriendController,
    PerformaController,
    TentangController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// — Halaman Statis
Route::get('/',                 [AuthController::class, 'showLogin'])->name('login');
Route::post('/',                [AuthController::class, 'login']);
Route::get('/register',         [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',        [AuthController::class, 'register']);
Route::post('/logout',          [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password',  [AuthController::class, 'showForgot'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password',       [AuthController::class, 'resetPassword'])->name('password.update');

// — Dashboard/Home (setelah login)
Route::middleware('auth')->group(function() {
    Route::get('/home',                [HomeController::class, 'index'])->name('home');

    // Tentang Kami
    Route::get('/tentang',             [TentangController::class, 'index'])->name('tentang');

    // Teman
    Route::get('/teman',               [FriendController::class, 'index'])->name('teman.index');
    Route::post('/teman',              [FriendController::class, 'store'])->name('teman.store');
    Route::delete('/teman/{name}',     [FriendController::class, 'destroy'])->name('teman.destroy');

    // Koleksi
    Route::get('/koleksi',             [KoleksiController::class, 'index'])->name('koleksi.index');
    Route::post('/koleksi',            [KoleksiController::class, 'store'])->name('koleksi.store');
    Route::delete('/koleksi/{id}',     [KoleksiController::class, 'destroy'])->name('koleksi.destroy');

    // Artikel
    Route::get('/artikel',             [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('/artikel/{id}',        [ArtikelController::class, 'show'])->name('artikel.show');
    Route::get('/artikel-lanjutan/{id}', [ArtikelController::class, 'lanjutan'])
                                         ->name('artikel.lanjutan');
    Route::post('/artikel/mark-read',  [ArtikelController::class, 'markRead'])
                                         ->name('artikel.markRead');

    // Performa
    Route::get('/performa',            [PerformaController::class, 'index'])
                                         ->name('performa.index');
    Route::post('/performa',           [PerformaController::class, 'store'])
                                         ->name('performa.store');
});
