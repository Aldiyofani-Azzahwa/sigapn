<?php
namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index() { return view('berita.index', ['beritas' => Berita::latest()->paginate(10)]); }
    public function create() { return view('berita.create'); }
    public function store(Request $request) { $data=$this->validated($request); $data['author_id']=auth()->id(); $data['slug']=Str::slug($data['judul']).'-'.Str::random(5); if($request->hasFile('thumbnail')) $data['thumbnail']=$request->file('thumbnail')->store('berita','public'); if($data['status']==='publish') $data['published_at']=now(); Berita::create($data); return redirect()->route('berita.index')->with('success','Berita berhasil ditambahkan.'); }
    public function show(Berita $berita) { return view('berita.show', compact('berita')); }
    public function edit(Berita $berita) { return view('berita.edit', compact('berita')); }
    public function update(Request $request, Berita $berita) { $data=$this->validated($request); if($request->hasFile('thumbnail')) $data['thumbnail']=$request->file('thumbnail')->store('berita','public'); if($data['status']==='publish' && !$berita->published_at) $data['published_at']=now(); $berita->update($data); return redirect()->route('berita.index')->with('success','Berita berhasil diperbarui.'); }
    public function destroy(Berita $berita) { $berita->delete(); return back()->with('success','Berita berhasil dihapus.'); }
    private function validated(Request $request): array { return $request->validate(['judul'=>['required','max:255'],'kategori'=>['nullable','max:100'],'thumbnail'=>['nullable','image','max:4096'],'isi'=>['required'],'status'=>['required','in:draft,publish']]); }
}
