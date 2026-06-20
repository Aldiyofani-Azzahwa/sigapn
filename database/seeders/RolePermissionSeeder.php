<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions = ['lihat dashboard','kelola kampus','kelola kapus','kelola pengurus','kelola anggota','verifikasi anggota','kelola rayon','kelola komisariat','kelola ukm','kelola berita','kelola event','kelola surat','kelola kartu anggota','import excel','export excel','cetak pdf','kelola absensi','lihat profil','download kartu','update foto','lihat riwayat latihan','lihat sertifikat'];
        foreach ($permissions as $permission) Permission::firstOrCreate(['name'=>$permission,'guard_name'=>'web']);
        $super = Role::firstOrCreate(['name'=>'Super Admin','guard_name'=>'web']);
        $ketum = Role::firstOrCreate(['name'=>'Ketum','guard_name'=>'web']);
        $pengurus = Role::firstOrCreate(['name'=>'Pengurus','guard_name'=>'web']);
        $anggota = Role::firstOrCreate(['name'=>'Anggota','guard_name'=>'web']);
        $super->syncPermissions(Permission::all());
        $ketum->syncPermissions(['lihat dashboard','kelola anggota','verifikasi anggota','kelola pengurus','kelola event','export excel','cetak pdf','kelola absensi']);
        $pengurus->syncPermissions(['lihat dashboard','kelola anggota','kelola event','kelola absensi','export excel','cetak pdf']);
        $anggota->syncPermissions(['lihat dashboard','lihat profil','download kartu','update foto','lihat riwayat latihan','lihat sertifikat']);
    }
}
