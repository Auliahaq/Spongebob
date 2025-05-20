<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TentangController extends Controller
{
    public function index()
    {
        // Ambil data artikel (contoh: 5 terbaru)
        $artikels = DB::table('artikel')
                      ->orderBy('id', 'desc')
                      ->limit(5)
                      ->get();

        // Kirim ke view
        return view('pages.tentang', compact('artikels'));
    }
}
