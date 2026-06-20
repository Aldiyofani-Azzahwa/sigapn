<?php
namespace App\Http\Controllers;

use App\Models\Anggota;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function anggotaPdf()
    {
        $anggotas = Anggota::with('kampus')->orderBy('nama_lengkap')->get();
        $pdf = Pdf::loadView('laporan.anggota-pdf', compact('anggotas'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan-anggota-sigapn.pdf');
    }
}
