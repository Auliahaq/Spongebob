<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function edit()
    {
        return view('pages.profil', ['user' => Auth::user()]);
    }

    public function update(Request $request)
{
    $user = auth()->user();

    // Validasi
    $validated = $request->validate([
        'name'   => 'required|string|max:50',
    ]);

    // Update nama
    $user->name = $validated['name'];

    // Update avatar jika ada file
    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath;
    }

    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}

}
