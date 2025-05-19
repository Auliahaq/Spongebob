<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class TentangController extends Controller
{
     public function index()
    {
        $artikels = Artikel::orderBy('created_at', 'desc')->take(3)->get();
        return view('pages.tentang', compact('artikels'));
    }
}
