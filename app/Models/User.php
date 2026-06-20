<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = ['kampus_id', 'name', 'email', 'password', 'phone', 'photo', 'status'];
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return ['email_verified_at' => 'datetime', 'password' => 'hashed'];
    }

    public function kampus() { return $this->belongsTo(Kampus::class); }
    public function anggota() { return $this->hasOne(Anggota::class); }
    public function pengurus() { return $this->hasOne(Pengurus::class); }
}
