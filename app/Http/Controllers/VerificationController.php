<?php
namespace App\Http\Controllers;

use App\Models\Anggota;

class VerificationController extends Controller
{
    public function anggota(string $token)
    {
        $anggota = Anggota::with('kampus')->where('verification_token', $token)->firstOrFail();
        return view('verify.anggota', compact('anggota'));
    }
}
