<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-3xl text-gray-800">
                Tambah Data Barang Baru
            </h2>
            <a href="{{ route('barang.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 111.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">

                    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf 

                        <!-- Kode Barang -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-3">Kode Barang <span class="text-red-500">*</span></label>
                            <input type="text" name="kode_barang" value="{{ old('kode_barang') }}" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition duration-200 shadow-sm hover:border-gray-300" placeholder="Contoh: LOG-001" required>
                            @error('kode_barang')
                                <p class="text-red-500 text-sm mt-2 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM8 7a1 1 0 000 2h6a1 1 0 000-2H8zm0 4a1 1 0 000 2h3a1 1 0 000-2H8z" clip-rule="evenodd"></path></svg>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Barang -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-3">Nama Barang <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition duration-200 shadow-sm hover:border-gray-300" placeholder="Contoh: Laptop Asus" required>
                            @error('nama_barang')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-3">Kategori <span class="text-red-500">*</span></label>
                            <select name="kategori" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition duration-200 shadow-sm hover:border-gray-300" required>
                                <option value="">-- Pilih Kategori --</option>
                                
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->nama_kategori }}" {{ old('kategori') == $kategori->nama_kategori ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                                
                            </select>
                            @error('kategori')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jumlah dan Satuan -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-3">Jumlah <span class="text-red-500">*</span></label>
                                <input type="number" name="jumlah" value="{{ old('jumlah') }}" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition duration-200 shadow-sm hover:border-gray-300" min="0" required>
                                @error('jumlah')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-3">Satuan <span class="text-red-500">*</span></label>
                                <input type="text" name="satuan" value="{{ old('satuan') }}" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition duration-200 shadow-sm hover:border-gray-300" placeholder="Pcs/Unit/Rim" required>
                                @error('satuan')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Kondisi -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-3">Kondisi <span class="text-red-500">*</span></label>
                            <select name="kondisi" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition duration-200 shadow-sm hover:border-gray-300" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            </select>
                            @error('kondisi')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto Barang -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-3">Foto Barang</label>
                            <div class="relative">
                                <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition duration-200 shadow-sm hover:border-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
                            </div>
                            <p class="text-gray-500 text-xs mt-2">Format: JPG, PNG, GIF. Ukuran maksimal: 2MB.</p>
                            @error('gambar')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <a href="{{ route('barang.index') }}" class="px-6 py-3 rounded-lg text-gray-700 font-semibold border-2 border-gray-300 hover:bg-gray-50 transition duration-200">
                                Batal
                            </a>
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition duration-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path></svg>
                                Simpan Data
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>