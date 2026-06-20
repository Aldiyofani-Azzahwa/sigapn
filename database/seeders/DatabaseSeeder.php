<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([RolePermissionSeeder::class, KampusSeeder::class, AdminSeeder::class, AnggotaSeeder::class, PengurusSeeder::class, KegiatanSeeder::class, BeritaSeeder::class]);
    }
}
