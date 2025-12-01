<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catat Transaksi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Gagal!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                    @endif

                    <form action="{{ route('riwayat.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Transaksi</label>
                            <input type="datetime-local" name="tanggal" value="{{ now()->format('Y-m-d\TH:i') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <p class="text-xs text-gray-500 mt-1">Anda bisa mengubah tanggal jika ini adalah transaksi lampau.</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Barang</label>
                            <select name="barang_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->id }}">
                                        {{ $barang->kode_barang }} - {{ $barang->nama_barang }} (Stok Saat Ini: {{ $barang->jumlah }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex gap-4">
                            <div class="mb-4 w-1/2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Jenis Transaksi</label>
                                <select name="jenis_transaksi" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="masuk">Barang Masuk (Tambah Stok)</option>
                                    <option value="keluar">Barang Keluar (Kurang Stok)</option>
                                </select>
                            </div>

                            <div class="mb-4 w-1/2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah</label>
                                <input type="number" name="jumlah" min="1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: 10" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Keterangan / Perihal</label>
                            <textarea name="keterangan" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: Pengadaan APBN 2024 atau Dipinjam Polsek A"></textarea>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Simpan Transaksi
                            </button>
                            <a href="{{ route('riwayat.index') }}" class="text-gray-500 hover:text-gray-800">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>