<?php

namespace App\Http\Controllers;

use App\Models\Koleksi;
use App\Models\Artikel;
use Illuminate\Http\Request;

class KoleksiController extends Controller
{
    // ✅ Versi index yang sudah diperbaiki + pencarian
    public function index(Request $request)
    {
        $user = auth()->user();
        $search = $request->get('search');

        $koleksi = Koleksi::with(['artikels' => function ($q) use ($search) {
            if ($search) {
                $q->where('judul', 'like', "%{$search}%");
            }
        }])
        ->where('user_id', $user->id)
        ->where('name', 'Koleksi Saya')
        ->first();

        $artikels = $koleksi ? $koleksi->artikels : collect();

        return view('pages.koleksi', compact('koleksi', 'artikels', 'search'));
    }

    // Tambahkan artikel ke koleksi default user
    public function tambahArtikel(Request $request)
    {
        $request->validate([
            'artikel_id' => 'required|exists:artikel,id',
        ]);

        $user = auth()->user();

        $koleksi = Koleksi::firstOrCreate(
            ['name' => 'Koleksi Saya', 'user_id' => $user->id],
            ['author' => '-', 'article_count' => 0]
        );

        $koleksi->artikels()->syncWithoutDetaching([$request->artikel_id]);

        // Perbarui jumlah artikel
        $koleksi->article_count = $koleksi->artikels()->count();
        $koleksi->save();

        return back()->with('success', 'Artikel berhasil ditambahkan ke koleksi!');
    }

    // Hapus koleksi
    public function destroy($id)
    {
        $koleksi = Koleksi::findOrFail($id);

        if ($koleksi->avatar && file_exists(public_path($koleksi->avatar))) {
            unlink(public_path($koleksi->avatar));
        }

        $koleksi->artikels()->detach();
        $koleksi->delete();

        return redirect()->route('koleksi.index')->with('success', 'Koleksi berhasil dihapus');
    }

public function ajaxSearch(Request $request)
{
    $user = auth()->user();
    $search = $request->get('query');

    $koleksi = Koleksi::with(['artikels' => function ($q) use ($search) {
        $q->where('judul', 'like', "%$search%");
    }])
    ->where('user_id', $user->id)
    ->where('name', 'Koleksi Saya')
    ->first();

    $artikels = $koleksi ? $koleksi->artikels : collect();

    $html = view('partials.koleksi-artikel-list', compact('artikels'))->render();

    return response()->json(['html' => $html]);
    }
}
