<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;

class FriendController extends Controller
{
    public function index()
    {
        $friends = Friend::all();
        return view('pages.teman', compact('friends'));
    }

    public function store(Request $request)
    {
        // Validasi sederhana
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:friends,email',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar avatar
        ]);

        // Proses upload avatar
    $avatar = null;
    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar')->store('teman', 'public'); // Simpan gambar di public/img/teman
    }

    // Simpan data teman ke database
    Friend::create([
        'name' => $request->name,
        'email' => $request->email,
        'avatar' => $avatar, // Simpan nama file avatar
    ]);

    return redirect()->route('teman.index')->with('success', 'Teman berhasil ditambahkan');
    }

    public function destroy($name)
{
    // Mencari teman berdasarkan nama
    $friend = Friend::where('name', $name)->first();

    // Jika teman ditemukan, hapus teman tersebut
    if ($friend) {
        $friend->delete();
        return redirect()->route('teman.index')->with('success', 'Teman berhasil dihapus');
    }

    // Jika teman tidak ditemukan
    return redirect()->route('teman.index')->with('error', 'Teman tidak ditemukan');
}

}
