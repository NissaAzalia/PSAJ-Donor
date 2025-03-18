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
            $table->string('golongan_darah', 3)->nullable()->after('pendaftar_id');
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
