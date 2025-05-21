<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Read extends Model
{
    protected $fillable = ['user_id','artikel_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artikel()
    {
        return $this->belongsTo(Artikel::class);
    }
}
