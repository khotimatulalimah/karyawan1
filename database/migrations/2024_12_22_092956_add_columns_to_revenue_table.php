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
            // Tambahkan kolom hanya jika belum ada
            if (!Schema::hasColumn('revenue', 'tanggal_awal')) {
                $table->date('tanggal_awal'); // Menambahkan kolom tanggal_awal
            }

            if (!Schema::hasColumn('revenue', 'tanggal_akhir')) {
                $table->date('tanggal_akhir'); // Menambahkan kolom tanggal_akhir
            }

            if (!Schema::hasColumn('revenue', 'pendapatan')) {
                $table->decimal('pendapatan', 15, 2); // Menambahkan kolom pendapatan
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('revenue', function (Blueprint $table) {
            // Hapus kolom jika ada
            if (Schema::hasColumn('revenue', 'tanggal_awal')) {
                $table->dropColumn('tanggal_awal');
            }

            if (Schema::hasColumn('revenue', 'tanggal_akhir')) {
                $table->dropColumn('tanggal_akhir');
            }

            if (Schema::hasColumn('revenue', 'pendapatan')) {
                $table->dropColumn('pendapatan');
            }
        });
    }
};
