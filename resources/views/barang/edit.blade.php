<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Kode Barang</label>
                            <input type="text" name="kode_barang" value="{{ $barang->kode_barang }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
                            <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Kategori <span class="text-red-500">*</span></label>
                            <select name="kategori" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">-- Pilih Kategori --</option>
                                
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat->nama_kategori }}" {{ $barang->kategori == $kat->nama_kategori ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach

                            </select>
                            @error('kategori')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <div class="mb-4 w-1/2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah</label>
                                <input type="number" name="jumlah" value="{{ $barang->jumlah }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>

                            <div class="mb-4 w-1/2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Satuan</label>
                                <input type="text" name="satuan" value="{{ $barang->satuan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Kondisi <span class="text-red-500">*</span></label>
                            <select name="kondisi" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="Baik" {{ $barang->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak Ringan" {{ $barang->kondisi == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="Rusak Berat" {{ $barang->kondisi == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            </select>
                            @error('kondisi')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Foto Barang</label>
                            
                            @if($barang->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $barang->gambar) }}" class="w-32 h-32 object-cover rounded shadow border">
                                    <p class="text-xs text-gray-500">Foto saat ini</p>
                                </div>
                            @endif

                            <input type="file" name="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto.</p>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button type="submit" class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Data
                            </button>
                            <a href="{{ route('barang.index') }}" class="text-gray-500 hover:text-gray-800">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>