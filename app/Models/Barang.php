<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // Tambahkan bagian ini
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'jumlah',
        'satuan',
        'kondisi',
        'gambar',
    ];
    // Relasi: Satu barang punya banyak riwayat
    public function riwayats()
    {
        return $this->hasMany(Riwayat::class);
    }
}