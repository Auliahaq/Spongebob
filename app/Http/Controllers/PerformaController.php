<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PerformaController extends Controller
{
    public function index()
    {
        $kategori = DB::table('artikel')
            ->selectRaw('kategori, COUNT(*) as jumlah')
            ->groupBy('kategori')
            ->get();

        $tingkat = DB::table('artikel')
            ->selectRaw('tingkat_kesulitan, COUNT(*) as jumlah')
            ->groupBy('tingkat_kesulitan')
            ->get();

        return view('pages.performa', [
            'kategoriLabels' => $kategori->pluck('kategori'),
            'kategoriData' => $kategori->pluck('jumlah'),
            'tingkatLabels' => $tingkat->pluck('tingkat_kesulitan')->map(fn($t) => ucfirst($t)),
            'tingkatData' => $tingkat->pluck('jumlah')
        ]);
    }
}

