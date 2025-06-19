<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'judul',
        'kategori',
        'isi',
        'gambar',
        'penulis',
        'content_mudah',
        'content_sedang',
        'content_sulit',
    ];

    // app/Models/Artikel.php
    public function readers()
    {
    return $this->hasMany(Read::class);
    }
    public function koleksis()
    {
    return $this->belongsToMany(Koleksi::class, 'koleksi_artikel', 'artikel_id', 'koleksi_id')->withTimestamps();
    }

}
