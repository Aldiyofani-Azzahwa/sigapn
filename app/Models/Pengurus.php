<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;
    protected $table = 'pengurus';
    protected $fillable = ['user_id','kampus_id','nama_lengkap','jabatan','periode','nomor_hp','email','status'];
    public function kampus() { return $this->belongsTo(Kampus::class); }
    public function user() { return $this->belongsTo(User::class); }
}
