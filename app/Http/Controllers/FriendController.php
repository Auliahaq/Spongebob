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
            'avatar' => 'nullable|url', // Atau bisa upload file
        ]);

        Friend::create($validated);

        return redirect()->route('teman.index')->with('success', 'Teman berhasil ditambahkan!');
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
