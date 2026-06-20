<?php
namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Kampus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $fakultas = ['Fakultas Teknik','Fakultas Ekonomi','Fakultas Tarbiyah','Fakultas Kesehatan','Fakultas Ilmu Pendidikan','Fakultas Hukum'];
        $prodi = ['Sistem Informasi','Manajemen','Pendidikan Bahasa Indonesia','Keperawatan','Pendidikan Matematika','Hukum Keluarga Islam','Akuntansi','Teknik Informatika'];
        $sabuk = ['Putih','Kuning','Hijau','Biru','Coklat','Hitam'];
        foreach (Kampus::all() as $kampus) {
            for ($i=1; $i<=20; $i++) {
                $gender = fake()->randomElement(['Laki-laki','Perempuan']);
                $nama = $gender === 'Laki-laki' ? fake('id_ID')->firstNameMale().' '.fake('id_ID')->lastName() : fake('id_ID')->firstNameFemale().' '.fake('id_ID')->lastName();
                $year = fake()->numberBetween(2020, 2026);
                $nia = 'PN-JBG-'.str_pad($kampus->id,2,'0',STR_PAD_LEFT).'-'.$year.'-'.str_pad($i,4,'0',STR_PAD_LEFT);
                Anggota::updateOrCreate(['nia'=>$nia], ['kampus_id'=>$kampus->id,'nama_lengkap'=>$nama,'tempat_lahir'=>fake('id_ID')->city(),'tanggal_lahir'=>fake()->dateTimeBetween('-25 years','-18 years')->format('Y-m-d'),'jenis_kelamin'=>$gender,'fakultas'=>fake()->randomElement($fakultas),'prodi'=>fake()->randomElement($prodi),'angkatan'=>$year,'tingkatan_sabuk'=>fake()->randomElement($sabuk),'nomor_hp'=>'08'.fake()->numerify('##########'),'email'=>Str::slug($nama).$kampus->id.$i.'@gmail.com','alamat'=>fake('id_ID')->address(),'status_aktif'=>'aktif','verification_token'=>(string) Str::uuid(),'verified_at'=>now()]);
            }
        }
    }
}
