<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $highlightArticle = DB::table('artikel')->orderBy('id', 'desc')->first();
        $cardsArticles = DB::table('artikel')->orderBy('id', 'desc')->offset(1)->limit(4)->get();
        $latestArticles = DB::table('artikel')->orderBy('id', 'desc')->offset(5)->limit(3)->get();
        return view('pages.artikel', compact('highlightArticle', 'cardsArticles', 'latestArticles'));
    }

    public function show(Request $request)
    {
        $id = $request->get('id', 1);
        $tab = $request->get('tab', 'lanjutan');
        $article = DB::table('artikel')->find($id);

        return view('artikel.detail', [
            'article' => $article,
            'active_tab' => $tab
        ]);
    }
}
