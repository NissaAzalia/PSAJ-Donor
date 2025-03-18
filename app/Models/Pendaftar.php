<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'pendaftar';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
       'anggota_id', 
        'user_id', 
        'nama', 
        'umur', 
        'golongan_darah', 
        'riwayat_kesehatan'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
    

    public function transaksiDarah()
    {
        return $this->hasMany(TransaksiDarah::class)->orderBy('tanggal', 'desc');
    }


}
