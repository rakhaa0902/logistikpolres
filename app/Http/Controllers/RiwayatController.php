<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Riwayat;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // <--- PENTING: Import Library PDF

class RiwayatController extends Controller
{
    /**
     * Menampilkan Riwayat (Bisa Filter Tanggal)
     */
    public function index(Request $request)
    {
        // Siapkan query (ambil data riwayat + relasi barang & user)
        $query = Riwayat::with(['barang', 'user']);

        // LOGIKA FILTER: Jika user mengisi tanggal mulai & akhir
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
        }

        // Ambil data (paginate 10 per halaman)
        $riwayats = $query->latest()->paginate(10);
        
        // Kirim data ke view
        return view('riwayat.index', compact('riwayats'));
    }

    /**
     * Tampilkan Form Tambah
     */
    public function create()
    {
        $barangs = Barang::all();
        return view('riwayat.create', compact('barangs'));
    }

    /**
     * Proses Simpan Transaksi (Dengan Validasi Stok)
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id'       => 'required|exists:barangs,id',
            'jenis_transaksi' => 'required|in:masuk,keluar',
            'jumlah'          => 'required|integer|min:1',
            'keterangan'      => 'nullable|string',
        ]);

        // 1. Cek Stok Dulu (Khusus Barang Keluar)
        $barang = Barang::findOrFail($request->barang_id);

        if ($request->jenis_transaksi == 'keluar') {
            if ($barang->jumlah < $request->jumlah) {
                // KALO STOK KURANG: Balik ke form dan kasih pesan Error
                return back()->with('error', 'Stok tidak cukup! Sisa stok hanya: ' . $barang->jumlah);
            }
        }

        // 2. Kalau Stok Aman, Baru Jalankan Transaksi
        DB::transaction(function () use ($request, $barang) {
            
            // Simpan Riwayat
            Riwayat::create([
                'barang_id'       => $request->barang_id,
                'user_id'         => Auth::id(),
                'jenis_transaksi' => $request->jenis_transaksi,
                'jumlah'          => $request->jumlah,
                'keterangan'      => $request->keterangan,
            ]);

            // Update Stok Barang
            if ($request->jenis_transaksi == 'masuk') {
                $barang->increment('jumlah', $request->jumlah);
            } else {
                $barang->decrement('jumlah', $request->jumlah);
            }
        });

        return redirect()->route('riwayat.index')->with('success', 'Transaksi berhasil dicatat & stok diperbarui!');
    }

    /**
     * Cetak Laporan PDF (Sesuai Filter Tanggal)
     */
    public function cetakPdf(Request $request)
    {
        // Query data sama persis seperti index
        $query = Riwayat::with(['barang', 'user']);

        // Filter tanggal untuk PDF juga
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
        }

        // Ambil SEMUA data (get), jangan dipaginate kalau mau diprint
        $riwayats = $query->latest()->get(); 
        
        // Load view khusus PDF dan kirim datanya
        // Kita juga kirim '$request' supaya tanggal periodenya bisa ditulis di judul PDF
        $pdf = Pdf::loadView('riwayat.riwayat_pdf', compact('riwayats', 'request'));
        
        return $pdf->download('laporan-transaksi.pdf');
    }
}