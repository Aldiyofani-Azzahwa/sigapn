<?php
namespace App\Http\Controllers;

use App\Models\Kampus;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    public function index() { return view('kegiatan.index', ['kegiatans' => Kegiatan::with('kampus')->latest()->paginate(10)]); }
    public function create() { return view('kegiatan.create', ['kampuses' => Kampus::orderBy('nama_kampus')->get()]); }
    public function store(Request $request) { $data=$this->validated($request); $data['penanggung_jawab_id']=auth()->id(); $data['qr_absensi_token']=(string) Str::uuid(); if($request->hasFile('dokumentasi')) $data['dokumentasi']=$request->file('dokumentasi')->store('kegiatan','public'); Kegiatan::create($data); return redirect()->route('kegiatan.index')->with('success','Kegiatan berhasil ditambahkan.'); }
    public function show(Kegiatan $kegiatan) { $kegiatan->load('kampus','absensis.anggota'); return view('kegiatan.show', compact('kegiatan')); }
    public function edit(Kegiatan $kegiatan) { return view('kegiatan.edit', ['kegiatan'=>$kegiatan,'kampuses'=>Kampus::orderBy('nama_kampus')->get()]); }
    public function update(Request $request, Kegiatan $kegiatan) { $data=$this->validated($request); if($request->hasFile('dokumentasi')) $data['dokumentasi']=$request->file('dokumentasi')->store('kegiatan','public'); $kegiatan->update($data); return redirect()->route('kegiatan.index')->with('success','Kegiatan berhasil diperbarui.'); }
    public function destroy(Kegiatan $kegiatan) { $kegiatan->delete(); return back()->with('success','Kegiatan berhasil dihapus.'); }
    private function validated(Request $request): array { return $request->validate(['kampus_id'=>['nullable','exists:kampus,id'],'nama_kegiatan'=>['required','max:255'],'tanggal'=>['required','date'],'lokasi'=>['required','max:255'],'deskripsi'=>['nullable'],'dokumentasi'=>['nullable','image','max:4096'],'status'=>['required','in:draft,aktif,selesai']]); }
}
