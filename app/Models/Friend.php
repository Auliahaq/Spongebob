<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'friend_id',
        'name',
        'email',
        'avatar',
        'status', // penting untuk sistem verifikasi
    ];

    /**
     * Relasi ke user pengirim permintaan pertemanan.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke user yang menerima permintaan pertemanan.
     */
    public function friendUser()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }

    /**
     * Cek apakah status pertemanan sudah accepted.
     */
    public function isAccepted()
    {
        return $this->status === 'accepted';
    }
    // App\Models\Friend.php
public function sender()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
