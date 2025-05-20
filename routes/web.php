<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    AuthController, ArtikelController, KoleksiController,
    FriendController, HomeController, PerformaController,
    TentangController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔹 Halaman Utama
Route::get('/home',         [HomeController::class, 'index'])->name('home');
Route::get('/performa', [PerformaController::class, 'index'])->name('performa');
Route::get('/tentang',  [TentangController::class, 'index'])->name('tentang');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 🔹 Artikel
Route::get('/artikel',           [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{id}',      [HomeController::class,    'show'])->name('artikel.show');
Route::get('/artikel-lanjutan/{id}', [ArtikelController::class, 'lanjutan'])->name('artikel.lanjutan');


// 🔹 Koleksi
Route::get('/koleksi',           [KoleksiController::class, 'index'])->name('koleksi.index');
Route::post('/koleksi',          [KoleksiController::class, 'store'])->name('koleksi.store');
Route::delete('/koleksi/{id}',   [KoleksiController::class, 'destroy'])->name('koleksi.destroy');

// 🔹 Teman
Route::get('/teman',             [FriendController::class, 'index'])->name('teman.index');
Route::post('/teman',            [FriendController::class, 'store'])->name('teman.store');
Route::delete('/teman/{name}',   [FriendController::class, 'destroy'])->name('teman.destroy');
Route::get('/teman', [FriendController::class, 'index'])->name('teman.index');
Route::post('/teman', [FriendController::class, 'store'])->name('teman.store');
Route::delete('/teman/{name}', [FriendController::class, 'destroy'])->name('teman.destroy');

// 🔹 Halaman Statis (jika tidak lewat controller)
Route::view('/tentang', 'pages.tentang');
Route::view('/teman-static', 'pages.teman'); // hanya jika diperlukan secara statis

Route::get('/koleksi', [KoleksiController::class, 'index'])->name('koleksi.index');
Route::post('/koleksi', [KoleksiController::class, 'store'])->name('koleksi.store');
Route::delete('/koleksi/{id}', [KoleksiController::class, 'destroy'])->name('koleksi.destroy');

// 🔹 Autentikasi
Route::get('/',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/',    [AuthController::class, 'login']);
Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',    [AuthController::class, 'login']);
Route::get('/forgot-password', [AuthController::class, 'showForgot'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
