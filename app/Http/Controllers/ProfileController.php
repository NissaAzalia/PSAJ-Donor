<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Anggota;
use App\Models\Pendaftar;
use App\Models\TransaksiDarah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function show()
    {
        $user = Auth::user();
        $anggota = Anggota::where('user_id', $user->id)->first();    
        $pendaftar = Pendaftar::where('user_id', $user->id)->latest()->first();


        if ($pendaftar) {
            $transaksiDarahCount = TransaksiDarah::whereHas('pendaftar', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();
            $donorTerakhir = TransaksiDarah::whereHas('pendaftar', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest('tanggal') // Ambil transaksi terbaru
            ->first();
            
            $donorKembali = $donorTerakhir ? \Carbon\Carbon::parse($donorTerakhir->tanggal)->addMonths(3) : null;
            
            $riwayatDonor = TransaksiDarah::whereHas('pendaftar', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->orderBy('tanggal', 'desc')->get();
            
            } else {
                // Jika belum mendaftar, set semua data ke default
                $transaksiDarahCount = 0;
                $donorTerakhir = null;
                $donorKembali = null;
                $riwayatDonor = collect();
        }

        return view('profile.profil', compact('anggota', 'pendaftar','transaksiDarahCount','donorTerakhir', 'donorKembali', 'riwayatDonor'));
    }
     
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
