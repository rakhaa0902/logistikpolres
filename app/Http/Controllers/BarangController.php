<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Barang; // Pastikan Model Barang di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Kategori;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar semua barang (READ)
     */
   public function index(Request $request)
    {
        // Mulai query
        $query = Barang::query();

        // Jika ada input pencarian dari user
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_barang', 'LIKE', '%' . $search . '%')
                  ->orWhere('kode_barang', 'LIKE', '%' . $search . '%');
        }

        // Ambil data (10 per halaman), bukan all() lagi
        $barangs = $query->paginate(10);

        return view('barang.index', compact('barangs'));
    }

    /**
     * Menampilkan formulir tambah barang (CREATE - Form)
     */
    public function create()
{
    $kategoris = Kategori::all(); // Ambil semua kategori dari DB
    return view('barang.create', compact('kategoris'));
}

    /**
     * Menyimpan data barang baru ke database (CREATE - Action)
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barangs',
            'nama_barang' => 'required|string|max:255',
            'kategori'    => 'required|string',
            'jumlah'      => 'required|numeric|min:0',
            'satuan'      => 'required|string|max:100',
            'kondisi'     => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Siapkan data yang mau disimpan
        $data = $request->all();

        // Cek apakah ada file gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Upload ke folder 'public/barangs'
            $path = $request->file('gambar')->store('barangs', 'public');
            $data['gambar'] = $path;
        }

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir edit barang (UPDATE - Form)
     */
    public function edit($id)
{
    $barang = Barang::findOrFail($id);
    $kategoris = Kategori::all(); // Ambil semua kategori juga
    return view('barang.edit', compact('barang', 'kategoris'));
}

    /**
     * Memperbarui data barang di database (UPDATE - Action)
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        
        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $id,
            'nama_barang' => 'required|string|max:255',
            'kategori'    => 'required|string',
            'jumlah'      => 'required|numeric|min:0',
            'satuan'      => 'required|string|max:100',
            'kondisi'     => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Jika user upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar) {
                Storage::delete('public/' . $barang->gambar);
            }
            
            // Simpan gambar baru
            $path = $request->file('gambar')->store('barangs', 'public');
            $data['gambar'] = $path;
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Menghapus data barang (DELETE)
     * (Saya tambahkan ini sekalian agar lengkap)
     */
   public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus gambar dari penyimpanan jika ada
        if ($barang->gambar) {
            Storage::delete('public/' . $barang->gambar);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Data berhasil dihapus!');
    }
    public function cetakPdf()
{
    // Ambil semua data barang
    $barangs = Barang::all();

    // Load view khusus PDF dan kirim datanya
    $pdf = Pdf::loadView('barang.barang_pdf', compact('barangs'));

    // Download file PDF dengan nama 'laporan-logistik.pdf'
    return $pdf->download('laporan-logistik.pdf');
}
// Menampilkan Detail Barang
    public function show($id)
    {
        // Cari barang berdasarkan ID
        $barang = Barang::findOrFail($id);
        
        // Tampilkan halaman detail
        return view('barang.show', compact('barang'));
    }
}