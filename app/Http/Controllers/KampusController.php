<?php
namespace App\Http\Controllers;

use App\Models\Kampus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KampusController extends Controller
{
    public function index()
    {
        $kampuses = Kampus::withCount(['anggotas', 'pengurus'])->latest()->paginate(10);
        return view('kampus.index', compact('kampuses'));
    }
    public function create() { return view('kampus.create'); }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kampus' => ['required','string','max:255'], 'alamat' => ['nullable','string'], 'email' => ['nullable','email'], 'telepon' => ['nullable','string','max:30'], 'kapus' => ['nullable','string','max:255'], 'status' => ['required','in:aktif,nonaktif'],
        ]);
        $data['slug'] = Str::slug($data['nama_kampus']).'-'.Str::random(5);
        if ($request->hasFile('logo')) $data['logo'] = $request->file('logo')->store('kampus', 'public');
        Kampus::create($data);
        return redirect()->route('kampus.index')->with('success', 'Kampus berhasil ditambahkan.');
    }
    public function show(Kampus $kampus) { $kampus->loadCount(['anggotas','pengurus','kegiatans']); return view('kampus.show', compact('kampus')); }
    public function edit(Kampus $kampus) { return view('kampus.edit', compact('kampus')); }
    public function update(Request $request, Kampus $kampus)
    {
        $data = $request->validate([
            'nama_kampus' => ['required','string','max:255'], 'alamat' => ['nullable','string'], 'email' => ['nullable','email'], 'telepon' => ['nullable','string','max:30'], 'kapus' => ['nullable','string','max:255'], 'status' => ['required','in:aktif,nonaktif'],
        ]);
        if ($kampus->nama_kampus !== $data['nama_kampus']) $data['slug'] = Str::slug($data['nama_kampus']).'-'.Str::random(5);
        if ($request->hasFile('logo')) $data['logo'] = $request->file('logo')->store('kampus', 'public');
        $kampus->update($data);
        return redirect()->route('kampus.index')->with('success', 'Kampus berhasil diperbarui.');
    }
    public function destroy(Kampus $kampus)
    {
        $kampus->delete();
        return redirect()->route('kampus.index')->with('success', 'Kampus berhasil dihapus.');
    }
}
