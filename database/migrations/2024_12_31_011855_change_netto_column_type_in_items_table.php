<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('items', function (Blueprint $table) {
        $table->string('netto')->change(); // Ubah netto menjadi string
    });
}

public function down()
{
    Schema::table('items', function (Blueprint $table) {
        $table->decimal('netto', 8, 2)->change(); // Kembalikan ke tipe decimal jika diperlukan
    });
}

};
