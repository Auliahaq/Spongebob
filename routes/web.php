<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtikelController;

// Halaman Utama
Route::get('/', fn() => view('welcome'));
Route::get('/home', fn() => view('pages.home'));
Route::get('/performa', fn() => view('pages.performa'));
Route::get('/teman', fn() => view('pages.teman'));
Route::get('/tentang', fn() => view('pages.tentang'));
Route::get('/artikel-lanjutan', fn() => view('pages.artikel-lanjutan'))->name('artikel.lanjutan');
Route::get('/artikel', fn() => view('pages.artikel'));

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', fn() => Auth::logout() && redirect('/login'))->name('logout');
Route::get('/artikel', [ArtikelController::class, 'index']);
