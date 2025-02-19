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
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->id(); // Kolom id
            $table->string('nama'); // Kolom nama
            $table->integer('umur'); // Kolom umur
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Kolom jenis kelamin
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O']); // Kolom golongan darah
            $table->string('nohp'); // Kolom nomor HP
            $table->text('riwayat_kesehatan'); // Kolom riwayat kesehatan
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftar');
    }
};
