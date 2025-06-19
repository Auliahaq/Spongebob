<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;

class FriendController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Ambil daftar teman (accepted) selain diri sendiri
        $friends = Friend::where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('friend_id', $user->id);
            })
            ->where('status', 'accepted')
            ->with(['user', 'friendUser'])
            ->get()
            ->filter(function ($friend) use ($user) {
                return $friend->user_id !== $user->id || $friend->friend_id !== $user->id;
            });

        // Permintaan masuk ke user
        $incomingRequests = Friend::where('friend_id', $user->id)
            ->where('status', 'pending')
            ->with('user')
            ->get();

        return view('pages.teman', [
            'friends' => $friends,
            'incomingRequests' => $incomingRequests,
        ]);
    }

    public function store(Request $request)
    {
        return $this->sendRequest($request);
    }

    public function sendRequest(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $currentUser = auth()->user();
    $targetUser  = User::where('email', $request->email)->first();

    if (!$targetUser || $currentUser->id === $targetUser->id) {
        $msg = 'Tidak dapat mengirim permintaan ke diri sendiri.';
        return $request->ajax()
            ? response()->json(['success' => false, 'message' => $msg])
            : back()->with('error', $msg);
    }

    $exists = Friend::where(function ($q) use ($currentUser, $targetUser) {
        $q->where('user_id', $currentUser->id)->where('friend_id', $targetUser->id);
    })->orWhere(function ($q) use ($currentUser, $targetUser) {
        $q->where('user_id', $targetUser->id)->where('friend_id', $currentUser->id);
    })->exists();

    if ($exists) {
        $msg = 'Permintaan sudah dikirim atau sudah berteman.';
        return $request->ajax()
            ? response()->json(['success' => false, 'message' => $msg])
            : back()->with('error', $msg);
    }

    Friend::create([
        'user_id'   => $currentUser->id,
        'friend_id' => $targetUser->id,
        'name'      => $targetUser->name,
        'email'     => $targetUser->email,
        'avatar'    => $targetUser->avatar ?? null,
        'status'    => 'pending'
    ]);

    $msg = 'Permintaan pertemanan berhasil dikirim.';

    return $request->ajax()
        ? response()->json(['success' => true, 'message' => $msg])
        : back()->with('success', $msg);
}

    public function accept($id)
    {
        $request = Friend::findOrFail($id);

        if ($request->friend_id !== auth()->id()) {
            return back()->with('error', 'Tidak berwenang menerima permintaan ini.');
        }

        $request->update(['status' => 'accepted']);

        return back()->with('success', 'Permintaan pertemanan diterima.');
    }

    public function decline($id)
    {
        $request = Friend::findOrFail($id);

        if ($request->friend_id !== auth()->id()) {
            return back()->with('error', 'Tidak berwenang menolak permintaan ini.');
        }

        $request->delete();

        return back()->with('success', 'Permintaan pertemanan ditolak.');
    }

    public function destroy($name)
    {
        $user = auth()->user();

        $friend = Friend::where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('friend_id', $user->id);
            })
            ->where('name', $name)
            ->first();

        if ($friend) {
            $friend->delete();
            return back()->with('success', 'Teman berhasil dihapus.');
        }

        return back()->with('error', 'Teman tidak ditemukan.');
    }

    public function request(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $target = User::where('email', $request->email)->first();

    // Cek jika sudah berteman atau request terkirim
    if (Friend::where([
        ['user_id', auth()->id()],
        ['friend_id', $target->id],
    ])->exists()) {
        if ($request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Sudah pernah dikirim atau sudah berteman.']);
        }
    }

    Friend::create([
        'user_id' => auth()->id(),
        'friend_id' => $target->id,
        'status' => 'pending',
    ]);

    if ($request->ajax()) {
        return response()->json(['success' => true, 'message' => 'Permintaan pertemanan berhasil dikirim.']);
    }

    return back()->with('success', 'Permintaan pertemanan berhasil dikirim.');
}

}