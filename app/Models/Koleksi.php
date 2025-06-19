<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Artikel;
use App\Models\User;

class Koleksi extends Model
{
    use HasFactory;

    protected $table = 'koleksi';

    // Kolom yang bisa diisi
    protected $fillable = [
        'name',
        'user_id', // gunakan ini jika koleksi milik user tertentu
    ];

    /**
     * Relasi ke tabel artikel (many-to-many)
     */
    public function artikels()
    {
        return $this->belongsToMany(Artikel::class, 'koleksi_artikel', 'koleksi_id', 'artikel_id')->withTimestamps();
    }

    /**
     * Relasi ke user pemilik koleksi (jika pakai sistem user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
