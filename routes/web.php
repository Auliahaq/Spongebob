<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    HomeController,
    ArtikelController,
    KoleksiController,
    FriendController,
    PerformaController,
    TentangController,
    UserController,
    FriendRequestController,
    AIController,
    LandingController
};
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

//landingpage
Route::get('/', fn() => redirect('/home'))->name('landing');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');

//auten
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot & Reset Password
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')->name('password.update');

Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profil', [UserController::class, 'edit'])->name('profil.edit');
    Route::post('/profil', [UserController::class, 'update'])->name('profil.update');

    // Artikel detail (butuh login)
    Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
    Route::get('/artikel-lanjutan/{id}', [ArtikelController::class, 'lanjutan'])->name('artikel.lanjutan');
    Route::post('/artikel/mark-read', [ArtikelController::class, 'markRead'])->name('artikel.markRead');

    // Koleksi
    Route::get('/koleksi', [KoleksiController::class, 'index'])->name('koleksi.index');
    Route::post('/tambah-artikel', [KoleksiController::class, 'tambahArtikel'])->name('koleksi.tambahArtikel');
    Route::delete('/koleksi/{id}', [KoleksiController::class, 'destroy'])->name('koleksi.destroy');
    Route::get('/koleksi/search', [KoleksiController::class, 'ajaxSearch'])->name('koleksi.ajaxSearch');

    // Teman
    Route::get('/teman', [FriendController::class, 'index'])->name('teman.index');
    Route::post('/teman', [FriendController::class, 'store'])->name('teman.store');
    Route::post('/teman/request', [FriendController::class, 'sendRequest'])->name('teman.request');
    Route::post('/teman/accept/{id}', [FriendController::class, 'accept'])->name('teman.accept');
    Route::post('/teman/decline/{id}', [FriendController::class, 'decline'])->name('teman.decline');
    Route::delete('/teman/{name}', [FriendController::class, 'destroy'])->name('teman.destroy');
    Route::post('/teman/kirim', [FriendRequestController::class, 'send'])->name('teman.send');

  
    //performa
    Route::get('/performa', [PerformaController::class, 'index'])->name('performa.index');
    Route::post('/performa', [PerformaController::class, 'store'])->name('performa.store');

    Route::post('/ask-ai', [AIController::class, 'ask'])->name('ai.ask');
});
