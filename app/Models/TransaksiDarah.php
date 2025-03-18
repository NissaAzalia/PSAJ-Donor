<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransaksiDarah extends Model
{
    use HasFactory;

    protected $table = 'transaksi_darahs'; // Sesuaikan dengan nama tabel

    protected $fillable = ['pendaftar_id', 'tanggal'];

    // public function pendaftar()
    // {
    //     return $this->belongsTo(Pendaftar::class, 'pendaftar_id', 'id');
    // }
    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class, 'pendaftar_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaksi) {
            $transaksi->golongan_darah = $transaksi->pendaftar->golongan_darah ?? null;
        });
    }

//     public static function stokDarah()
// {
//     return self::select('pendaftar.golongan_darah', DB::raw('COUNT(transaksi_darahs.id) as stok'))
//         ->join('pendaftar', 'transaksi_darahs.pendaftar_id', '=', 'pendaftar.id')
//         ->groupBy('pendaftar.golongan_darah');
// }

}
