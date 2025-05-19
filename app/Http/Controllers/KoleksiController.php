<?php

// app/Http/Controllers/KoleksiController.php
namespace App\Http\Controllers;

use App\Models\Koleksi;
use Illuminate\Http\Request;

class KoleksiController extends Controller
{
    // Menampilkan daftar koleksi
    public function index()
    {
        // Mengambil semua data koleksi dari database
        $koleksi = Koleksi::all();
        
        // Mengembalikan view koleksi dengan data koleksi
        return view('pages.koleksi', compact('koleksi')); // Pastikan nama view sesuai dengan file koleksi.blade.php
    }

    // Menyimpan koleksi baru ke dalam database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'article_count' => 'required|integer',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);

        // Proses upload gambar jika ada
        $avatar = null;
        if ($request->hasFile('avatar')) {
            // Menyimpan gambar ke dalam folder 'public/img/koleksi' menggunakan nama file unik
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('img/koleksi'), $avatarName); // Pindahkan gambar ke folder public/img/koleksi
            $avatar = 'img/koleksi/' . $avatarName; // Menyimpan path relatif ke gambar
        }

        // Menyimpan data koleksi ke dalam database
        Koleksi::create([
            'name' => $request->name,
            'author' => $request->author,
            'article_count' => $request->article_count,
            'avatar' => $avatar, // Menyimpan path file gambar
        ]);

        return redirect()->route('koleksi.index')->with('success', 'Koleksi berhasil ditambahkan');
    }

    // Menangani penghapusan koleksi
    public function destroy($id)
    {
        // Mencari koleksi berdasarkan ID
        $koleksi = Koleksi::findOrFail($id);

        // Menghapus file gambar jika ada
        if ($koleksi->avatar && file_exists(public_path($koleksi->avatar))) {
            unlink(public_path($koleksi->avatar)); // Menghapus file gambar
        }

        // Menghapus koleksi dari database
        $koleksi->delete();

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('koleksi.index')->with('success', 'Koleksi berhasil dihapus');
    }
}
