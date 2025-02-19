<?php

use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/pendaftar', [PendaftarController::class, 'store'])->name('pendaftar.store');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.profil');
Route::get('/pendaftar/create', [PendaftarController::class, 'create'])->name('pendaftar.create');



require __DIR__.'/auth.php';
