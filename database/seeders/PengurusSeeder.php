<?php
namespace Database\Seeders;

use App\Models\Kampus;
use App\Models\Pengurus;
use Illuminate\Database\Seeder;

class PengurusSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Kampus::all() as $kampus) {
            foreach (['Ketua','Sekretaris','Bendahara'] as $jabatan) {
                Pengurus::create(['kampus_id'=>$kampus->id,'nama_lengkap'=>fake('id_ID')->name(),'jabatan'=>$jabatan,'periode'=>'2026/2027','nomor_hp'=>'08'.fake()->numerify('##########'),'email'=>fake()->safeEmail(),'status'=>'aktif']);
            }
        }
    }
}
