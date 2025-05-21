<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Performa;

class PerformaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // total semua bacaan user ini
        $totalRead = Performa::where('user_id', $userId)->count();

        // jumlah per level
        $countLanjutan = Performa::where('user_id', $userId)
                            ->where('level', 'lanjutan')
                            ->count();
        $countMenengah = Performa::where('user_id', $userId)
                            ->where('level', 'menengah')
                            ->count();
        $countPemula   = Performa::where('user_id', $userId)
                            ->where('level', 'pemula')
                            ->count();

        // data untuk pie chart kategori (join ke artikel)
        $kategori = Performa::select('artikel.kategori', DB::raw('count(*) as jumlah'))
                    ->join('artikel', 'performa.artikel_id', '=', 'artikel.id')
                    ->where('performa.user_id', $userId)
                    ->groupBy('artikel.kategori')
                    ->get();

        // data untuk pie chart tingkat (performa.level)
        $tingkat = Performa::select('level', DB::raw('count(*) as jumlah'))
                    ->where('user_id', $userId)
                    ->groupBy('level')
                    ->get();

        return view('pages.performa', [
            'totalRead'      => $totalRead,
            'countLanjutan'  => $countLanjutan,
            'countMenengah'  => $countMenengah,
            'countPemula'    => $countPemula,
            'kategoriLabels' => $kategori->pluck('kategori'),
            'kategoriData'   => $kategori->pluck('jumlah'),
            'tingkatLabels'  => $tingkat->pluck('level')->map(fn($l)=>ucfirst($l)),
            'tingkatData'    => $tingkat->pluck('jumlah'),
        ]);
    }

    public function store(Request $request)
    {
        // sudah validasi di ArtikelController
        $userId     = Auth::id();
        $artikel_id = $request->input('artikel_id');
        $level      = $request->input('level');

        Performa::firstOrCreate([
            'user_id'    => $userId,
            'artikel_id' => $artikel_id,
            'level'      => $level,
        ]);

        return redirect()
             ->route('artikel.lanjutan', ['id'=>$artikel_id, 'tab'=>$level])
             ->with('success','✓ Sudah Dibaca');
    }
}
