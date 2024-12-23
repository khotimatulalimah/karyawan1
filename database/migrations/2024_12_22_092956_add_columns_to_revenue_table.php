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
        Schema::table('revenue', function (Blueprint $table) {
            $table->date('tanggal_awal');   // Menambahkan kolom tanggal_awal
            $table->date('tanggal_akhir');  // Menambahkan kolom tanggal_akhir
            $table->decimal('pendapatan', 15, 2); // Menambahkan kolom pendapatan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('revenue', function (Blueprint $table) {
            $table->dropColumn(['tanggal_awal', 'tanggal_akhir', 'pendapatan']);
        });
    }
};
