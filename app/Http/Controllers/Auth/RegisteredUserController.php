<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Kampus;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register', [
            'kampuses' => Kampus::where('status', 'aktif')
                ->orderBy('nama_kampus')
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],

            'kampus_id' => ['required', 'exists:kampus,id'],
            'nia' => ['required', 'string', 'max:100', 'unique:anggotas,nia'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'fakultas' => ['nullable', 'string', 'max:255'],
            'prodi' => ['nullable', 'string', 'max:255'],
            'angkatan' => ['nullable', 'digits:4'],
            'tingkatan_sabuk' => ['required', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:30'],
            'alamat' => ['nullable', 'string'],
        ]);

        $user = DB::transaction(function () use ($data) {
            $user = User::create([
                'kampus_id' => $data['kampus_id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'] ?? null,
                'status' => 'aktif',
            ]);

            $user->assignRole('Anggota');

            Anggota::create([
                'user_id' => $user->id,
                'kampus_id' => $data['kampus_id'],
                'nia' => $data['nia'],
                'nama_lengkap' => $data['name'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'fakultas' => $data['fakultas'] ?? null,
                'prodi' => $data['prodi'] ?? null,
                'angkatan' => $data['angkatan'] ?? null,
                'tingkatan_sabuk' => $data['tingkatan_sabuk'],
                'nomor_hp' => $data['phone'] ?? null,
                'email' => $data['email'],
                'alamat' => $data['alamat'] ?? null,
                'status_aktif' => 'menunggu_verifikasi',
                'verification_token' => (string) Str::uuid(),
                'verified_at' => null,
            ]);

            return $user;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect()
            ->route('kartu.saya')
            ->with('success', 'Pendaftaran berhasil. Data anggota Anda menunggu verifikasi pengurus.');
    }
}