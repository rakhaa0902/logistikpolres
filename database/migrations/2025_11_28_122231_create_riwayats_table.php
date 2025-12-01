<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel barangs (Relasi)
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            
            // Menghubungkan ke tabel users (Siapa yang input)
            $table->foreignId('user_id')->constrained('users');
            
            $table->enum('jenis_transaksi', ['masuk', 'keluar']); // Pilihan: Masuk / Keluar
            $table->integer('jumlah');
            $table->text('keterangan')->nullable(); // Misal: "Pengadaan 2024" atau "Dipakai Polsek A"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};