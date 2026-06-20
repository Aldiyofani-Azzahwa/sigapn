<?php
namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Berita;
use App\Models\Kampus;
use App\Models\Kegiatan;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.index', [
            'totalKampus' => Kampus::count(),
            'totalAnggota' => Anggota::where('status_aktif', 'aktif')->count(),
            'totalKegiatan' => Kegiatan::count(),
            'beritas' => Berita::where('status', 'publish')->latest()->take(3)->get(),
            'kampuses' => Kampus::latest()->get(),
        ]);
    }

    public function berita(Berita $berita)
    {
        return view('landing.berita-show', compact('berita'));
    }
}
