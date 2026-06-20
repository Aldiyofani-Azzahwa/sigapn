<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','kampus_id','nia','nama_lengkap','tempat_lahir','tanggal_lahir','jenis_kelamin','fakultas','prodi','angkatan','tingkatan_sabuk','nomor_hp','email','alamat','foto','status_aktif','verification_token','verified_at'];
    protected $casts = ['tanggal_lahir' => 'date', 'verified_at' => 'datetime'];
    public function kampus() { return $this->belongsTo(Kampus::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function absensis() { return $this->hasMany(Absensi::class); }
}
