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
        Schema::table('stok_darahs', function (Blueprint $table) {
            $table->string('golongan_darah'); // A, B, AB, O
            $table->integer('stok')->default(0);
            $table->enum('status_ketersediaan', ['Aman', 'Menipis', 'Kritis', 'Kosong'])->default('Kosong');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stok_darahs', function (Blueprint $table) {
            //
        });
    }
};
