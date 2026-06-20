<?php
namespace App\Imports;

use App\Models\Anggota;
use App\Models\Kampus;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnggotaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $kampus = Kampus::first();
        if (! $kampus) return null;
        return new Anggota([
            'kampus_id' => $kampus->id,
            'nia' => $row['nia'] ?? 'PN-IMP-'.Str::upper(Str::random(8)),
            'nama_lengkap' => $row['nama'] ?? $row['nama_lengkap'] ?? 'Anggota Import',
            'tempat_lahir' => $row['tempat_lahir'] ?? 'Jombang',
            'tanggal_lahir' => $row['tanggal_lahir'] ?? now()->subYears(20)->format('Y-m-d'),
            'jenis_kelamin' => $row['jenis_kelamin'] ?? 'Laki-laki',
            'fakultas' => $row['fakultas'] ?? null,
            'prodi' => $row['prodi'] ?? null,
            'angkatan' => $row['angkatan'] ?? date('Y'),
            'tingkatan_sabuk' => $row['tingkatan_sabuk'] ?? 'Putih',
            'nomor_hp' => $row['nomor_hp'] ?? null,
            'email' => $row['email'] ?? null,
            'alamat' => $row['alamat'] ?? null,
            'status_aktif' => $row['status_aktif'] ?? 'aktif',
            'verification_token' => (string) Str::uuid(),
            'verified_at' => now(),
        ]);
    }
}
