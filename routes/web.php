<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Models\Barang;
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    // 1. Hitung Total Barang
    $totalBarang = Barang::count();

    // 2. Hitung Barang Baik
    $barangBaik = Barang::where('kondisi', 'Baik')->count();

    // 3. Hitung Barang Rusak (Rusak Ringan + Rusak Berat)
    $barangRusak = Barang::where('kondisi', '!=', 'Baik')->count();

    // Kirim data ke tampilan dashboard
    return view('dashboard', compact('totalBarang', 'barangBaik', 'barangRusak'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  
    Route::middleware(['auth'])->group(function () {
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create'); // Halaman Form
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store'); 
    Route::get('/barang/cetak_pdf', [BarangController::class, 'cetakPdf'])->name('barang.cetak_pdf');        // Proses Simpan 
    Route::get('/barang/cetak_pdf', [BarangController::class, 'cetakPdf'])->name('barang.cetak_pdf');
    Route::get('/barang/{id}', [BarangController::class, 'show'])->name('barang.show');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    // ... Rute Barang di atas sini ...
        Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [App\Http\Controllers\KategoriController::class, 'store'])->name('kategori.store');
    Route::delete('/kategori/{id}', [App\Http\Controllers\KategoriController::class, 'destroy'])->name('kategori.destroy');
    // RUTE RIWAYAT TRANSAKSI (BARU)
    Route::get('/riwayat/cetak_pdf', [App\Http\Controllers\RiwayatController::class, 'cetakPdf'])->name('riwayat.cetak_pdf'); 
    Route::get('/riwayat', [App\Http\Controllers\RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/create', [App\Http\Controllers\RiwayatController::class, 'create'])->name('riwayat.create');
    Route::post('/riwayat', [App\Http\Controllers\RiwayatController::class, 'store'])->name('riwayat.store');
});

// RUTE KHUSUS ADMIN (Diberi middleware 'admin')
    Route::middleware(['admin'])->group(function () {
        
        // 1. Manajemen Kategori (Hanya Admin)
        Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('kategori.index');
        Route::post('/kategori', [App\Http\Controllers\KategoriController::class, 'store'])->name('kategori.store');
        Route::delete('/kategori/{id}', [App\Http\Controllers\KategoriController::class, 'destroy'])->name('kategori.destroy');

        // Jika Anda ingin fitur DELETE BARANG juga khusus admin, pindahkan rute destroy barang ke sini:
        // Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    });


});

require __DIR__.'/auth.php';
