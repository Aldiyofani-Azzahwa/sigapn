<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $fillable = ['kampus_id','penanggung_jawab_id','nama_kegiatan','tanggal','lokasi','deskripsi','dokumentasi','qr_absensi_token','status'];
    protected $casts = ['tanggal' => 'date'];
    public function kampus() { return $this->belongsTo(Kampus::class); }
    public function penanggungJawab() { return $this->belongsTo(User::class, 'penanggung_jawab_id'); }
    public function absensis() { return $this->hasMany(Absensi::class); }
}
