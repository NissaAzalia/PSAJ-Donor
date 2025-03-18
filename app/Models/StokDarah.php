<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokDarah extends Model
{
    use HasFactory;

    protected $table = 'stok_darahs'; // Sesuaikan dengan tabel database
    protected $primaryKey = 'id'; // Primary Key
    public $incrementing = true; // Auto-increment aktif
    protected $keyType = 'int'; // Pastikan integer
    public $timestamps = true; // created_at & updated_at ada

    protected $fillable = ['golongan_darah', 'stok', 'status_ketersediaan'];



    
}
