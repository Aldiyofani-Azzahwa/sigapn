<div><label>Kampus</label><select name="kampus_id" class="mt-1 w-full rounded-2xl border-slate-300"
        required>@foreach($kampuses as $kampus)<option value="{{ $kampus->id }}"
            @selected(old('kampus_id', $anggota->kampus_id ?? '') == $kampus->id)>{{ $kampus->nama_kampus }}</option>
        @endforeach</select></div>
<div><label>NIA</label><input name="nia" value="{{ old('nia', $anggota->nia ?? '') }}"
        class="mt-1 w-full rounded-2xl border-slate-300" required></div>
<div><label>Nama Lengkap</label><input name="nama_lengkap"
        value="{{ old('nama_lengkap', $anggota->nama_lengkap ?? '') }}" class="mt-1 w-full rounded-2xl border-slate-300"
        required></div>
<div><label>Tempat Lahir</label><input name="tempat_lahir"
        value="{{ old('tempat_lahir', $anggota->tempat_lahir ?? '') }}" class="mt-1 w-full rounded-2xl border-slate-300"
        required></div>
<div><label>Tanggal Lahir</label><input type="date" name="tanggal_lahir"
        value="{{ old('tanggal_lahir', isset($anggota) ? $anggota->tanggal_lahir->format('Y-m-d') : '') }}"
        class="mt-1 w-full rounded-2xl border-slate-300" required></div>
<div><label>Jenis Kelamin</label><select name="jenis_kelamin" class="mt-1 w-full rounded-2xl border-slate-300">
        <option value="Laki-laki" @selected(old('jenis_kelamin', $anggota->jenis_kelamin ?? '') === 'Laki-laki')>Laki-laki
        </option>
        <option value="Perempuan" @selected(old('jenis_kelamin', $anggota->jenis_kelamin ?? '') === 'Perempuan')>Perempuan
        </option>
    </select></div>
<div><label>Fakultas</label><input name="fakultas" value="{{ old('fakultas', $anggota->fakultas ?? '') }}"
        class="mt-1 w-full rounded-2xl border-slate-300"></div>
<div><label>Prodi</label><input name="prodi" value="{{ old('prodi', $anggota->prodi ?? '') }}"
        class="mt-1 w-full rounded-2xl border-slate-300"></div>
<div><label>Angkatan</label><input name="angkatan" value="{{ old('angkatan', $anggota->angkatan ?? '') }}"
        class="mt-1 w-full rounded-2xl border-slate-300"></div>
<div><label>Sabuk</label><input name="tingkatan_sabuk"
        value="{{ old('tingkatan_sabuk', $anggota->tingkatan_sabuk ?? 'Putih') }}"
        class="mt-1 w-full rounded-2xl border-slate-300"></div>
<div><label>HP</label><input name="nomor_hp" value="{{ old('nomor_hp', $anggota->nomor_hp ?? '') }}"
        class="mt-1 w-full rounded-2xl border-slate-300"></div>
<div><label>Email</label><input name="email" type="email" value="{{ old('email', $anggota->email ?? '') }}"
        class="mt-1 w-full rounded-2xl border-slate-300"></div>
<div class="md:col-span-2"><label>Alamat</label><textarea name="alamat"
        class="mt-1 w-full rounded-2xl border-slate-300">{{ old('alamat', $anggota->alamat ?? '') }}</textarea></div>
<div><label>Foto</label><input type="file" name="foto" class="mt-1 w-full rounded-2xl border-slate-300"></div>
<div><label>Status</label><select name="status_aktif" class="mt-1 w-full rounded-2xl border-slate-300">
        <option value="aktif" @selected(old('status_aktif', $anggota->status_aktif ?? 'aktif') === 'aktif')>Aktif</option>
        <option value="menunggu_verifikasi" @selected(old('status_aktif', $anggota->status_aktif ?? '') === 'menunggu_verifikasi')>Menunggu Verifikasi</option>
        <option value="nonaktif" @selected(old('status_aktif', $anggota->status_aktif ?? '') === 'nonaktif')>Nonaktif
        </option>
    </select></div>