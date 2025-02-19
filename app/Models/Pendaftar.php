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
        'nama',
        'umur',
        'jenis_kelamin',
        'golongan_darah',
        'nohp',
        'riwayat_kesehatan',
    ];
}
