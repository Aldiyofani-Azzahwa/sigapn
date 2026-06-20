<?php
namespace App\Http\Controllers;

use App\Models\Kampus;
use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index() { return view('surat.index', ['surats' => Surat::with('kampus')->latest()->paginate(10)]); }
    public function create() { return view('surat.create', ['kampuses'=>Kampus::orderBy('nama_kampus')->get()]); }
    public function store(Request $request) { $data=$request->validate(['kampus_id'=>['nullable','exists:kampus,id'],'nomor_surat'=>['required','unique:surats,nomor_surat'],'jenis_surat'=>['required','max:100'],'perihal'=>['required','max:255'],'tanggal_surat'=>['required','date'],'file'=>['nullable','file','max:4096'],'status'=>['required','in:draft,arsip']]); $data['created_by']=auth()->id(); if($request->hasFile('file')) $data['file']=$request->file('file')->store('surat','public'); Surat::create($data); return redirect()->route('surat.index')->with('success','Surat berhasil disimpan.'); }
    public function show(Surat $surat) { return view('surat.show', compact('surat')); }
    public function edit(Surat $surat) { return view('surat.edit', ['surat'=>$surat,'kampuses'=>Kampus::orderBy('nama_kampus')->get()]); }
    public function update(Request $request, Surat $surat) { $data=$request->validate(['kampus_id'=>['nullable','exists:kampus,id'],'nomor_surat'=>['required','unique:surats,nomor_surat,'.$surat->id],'jenis_surat'=>['required','max:100'],'perihal'=>['required','max:255'],'tanggal_surat'=>['required','date'],'file'=>['nullable','file','max:4096'],'status'=>['required','in:draft,arsip']]); if($request->hasFile('file')) $data['file']=$request->file('file')->store('surat','public'); $surat->update($data); return redirect()->route('surat.index')->with('success','Surat berhasil diperbarui.'); }
    public function destroy(Surat $surat) { $surat->delete(); return back()->with('success','Surat berhasil dihapus.'); }
}
