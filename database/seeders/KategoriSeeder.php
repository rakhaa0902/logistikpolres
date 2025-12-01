<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori; // Jangan lupa import ini

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        // Masukkan data awal
        Kategori::create(['nama_kategori' => 'Elektronik']);
        Kategori::create(['nama_kategori' => 'Kendaraan']);
        Kategori::create(['nama_kategori' => 'ATK']);
        Kategori::create(['nama_kategori' => 'Perlengkapan']);
        Kategori::create(['nama_kategori' => 'Senjata & Amunisi']); // Tambahan baru
    }
}
