<?php
namespace App\Http\Controllers;

use App\Exports\AnggotaExport;
use App\Imports\AnggotaImport;
use App\Models\Anggota;
use App\Models\Kampus;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $anggotas = Anggota::with('kampus')
            ->when($request->search, fn($q) => $q->where('nama_lengkap', 'like', '%' . $request->search . '%')->orWhere('nia', 'like', '%' . $request->search . '%'))
            ->latest()->paginate(10)->withQueryString();
        return view('anggota.index', compact('anggotas'));
    }
    public function create()
    {
        return view('anggota.create', ['kampuses' => Kampus::orderBy('nama_kampus')->get()]);
    }
    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['verification_token'] = (string) Str::uuid();
        if ($request->hasFile('foto'))
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        Anggota::create($data);
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }
    public function show(Anggota $anggota)
    {
        $anggota->load('kampus');
        return view('anggota.show', compact('anggota'));
    }
    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', ['anggota' => $anggota, 'kampuses' => Kampus::orderBy('nama_kampus')->get()]);
    }
    public function update(Request $request, Anggota $anggota)
    {
        $data = $this->validated($request, $anggota->id);
        if ($request->hasFile('foto'))
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        $anggota->update($data);
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }
    public function destroy(Anggota $anggota)
    {
        $anggota->delete();
        return back()->with('success', 'Anggota berhasil dihapus.');
    }

    public function kartu(Anggota $anggota)
    {
        $anggota->load('kampus');
        $qr = $this->makeQrSvg(route('verify.anggota', $anggota->verification_token), 120);
        return view('anggota.kartu', compact('anggota', 'qr'));
    }
    public function kartuPdf(Anggota $anggota)
    {
        $anggota->load('kampus');
        $qr = $this->makeQrSvg(route('verify.anggota', $anggota->verification_token), 100);
        $pdf = Pdf::loadView('anggota.kartu-pdf', compact('anggota', 'qr'))->setPaper('a4', 'portrait');
        return $pdf->download('kartu-' . $anggota->nia . '.pdf');
    }
    public function kartuSaya()
    {
        $anggota = auth()->user()
            ->anggota()
            ->with('kampus')
            ->first();

        if (!$anggota) {
            return view('empty-state', [
                'title' => 'Kartu belum tersedia',
                'message' => 'Akun Anda belum terhubung dengan data anggota.',
            ]);
        }

        if ($anggota->status_aktif !== 'aktif') {
            return view('empty-state', [
                'title' => 'Menunggu Verifikasi',
                'message' => 'Data anggota Anda sudah masuk. Kartu anggota akan tersedia setelah diverifikasi oleh pengurus.',
            ]);
        }

        $qr = $this->makeQrSvg(route('verify.anggota', $anggota->verification_token), 120);
        $downloadUrl = route('kartu.saya.pdf');

        return view('anggota.kartu', compact('anggota', 'qr', 'downloadUrl'));
    }

    public function kartuSayaPdf()
    {
        $anggota = auth()->user()
            ->anggota()
            ->with('kampus')
            ->first();

        if (!$anggota || $anggota->status_aktif !== 'aktif') {
            return redirect()
                ->route('kartu.saya')
                ->withErrors(['kartu' => 'Kartu belum tersedia karena data anggota belum aktif.']);
        }

        $qr = $this->makeQrSvg(route('verify.anggota', $anggota->verification_token), 100);

        $pdf = Pdf::loadView('anggota.kartu-pdf', compact('anggota', 'qr'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('kartu-' . $anggota->nia . '.pdf');
    }
    public function export()
    {
        return Excel::download(new AnggotaExport, 'data-anggota-sigapn.xlsx');
    }
    public function import(Request $request)
    {
        $request->validate(['file' => ['required', 'file', 'mimes:xlsx,xls,csv']]);
        Excel::import(new AnggotaImport, $request->file('file'));
        return back()->with('success', 'Import anggota berhasil.');
    }
    private function makeQrSvg(string $text, int $size = 120): string
    {
        $renderer = new ImageRenderer(new RendererStyle($size), new SvgImageBackEnd());
        return (new Writer($renderer))->writeString($text);
    }

    private function validated(Request $request, ?int $ignore = null): array
    {
        return $request->validate([
            'kampus_id' => ['required', 'exists:kampus,id'],
            'nia' => ['required', 'string', 'max:100', 'unique:anggotas,nia' . ($ignore ? ',' . $ignore : '')],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'fakultas' => ['nullable', 'string', 'max:255'],
            'prodi' => ['nullable', 'string', 'max:255'],
            'angkatan' => ['nullable', 'digits:4'],
            'tingkatan_sabuk' => ['required', 'string', 'max:50'],
            'nomor_hp' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'max:2048'],
            'status_aktif' => ['required', 'in:aktif,nonaktif,menunggu_verifikasi'],
        ]);
    }
}
