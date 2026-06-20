<?php
namespace App\Http\Controllers;

use App\Models\Kampus;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index() { return view('pengurus.index', ['pengurus' => Pengurus::with('kampus')->latest()->paginate(10)]); }
    public function create() { return view('pengurus.create', ['kampuses' => Kampus::orderBy('nama_kampus')->get()]); }
    public function store(Request $request) { Pengurus::create($this->validated($request)); return redirect()->route('pengurus.index')->with('success','Pengurus berhasil ditambahkan.'); }
    public function show(Pengurus $pengurus) { return view('pengurus.show', compact('pengurus')); }
    public function edit(Pengurus $pengurus) { return view('pengurus.edit', ['pengurus'=>$pengurus,'kampuses'=>Kampus::orderBy('nama_kampus')->get()]); }
    public function update(Request $request, Pengurus $pengurus) { $pengurus->update($this->validated($request)); return redirect()->route('pengurus.index')->with('success','Pengurus berhasil diperbarui.'); }
    public function destroy(Pengurus $pengurus) { $pengurus->delete(); return back()->with('success','Pengurus berhasil dihapus.'); }
    private function validated(Request $request): array { return $request->validate(['kampus_id'=>['required','exists:kampus,id'],'nama_lengkap'=>['required','max:255'],'jabatan'=>['required','max:100'],'periode'=>['nullable','max:50'],'nomor_hp'=>['nullable','max:30'],'email'=>['nullable','email'],'status'=>['required','in:aktif,nonaktif']]); }
}
