<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Auth;

class FriendRequestController extends Controller
{
    // Kirim permintaan
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $receiver = User::where('email', $request->email)->first();
        $sender = Auth::user();

        if ($sender->id === $receiver->id) {
            return back()->with('error', 'Tidak bisa menambahkan diri sendiri.');
        }

        $exists = FriendRequest::where(function ($q) use ($sender, $receiver) {
            $q->where('sender_id', $sender->id)->where('receiver_id', $receiver->id);
        })->orWhere(function ($q) use ($sender, $receiver) {
            $q->where('sender_id', $receiver->id)->where('receiver_id', $sender->id);
        })->exists();

        if ($exists) {
            return back()->with('error', 'Permintaan sudah terkirim atau kalian sudah berteman.');
        }

        FriendRequest::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
        ]);

        return back()->with('success', 'Permintaan pertemanan dikirim.');
    }

    // Tampilkan permintaan masuk
    public function index()
    {
        $requests = FriendRequest::where('receiver_id', Auth::id())
                    ->where('status', 'pending')
                    ->with('sender')
                    ->get();

        return view('pages.permintaan-teman', compact('requests'));
    }

    // Terima permintaan
    public function accept($id)
    {
        $request = FriendRequest::findOrFail($id);

        if ($request->receiver_id !== Auth::id()) {
            abort(403);
        }

        $request->update(['status' => 'accepted']);

        Friend::create([
            'user_id' => $request->sender_id,
            'friend_id' => $request->receiver_id,
        ]);
        Friend::create([
            'user_id' => $request->receiver_id,
            'friend_id' => $request->sender_id,
        ]);

        return back()->with('success', 'Permintaan diterima.');
    }

    // Tolak permintaan
    public function decline($id)
    {
        $request = FriendRequest::findOrFail($id);

        if ($request->receiver_id !== Auth::id()) {
            abort(403);
        }

        $request->update(['status' => 'declined']);

        return back()->with('info', 'Permintaan ditolak.');
    }
}
