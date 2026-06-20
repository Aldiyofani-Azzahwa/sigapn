<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $fillable = ['kampus_id','created_by','nomor_surat','jenis_surat','perihal','tanggal_surat','file','status'];
    protected $casts = ['tanggal_surat' => 'date'];
    public function kampus() { return $this->belongsTo(Kampus::class); }
    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
}
