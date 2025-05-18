<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/tentang', function () {
    return view('pages.tentang'); // ← sesuai folder dan nama file
});

Route::get('/artikel-lanjutan', function () {
    return view('pages.artikel-lanjutan'); // ← sesuai folder dan nama file
});
