<?php
namespace Database\Seeders;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        for ($i=1; $i<=3; $i++) {
            $judul = 'Kegiatan Pagar Nusa Kampus Jombang '.$i;
            Berita::create(['author_id'=>$admin?->id,'judul'=>$judul,'slug'=>Str::slug($judul), 'kategori'=>'Kegiatan','isi'=>'SIGAPN mendukung pengelolaan anggota, kegiatan, dan administrasi Pagar Nusa kampus secara digital.','status'=>'publish','published_at'=>now()]);
        }
    }
}
