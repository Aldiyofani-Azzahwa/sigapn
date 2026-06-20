<?php
namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Anggota;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index() { return view('absensi.index', ['kegiatans' => Kegiatan::withCount('absensis')->latest()->paginate(10)]); }
    public function show(Kegiatan $kegiatan) { $kegiatan->load('absensis.anggota'); return view('absensi.show', ['kegiatan'=>$kegiatan, 'anggotas'=>Anggota::orderBy('nama_lengkap')->get()]); }
    public function store(Request $request, Kegiatan $kegiatan) { $data=$request->validate(['anggota_id'=>['required','exists:anggotas,id'],'status'=>['required','in:hadir,izin,sakit,alpha'],'keterangan'=>['nullable','max:255']]); $data['kegiatan_id']=$kegiatan->id; $data['waktu_absen']=now(); Absensi::updateOrCreate(['kegiatan_id'=>$kegiatan->id,'anggota_id'=>$data['anggota_id']],$data); return back()->with('success','Absensi berhasil disimpan.'); }
}
