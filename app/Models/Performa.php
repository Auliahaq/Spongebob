<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performa extends Model
{
    protected $table = 'performa';       // sesuaikan nama tabel
    protected $fillable = ['user_id', 'artikel_id', 'level'];
    public $timestamps = false;           // atau true jika ada created_at/updated_at
}
