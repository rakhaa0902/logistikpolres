<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategori; // Import Model
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Tampilkan Halaman Manajemen Kategori
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }

    // Simpan Kategori Baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori',
        ]);

        Kategori::create($request->all());

        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Hapus Kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}