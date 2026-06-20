<aside id="adminSidebar" class="fixed left-0 top-0 z-50 h-screen w-72 -translate-x-full border-r border-white/10 bg-slate-950 transition-transform lg:translate-x-0">
    <div class="flex h-full flex-col">
        <div class="border-b border-white/10 px-6 py-5"><div class="flex items-center gap-3"><div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-800 text-lg font-black text-yellow-300">PN</div><div><h1 class="text-lg font-black text-white">SIGAPN</h1><p class="text-xs text-slate-400">Pagar Nusa Kampus</p></div></div></div>
        <div class="sidebar-scroll flex-1 overflow-y-auto px-4 py-5">
            <p class="mb-4 px-4 text-xs font-semibold uppercase tracking-widest text-slate-500">Menu Utama</p>
            <nav class="space-y-2">
                <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">Dashboard</x-sidebar-link>
                @hasanyrole('Super Admin|Ketum|Pengurus')
                <x-sidebar-link href="{{ route('kampus.index') }}" :active="request()->is('kampus*')">Kampus</x-sidebar-link>
                <x-sidebar-link href="{{ route('anggota.index') }}" :active="request()->is('anggota*')">Anggota</x-sidebar-link>
                <x-sidebar-link href="{{ route('pengurus.index') }}" :active="request()->is('pengurus*')">Pengurus</x-sidebar-link>
                <x-sidebar-link href="{{ route('kegiatan.index') }}" :active="request()->is('kegiatan*')">Kegiatan</x-sidebar-link>
                <x-sidebar-link href="{{ route('absensi.index') }}" :active="request()->is('absensi*')">Absensi</x-sidebar-link>
                @endhasanyrole
                @role('Super Admin')
                <x-sidebar-link href="{{ route('berita.index') }}" :active="request()->is('berita*')">Berita</x-sidebar-link>
                <x-sidebar-link href="{{ route('surat.index') }}" :active="request()->is('surat*')">Surat</x-sidebar-link>
                <x-sidebar-link href="{{ route('rayon.index') }}" :active="request()->is('rayon*')">Rayon</x-sidebar-link>
                <x-sidebar-link href="{{ route('komisariat.index') }}" :active="request()->is('komisariat*')">Komisariat</x-sidebar-link>
                <x-sidebar-link href="{{ route('ukm.index') }}" :active="request()->is('ukm*')">UKM</x-sidebar-link>
                @endrole
                <x-sidebar-link href="{{ route('kartu.saya') }}" :active="request()->is('kartu-saya*')">Kartu Saya</x-sidebar-link>
            </nav>
        </div>
        <div class="border-t border-white/10 p-4"><div class="rounded-3xl bg-white/10 p-4"><p class="text-xs text-slate-400">Login sebagai</p><p class="truncate text-sm font-semibold text-white">{{ auth()->user()->name }}</p><p class="text-xs text-yellow-300">{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</p></div></div>
    </div>
</aside><div id="sidebarBackdrop" class="fixed inset-0 z-40 hidden bg-slate-950/70 backdrop-blur-sm lg:hidden"></div>
