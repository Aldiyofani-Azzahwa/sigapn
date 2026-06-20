<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/berita-publik/{berita:slug}', [LandingController::class, 'berita'])->name('landing.berita.show');
Route::get('/verify/anggota/{token}', [VerificationController::class, 'anggota'])->name('verify.anggota');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware('permission:kelola kampus')->group(function () {
        Route::resource('kampus', KampusController::class)->parameters(['kampus' => 'kampus']);
    });

    Route::middleware('permission:kelola anggota')->group(function () {
        Route::get('/anggota/export/excel', [AnggotaController::class, 'export'])->name('anggota.export');
        Route::post('/anggota/import/excel', [AnggotaController::class, 'import'])->name('anggota.import');
        Route::get('/anggota/{anggota}/kartu', [AnggotaController::class, 'kartu'])->name('anggota.kartu');
        Route::get('/anggota/{anggota}/kartu/pdf', [AnggotaController::class, 'kartuPdf'])->name('anggota.kartu.pdf');
        Route::resource('anggota', AnggotaController::class)->parameters(['anggota' => 'anggota']);
    });

    Route::resource('pengurus', PengurusController::class)->middleware('permission:kelola pengurus')->parameters(['pengurus' => 'pengurus']);
    Route::resource('kegiatan', KegiatanController::class)->middleware('permission:kelola event')->parameters(['kegiatan' => 'kegiatan']);
    Route::resource('berita', BeritaController::class)->middleware('permission:kelola berita')->parameters(['berita' => 'berita']);
    Route::resource('surat', SuratController::class)->middleware('permission:kelola surat')->parameters(['surat' => 'surat']);

    Route::get('/absensi', [AbsensiController::class, 'index'])->middleware('permission:kelola absensi')->name('absensi.index');
    Route::get('/absensi/{kegiatan}', [AbsensiController::class, 'show'])->middleware('permission:kelola absensi')->name('absensi.show');
    Route::post('/absensi/{kegiatan}/store', [AbsensiController::class, 'store'])->middleware('permission:kelola absensi')->name('absensi.store');

    Route::get('/kartu-saya', [AnggotaController::class, 'kartuSaya'])->name('kartu.saya');
    Route::get('/kartu-saya/pdf', [AnggotaController::class, 'kartuSayaPdf'])->name('kartu.saya.pdf');
    Route::get('/laporan/anggota/pdf', [LaporanController::class, 'anggotaPdf'])->name('laporan.anggota.pdf');

    Route::view('/rayon', 'coming-soon', ['title' => 'Rayon'])->name('rayon.index');
    Route::view('/komisariat', 'coming-soon', ['title' => 'Komisariat'])->name('komisariat.index');
    Route::view('/ukm', 'coming-soon', ['title' => 'UKM'])->name('ukm.index');
    Route::view('/kapus', 'coming-soon', ['title' => 'Kapus'])->name('kapus.index');
});

require __DIR__ . '/auth.php';
