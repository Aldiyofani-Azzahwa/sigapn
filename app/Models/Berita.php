<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $fillable = ['author_id','judul','slug','kategori','thumbnail','isi','status','published_at'];
    protected $casts = ['published_at' => 'datetime'];
    public function author() { return $this->belongsTo(User::class, 'author_id'); }
    public function galeries() { return $this->hasMany(BeritaGalery::class); }
}
