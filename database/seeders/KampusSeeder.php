<?php
namespace Database\Seeders;

use App\Models\Kampus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KampusSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['UNIPDU Jombang','Kompleks Pondok Pesantren Darul Ulum, Peterongan, Jombang','info@unipdu.ac.id','0321000001','Ahmad Fauzi'],
            ['Universitas Darul Ulum Jombang','Jl. Gus Dur No. 29A, Jombang','info@undar.ac.id','0321000002','Muhammad Rizal'],
            ['STKIP PGRI Jombang','Jl. Pattimura III No. 20, Jombang','info@stkipjb.ac.id','0321000003','Bagus Pratama'],
            ['Universitas KH A Wahab Hasbullah','Tambakberas, Jombang','info@unwaha.ac.id','0321000004','Ali Mustofa'],
            ['STIE PGRI Dewantara','Jl. Prof. Moh. Yamin No. 77, Jombang','info@stiedewantara.ac.id','0321000005','Dimas Saputra'],
            ['Poltekkes Kemenkes Jombang','Jl. Dr. Sutomo, Jombang','info@poltekkesjombang.ac.id','0321000006','Hendra Wijaya'],
            ['STIKES Insan Cendekia Medika','Jl. Halmahera No. 33, Jombang','info@stikesicme.ac.id','0321000007','Rizky Ramadhan'],
            ['Universitas Pesantren Tinggi Darul Ulum','Peterongan, Jombang','kampus@unipdu.ac.id','0321000008','Naufal Hakim'],
        ];
        foreach ($data as $item) Kampus::updateOrCreate(['slug'=>Str::slug($item[0])], ['nama_kampus'=>$item[0], 'slug'=>Str::slug($item[0]), 'alamat'=>$item[1], 'email'=>$item[2], 'telepon'=>$item[3], 'kapus'=>$item[4], 'status'=>'aktif']);
    }
}
