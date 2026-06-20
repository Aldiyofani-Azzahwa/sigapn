<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kampus extends Model
{
    use HasFactory;
    protected $table = 'kampus';
    protected $fillable = ['nama_kampus', 'slug', 'alamat', 'email', 'telepon', 'logo', 'kapus', 'status'];
    public function users() { return $this->hasMany(User::class); }
    public function anggotas() { return $this->hasMany(Anggota::class); }
    public function pengurus() { return $this->hasMany(Pengurus::class); }
    public function kegiatans() { return $this->hasMany(Kegiatan::class); }
}
