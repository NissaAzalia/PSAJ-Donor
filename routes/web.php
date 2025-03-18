<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KuisionerController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\ProfileController;
use App\Models\Anggota;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('auth.login');
});
    
Route::middleware('auth')->get('/dashboard', function () {
    $user = Auth::user(); // Ambil user yang sedang login
    $anggota = Anggota::where('user_id', $user->id)->first(); // Ambil data anggota jika ada
    
    return view('dashboard', [
        'profilLengkap' => $user->profil_lengkap, // Kirim ke Blade
        'anggota' => $anggota, 
    ]);
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.profil');
Route::post('/pendaftar/create', [PendaftarController::class, 'create'])->name('pendaftar.create');
Route::get('/daftar-donor', [PendaftarController::class, 'daftarDonor'])->name('daftar.donor');
Route::get('/pendaftar/form', [PendaftarController::class, 'showForm'])->name('pendaftar.form');
Route::post('/pendaftar', [PendaftarController::class, 'store'])->name('pendaftar.store');

Route::post('/simpan-kuisioner', [KuisionerController::class, 'simpanStatusKuisioner'])->name('simpan.kuisioner');

Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');



require __DIR__.'/auth.php';