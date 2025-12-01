<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $fillable = [
        'barang_id',
        'user_id',
        'jenis_transaksi',
        'jumlah',
        'keterangan',
        'created_at',
    ];

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Relasi ke User (Pencatat)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}