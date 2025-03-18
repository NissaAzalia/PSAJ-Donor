<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Anggota;
use Illuminate\Support\Facades\Log;

class KuisionerController extends Controller
{
    public function simpanStatusKuisioner(Request $request)
    {
        // Validasi hanya status (tidak perlu validasi semua jawaban)
        $request->validate([
            'kuisioner_status' => 'required|in:lolos,tidak_lolos'
        ]);

        // Simpan ke session
        session()->put('kuisioner_status', $request->kuisioner_status);

        // Simpan ke database jika user login
        if (Auth::check()) {
            $userId = Auth::id(); // Ambil ID user yang sedang login
            $anggota = Anggota::where('user_id', $userId)->first(); // Cari berdasarkan user_id

            if ($anggota) {
                $anggota->kuisioner_status = $request->kuisioner_status;
                $anggota->save(); // Simpan perubahan

                Log::info("Kuisioner status berhasil diperbarui untuk user ID: " . $userId);
            } else {
                Log::warning("User dengan ID: " . $userId . " tidak ditemukan di tabel Anggota.");
            }
        } else {
            Log::error("User tidak login saat mencoba menyimpan kuisioner status.");
        }

        return redirect()->back()->with('success', 'Status kuisioner berhasil disimpan.');
    }
}
