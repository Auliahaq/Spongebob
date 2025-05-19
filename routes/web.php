<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerformaController;
use App\Http\Controllers\TentangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔹 Halaman Utama
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/performa', [PerformaController::class, 'index']);
Route::get('/tentang', [TentangController::class, 'index']);

// 🔹 Artikel
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/{id}', [HomeController::class, 'show'])->name('artikel.show');
Route::get('/artikel-lanjutan', fn() => view('pages.artikel-lanjutan'))->name('artikel.lanjutan');

// 🔹 Teman
Route::get('/teman', [FriendController::class, 'index'])->name('teman.index');
Route::post('/teman', [FriendController::class, 'store'])->name('teman.store');
Route::delete('/teman/{name}', [FriendController::class, 'destroy'])->name('teman.destroy');

// 🔹 Halaman Statis (jika tidak lewat controller)
Route::view('/tentang', 'pages.tentang');
Route::view('/teman-static', 'pages.teman'); // hanya jika diperlukan secara statis

Route::get('/artikel-lanjutan', function () {
    return view('pages.artikel-lanjutan'); // ← sesuai folder dan nama file
});

Route::get('/koleksi', function () {
    return view('pages.koleksi'); // ← sesuai folder dan nama file
});
Route::get('/koleksi', [KoleksiController::class, 'index']);
Route::post('/koleksi', [KoleksiController::class, 'store'])->name('koleksi.store');
Route::delete('/koleksi/{id}', [KoleksiController::class, 'destroy'])->name('koleksi.destroy');

// 🔹 Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
