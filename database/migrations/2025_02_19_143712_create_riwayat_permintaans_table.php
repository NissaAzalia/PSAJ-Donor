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
        Schema::create('riwayat_permintaans', function (Blueprint $table) {
            $table->id();
            $table->string('pihak_pemohon');
            $table->string('golongan_darah');
            $table->integer('jumlah_kantong');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_permintaans');
    }
};
