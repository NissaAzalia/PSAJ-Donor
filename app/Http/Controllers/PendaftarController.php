<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftarController extends Controller
{
    /**
    * Simpan data pendaftar.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
       // DB::listen(function ($query) {
       //     dd($query->sql, $query->bindings);
       // });
       // Validasi input
       $validatedData = $request->validate([
           'nama' => 'required|string|max:255',
           'umur' => 'required|integer|min:18',
           'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
           'golongan_darah' => 'required|in:A,B,AB,O',
           'nohp' => 'required|numeric',
           'riwayat_kesehatan' => 'required|string|max:500',
       ]);

      

       // Pastikan user sudah login
       if (!Auth::check()) {
        return redirect()->back()->with('error', 'Anda harus login untuk mendaftar.');
    }

    // Simpan data pendaftar
    $pendaftar = new Pendaftar($validatedData);
    $pendaftar->user_id = Auth::id(); // Simpan ID user yang login
    $pendaftar->save();
       

       // Redirect ke profil setelah submit
       return redirect()->route('profile.profil')->with('success', 'Pendaftaran berhasil!');
   }
}
