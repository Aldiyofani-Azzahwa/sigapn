<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaGalery extends Model
{
    use HasFactory;
    protected $fillable = ['berita_id','foto','caption'];
    public function berita() { return $this->belongsTo(Berita::class); }
}
