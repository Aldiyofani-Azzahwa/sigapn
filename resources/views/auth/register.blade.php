<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Anggota SIGAPN</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950">
<div class="flex min-h-screen items-center justify-center px-6 py-10">
    <div class="w-full max-w-3xl rounded-3xl bg-white p-8 shadow-2xl">
        <div class="mb-6 text-center">
            <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-800 font-black text-yellow-300">
                PN
            </div>
            <h1 class="text-2xl font-black text-slate-900">Daftar Anggota SIGAPN</h1>
            <p class="text-sm text-slate-500">Lengkapi data akun dan data anggota</p>
        </div>

        @if($errors->any())
            <div class="mb-4 rounded-xl bg-red-100 p-3 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="grid gap-4 md:grid-cols-2">
            @csrf

            <div>
                <label class="text-sm font-semibold">Nama Lengkap</label>
                <input name="name" value="{{ old('name') }}" class="mt-1 w-full rounded-2xl border-slate-300" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" class="mt-1 w-full rounded-2xl border-slate-300" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Password</label>
                <input name="password" type="password" class="mt-1 w-full rounded-2xl border-slate-300" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Konfirmasi Password</label>
                <input name="password_confirmation" type="password" class="mt-1 w-full rounded-2xl border-slate-300" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Kampus</label>
                <select name="kampus_id" class="mt-1 w-full rounded-2xl border-slate-300" required>
                    <option value="">Pilih Kampus</option>
                    @foreach($kampuses as $kampus)
                        <option value="{{ $kampus->id }}" @selected(old('kampus_id') == $kampus->id)>
                            {{ $kampus->nama_kampus }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm font-semibold">NIA</label>
                <input name="nia" value="{{ old('nia') }}" class="mt-1 w-full rounded-2xl border-slate-300" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Tempat Lahir</label>
                <input name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="mt-1 w-full rounded-2xl border-slate-300" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Tanggal Lahir</label>
                <input name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir') }}" class="mt-1 w-full rounded-2xl border-slate-300" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="mt-1 w-full rounded-2xl border-slate-300" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" @selected(old('jenis_kelamin') === 'Laki-laki')>Laki-laki</option>
                    <option value="Perempuan" @selected(old('jenis_kelamin') === 'Perempuan')>Perempuan</option>
                </select>
            </div>

            <div>
                <label class="text-sm font-semibold">Tingkatan Sabuk</label>
                <input name="tingkatan_sabuk" value="{{ old('tingkatan_sabuk', 'Putih') }}" class="mt-1 w-full rounded-2xl border-slate-300" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Fakultas</label>
                <input name="fakultas" value="{{ old('fakultas') }}" class="mt-1 w-full rounded-2xl border-slate-300">
            </div>

            <div>
                <label class="text-sm font-semibold">Prodi</label>
                <input name="prodi" value="{{ old('prodi') }}" class="mt-1 w-full rounded-2xl border-slate-300">
            </div>

            <div>
                <label class="text-sm font-semibold">Angkatan</label>
                <input name="angkatan" value="{{ old('angkatan') }}" class="mt-1 w-full rounded-2xl border-slate-300">
            </div>

            <div>
                <label class="text-sm font-semibold">Nomor HP</label>
                <input name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-2xl border-slate-300">
            </div>

            <div class="md:col-span-2">
                <label class="text-sm font-semibold">Alamat</label>
                <textarea name="alamat" rows="3" class="mt-1 w-full rounded-2xl border-slate-300">{{ old('alamat') }}</textarea>
            </div>

            <div class="md:col-span-2">
                <button class="w-full rounded-2xl bg-emerald-800 py-3 font-bold text-white">
                    Daftar Anggota
                </button>
            </div>
        </form>

        <p class="mt-5 text-center text-sm text-slate-500">
            Sudah punya akun?
            <a class="font-bold text-emerald-700" href="{{ route('login') }}">Login</a>
        </p>
    </div>
</div>
</body>
</html>