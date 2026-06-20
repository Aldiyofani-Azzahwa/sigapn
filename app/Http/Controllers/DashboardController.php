<?php
namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kampus;
use App\Models\Kegiatan;
use App\Models\Pengurus;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $kampusScope = $user->hasRole('Super Admin') ? null : $user->kampus_id;

        $anggotaQuery = Anggota::query()->when($kampusScope, fn($q) => $q->where('kampus_id', $kampusScope));
        $pengurusQuery = Pengurus::query()->when($kampusScope, fn($q) => $q->where('kampus_id', $kampusScope));
        $kegiatanQuery = Kegiatan::query()->when($kampusScope, fn($q) => $q->where('kampus_id', $kampusScope));

        $anggotaPerKampus = Kampus::withCount('anggotas')->orderBy('nama_kampus')->get();
        $gender = (clone $anggotaQuery)->selectRaw('jenis_kelamin, COUNT(*) as total')->groupBy('jenis_kelamin')->pluck('total', 'jenis_kelamin');
        $sabuk = (clone $anggotaQuery)->selectRaw('tingkatan_sabuk, COUNT(*) as total')->groupBy('tingkatan_sabuk')->pluck('total', 'tingkatan_sabuk');
        $pertumbuhan = (clone $anggotaQuery)->selectRaw('angkatan, COUNT(*) as total')->groupBy('angkatan')->orderBy('angkatan')->pluck('total', 'angkatan');

        return view('dashboard', [
            'totalKampus' => Kampus::count(),
            'totalAnggota' => $anggotaQuery->count(),
            'totalPengurus' => $pengurusQuery->count(),
            'totalKapus' => Kampus::whereNotNull('kapus')->count(),
            'totalKegiatan' => $kegiatanQuery->count(),
            'anggotaPerKampus' => $anggotaPerKampus,
            'gender' => $gender,
            'sabuk' => $sabuk,
            'pertumbuhan' => $pertumbuhan,
        ]);
    }
}
