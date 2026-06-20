<?php
namespace Database\Seeders;

use App\Models\Kampus;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Kampus::take(5)->get() as $kampus) {
            Kegiatan::create(['kampus_id'=>$kampus->id,'nama_kegiatan'=>'Latihan Rutin '.$kampus->nama_kampus,'tanggal'=>now()->addDays(rand(1,20)),'lokasi'=>'Aula Kampus','deskripsi'=>'Latihan rutin anggota Pagar Nusa tingkat kampus.','qr_absensi_token'=>(string) Str::uuid(),'status'=>'aktif']);
        }
    }
}
