<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Performa;
use App\Models\Koleksi;
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

    public function lanjutan(Request $req, int $id)
    {
        $article = DB::table('artikel')->find($id) ?: abort(404);

        $tab = $req->get('tab') ?: $req->cookie('active_tab', 'lanjutan');

        $readMap = auth()->check()
            ? Performa::where('user_id', auth()->id())
                       ->pluck('level', 'artikel_id')
                       ->all()
            : [];

        return response()
            ->view('pages.artikel-lanjutan', [
                'article'    => $article,
                'active_tab' => $tab,
                'readMap'    => $readMap,
            ])
            ->withCookie(cookie('active_tab', $tab, 60 * 24 * 365));
    }

    public function markRead(Request $request)
    {
        $data = $request->validate([
            'artikel_id' => 'required|integer|exists:artikel,id',
            'level'      => 'required|string|in:lanjutan,menengah,pemula',
        ]);

        $user = auth()->user();

        Performa::firstOrCreate([
            'user_id'    => $user->id,
            'artikel_id' => $data['artikel_id'],
            'level'      => $data['level'],
        ]);

        return redirect()
            ->route('performa.index')
            ->with('success', 'Artikel sudah ditandai selesai dibaca!');
    }

    /**
     * Tambahkan artikel ke koleksi (default per user)
     */
    public function tambahKeKoleksi(Request $request)
    {
        $request->validate([
            'artikel_id' => 'required|exists:artikel,id',
        ]);

        $user = auth()->user();

        // Buat koleksi default jika belum ada
        $koleksi = Koleksi::firstOrCreate([
            'name'    => 'Koleksi Saya',
            'user_id' => $user->id,
        ]);

        // Tambahkan artikel ke koleksi (tanpa duplikat)
        $koleksi->artikels()->syncWithoutDetaching([$request->artikel_id]);

        return redirect()
            ->route('koleksi.index')
            ->with('success', 'Artikel berhasil ditambahkan ke koleksi!');
    }
}
