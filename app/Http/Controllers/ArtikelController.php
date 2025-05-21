<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Performa; 
use Illuminate\Support\Facades\Cookie;


class ArtikelController extends Controller
{
    public function index()
    {
        $highlightArticle = DB::table('artikel')->latest('id')->first();
        $cardsArticles    = DB::table('artikel')->latest('id')->skip(1)->take(4)->get();
        $latestArticles   = DB::table('artikel')->latest('id')->skip(5)->take(3)->get();

        return view('pages.artikel', compact(
            'highlightArticle',
            'cardsArticles',
            'latestArticles'
        ));
    }

    public function show(Request $request)
    {
        $id         = $request->get('id', 1);
        $active_tab = $request->get('tab', 'lanjutan');
        $article    = DB::table('artikel')->find($id) ?: abort(404);

        return view('artikel.detail', compact('article', 'active_tab'));
    }

    /**
     * Tampilkan halaman lanjutan/menengah/pemula
     */
public function lanjutan(Request $req, int $id)
{
    // 1. Cari artikelnya, kalau tidak ada → 404
    $article = DB::table('artikel')->find($id) ?: abort(404);

    // 2. Tentukan tab aktif: query ?tab= > cookie > default 'lanjutan'
    $tab = $req->get('tab')
         ?: $req->cookie('active_tab', 'lanjutan');

    // 3. Ambil semua performa user (artikel_id => level)
    $readMap = auth()->check()
        ? Performa::where('user_id', auth()->id())
                   ->pluck('level', 'artikel_id')
                   ->all()
        : [];

    // 4. Render view + set/update cookie active_tab selama 1 tahun
    return response()
        ->view('pages.artikel-lanjutan', [
            'article'    => $article,
            'active_tab' => $tab,
            'readMap'    => $readMap,
        ])
        ->withCookie(cookie('active_tab', $tab, 60*24*365));
}

    /**
     * Tandai selesai membaca untuk satu level tertentu
     */
    public function markRead(Request $request)
    {
        $data = $request->validate([
            'artikel_id' => 'required|integer|exists:artikel,id',
            'level'      => 'required|string|in:lanjutan,menengah,pemula',
        ]);

        $user = auth()->user();

        // Buat entry baru jika belum ada
        Performa::firstOrCreate([
            'user_id'    => $user->id,
            'artikel_id' => $data['artikel_id'],
            'level'      => $data['level'],
        ]);

        return redirect()
            ->route('performa.index')
            ->with('success', 'Artikel sudah ditandai selesai dibaca!');
    }
}
