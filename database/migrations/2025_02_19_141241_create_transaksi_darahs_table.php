<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_darahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftar_id')
                  ->constrained('pendaftar') 
                  ->onDelete('cascade'); // Relasi ke tabel pendaftar
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_darahs');
    }
};
