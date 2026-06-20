<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $fillable = ['kegiatan_id','anggota_id','waktu_absen','status','keterangan'];
    protected $casts = ['waktu_absen' => 'datetime'];
    public function kegiatan() { return $this->belongsTo(Kegiatan::class); }
    public function anggota() { return $this->belongsTo(Anggota::class); }
}
