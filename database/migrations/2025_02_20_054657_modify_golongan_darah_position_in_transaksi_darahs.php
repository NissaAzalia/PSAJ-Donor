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
        Schema::table('transaksi_darahs', function (Blueprint $table) {
            $table->dropColumn('golongan_darah'); // Hapus dulu kolom yang ada
        });

        Schema::table('transaksi_darahs', function (Blueprint $table) {
            $table->string('golongan_darah')->after('pendaftar_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_darahs', function (Blueprint $table) {
            $table->dropColumn('golongan_darah');
        });
    }
};
