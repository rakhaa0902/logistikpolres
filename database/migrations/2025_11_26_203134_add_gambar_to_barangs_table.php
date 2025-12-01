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
    Schema::table('barangs', function (Blueprint $table) {
        // Menambah kolom gambar (boleh kosong/nullable) setelah kolom kondisi
        $table->string('gambar')->nullable()->after('kondisi');
    });
}

public function down(): void
{
    Schema::table('barangs', function (Blueprint $table) {
        $table->dropColumn('gambar');
    });
}
};
