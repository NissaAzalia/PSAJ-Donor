<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas';

    protected $fillable = [
        'user_id',
        'nama',
        'umur',
        'jenis_kelamin',
        'golongan_darah',
        'nohp',
        'kuisioner_status',

        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
