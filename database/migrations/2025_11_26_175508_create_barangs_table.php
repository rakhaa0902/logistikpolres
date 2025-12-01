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
    Schema::create('barangs', function (Blueprint $table) {
        $table->id();
        $table->string('kode_barang')->unique(); // Misal: LOG-001
        $table->string('nama_barang');           // Misal: Laptop Asus
        $table->string('kategori');              // Misal: Elektronik
        $table->integer('jumlah');               // Misal: 10
        $table->string('satuan');                // Misal: Unit/Pcs
        $table->string('kondisi');               // Misal: Baik/Rusak
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
