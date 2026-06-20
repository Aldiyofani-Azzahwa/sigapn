<x-app-layout>
    <div
        class="mx-auto max-w-lg rounded-[2rem] bg-gradient-to-br from-emerald-900 to-emerald-700 p-6 text-white shadow-2xl">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-widest text-yellow-300">Kartu Anggota Digital</p>
                <h1 class="text-2xl font-black">Pagar Nusa</h1>
            </div>
            <div class="rounded-2xl bg-yellow-300 px-4 py-3 font-black text-emerald-950">PN</div>
        </div>
        <div class="mt-8 rounded-3xl bg-white/10 p-5">
            <h2 class="text-2xl font-black">{{ $anggota->nama_lengkap }}</h2>
            <p class="mt-1 text-yellow-200">{{ $anggota->nia }}</p>
            <p class="mt-3">{{ $anggota->kampus?->nama_kampus }}</p>
            <p>{{ $anggota->tingkatan_sabuk }}</p>
        </div>
        <div class="mt-6 rounded-2xl bg-white p-4 text-center text-slate-900">{!! $qr !!}
            <p class="mt-2 text-xs">Scan untuk verifikasi</p>
        </div><a href="{{ $downloadUrl ?? route('anggota.kartu.pdf', $anggota) }}"
            class="mt-6 block rounded-2xl bg-yellow-300 py-3 text-center font-black text-emerald-950">Download PDF</a>
</x-app-layout>