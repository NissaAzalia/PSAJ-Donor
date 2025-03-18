<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class AnggotaController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:17',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'nohp' => 'required|numeric',
        ]);

          // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Anda harus login untuk mendaftar.');
        }

        // Simpan data ke tabel `anggotas` dan tambahkan user_id
        $validatedData['user_id'] = Auth::id();
        Anggota::create($validatedData);

          // Update profil_lengkap ke true
          User::where('id', Auth::id())->update(['profil_lengkap' => true]);


        // Simpan status ke session
        Session::put('daftarAnggotaStatus', true);

        // Redirect ke profil setelah submit
        return redirect()->route('profile.profil')->with('success', 'Pendaftaran berhasil!');
    }

    public function index()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        $anggota = Anggota::where('user_id', Auth::id())->first();
    
        // Kirimkan status apakah anggota sudah mengisi data atau belum
        return view('dashboard', [
            'profilLengkap' => $user ? $user->profil_lengkap : false,
            'daftarAnggotaStatus' => $anggota ? 'sudah' : 'belum',
            'kuisionerStatus' => $anggota ? $anggota->kuisioner_status : null,
            'anggota' => $anggota, 
        ]);
    }

    public function simpanKuisioner(Request $request)
    {
        $validatedData = $request->validate([
            'kuisioner_status' => 'required|in:lolos,tidak_lolos',
        ]);

        $anggota = Anggota::where('user_id', Auth::id())->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
        }

        // Simpan status kuisioner pertama kali
        $anggota->kuisioner_status = $validatedData['kuisioner_status'];

        // Reset `kuisioner_ulang` saat mengisi kuisioner pertama kali
        $anggota->kuisioner_ulang = null;
        
        $anggota->save();

        return redirect()->route('dashboard')->with('success', 'Kuisioner berhasil disimpan!');
    }
}
