<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FriendController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('pages.home'); // ← sesuai folder dan nama file
});

Route::get('/performa', function () {
    return view('pages.performa'); // ← sesuai folder dan nama file
});

Route::get('/teman', function () {
    return view('pages.teman'); // ← sesuai folder dan nama file
});
Route::get('/teman', [FriendController::class, 'index'])->name('teman.index');
Route::post('/teman', [FriendController::class, 'store'])->name('teman.store');
Route::delete('/teman/{name}', [FriendController::class, 'destroy'])->name('teman.destroy');

Route::get('/tentang', function () {
    return view('pages.tentang'); // ← sesuai folder dan nama file
});

Route::get('/artikel-lanjutan', function () {
    return view('pages.artikel-lanjutan'); // ← sesuai folder dan nama file
});
