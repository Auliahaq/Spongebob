<?php

namespace App\Models;
class FriendRequest extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'status'];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
