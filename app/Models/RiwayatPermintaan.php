<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPermintaan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_permintaans'; // Pastikan nama tabel sesuai dengan migrasi

    protected $fillable = [
        'pihak_pemohon', 
        'golongan_darah', 
        'jumlah_kantong'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($permintaan) {
            TransaksiDarah::where('golongan_darah', $permintaan->golongan_darah)
                ->orderBy('tanggal', 'asc') // Prioritaskan darah yang lebih lama masuk
                ->limit($permintaan->jumlah_kantong)
                ->delete();
        });
    }
}
