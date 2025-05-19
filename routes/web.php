<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PerformaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TentangController;


// Halaman Utama
Route::get('/', fn() => view('welcome'));
Route::get('/home', [HomeController::class, 'index']);
Route::get('/performa', [PerformaController::class, 'index']);
Route::get('/tentang', [TentangController::class, 'index']);
Route::get('/teman', fn() => view('pages.teman'));
Route::get('/artikel-lanjutan', fn() => view('pages.artikel-lanjutan'));
Route::get('/tentang', fn() => view('pages.tentang'));
Route::get('/artikel-lanjutan', fn() => view('pages.artikel-lanjutan'))->name('artikel.lanjutan');
Route::get('/artikel', fn() => view('pages.artikel'));
// Halaman Artikel
Route::get('/', [HomeController::class, 'index']);
Route::get('/artikel/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('artikel.show');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', fn() => Auth::logout() && redirect('/login'))->name('logout');
Route::get('/artikel', [ArtikelController::class, 'index']);
