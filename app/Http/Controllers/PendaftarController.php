<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        // dd('masuk ke store');
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:18',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'riwayat_kesehatan' => 'required|string|max:500',
        ]);

        // Simpan data pendaftar
        $pendaftar = new Pendaftar();
        $pendaftar->user_id = Auth::id(); 
        $pendaftar->anggota_id = null; 
        $pendaftar->nama = $validatedData['nama'];
        $pendaftar->umur = $validatedData['umur'];
        $pendaftar->golongan_darah = $validatedData['golongan_darah'];
        $pendaftar->riwayat_kesehatan = $validatedData['riwayat_kesehatan'];
        $pendaftar->save();

        // **Reset status kuisioner di tabel anggota**
        $anggota = Anggota::where('user_id', Auth::id())->first();
        if ($anggota) {
            $anggota->update(['kuisioner_status' => 'ulang']);
        }
        

        // Set session untuk menampilkan tombol "Donor Lagi"
        session(['sudah_donor' => true]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil!');
    }

    

    public function showForm()
    {
        $anggota = DB::table('anggotas')->where('user_id', 22)->first();

        // Jika data tidak ditemukan, jangan pakai dd() langsung, tapi kirimkan pesan ke view
        if (!$anggota) {
            return view('dashboard', ['anggota' => null]); // Kirim null jika tidak ada data
        }

        return view('dashboard', compact('anggota'));
    }

    public function index()
    {
        $user = Auth::user();
        $anggota = Anggota::where('user_id', Auth::id())->first(); // Ambil data anggota berdasarkan user login

        return view('dashboard', [
            'anggota' => $anggota, // Kirim data anggota ke view
        ]);
    }
}
