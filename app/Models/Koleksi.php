<?php
// app/Models/Koleksi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    use HasFactory;
    protected $table = 'koleksi';
    protected $fillable = ['name', 'author', 'article_count'];
}
