<?php
namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnggotaExport implements FromQuery, WithHeadings, WithMapping
{
    public function query() { return Anggota::query()->with('kampus')->orderBy('nama_lengkap'); }
    public function headings(): array { return ['NIA','Nama','Kampus','Gender','Fakultas','Prodi','Angkatan','Sabuk','HP','Email','Status']; }
    public function map($anggota): array { return [$anggota->nia,$anggota->nama_lengkap,$anggota->kampus?->nama_kampus,$anggota->jenis_kelamin,$anggota->fakultas,$anggota->prodi,$anggota->angkatan,$anggota->tingkatan_sabuk,$anggota->nomor_hp,$anggota->email,$anggota->status_aktif]; }
}
