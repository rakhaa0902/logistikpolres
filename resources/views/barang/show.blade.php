<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex flex-col md:flex-row gap-8">
                        
                        <div class="w-full md:w-1/3">
                            @if($barang->gambar)
                                <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Foto Barang" class="w-full h-auto rounded-lg shadow-md border">
                            @else
                                <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg text-gray-500">
                                    Tidak ada foto
                                </div>
                            @endif
                        </div>

                        <div class="w-full md:w-2/3">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $barang->nama_barang }}</h3>

                            <div class="grid grid-cols-1 gap-4">
                                <div class="border-b pb-2">
                                    <span class="text-gray-500 text-sm">Kode Barang</span>
                                    <div class="font-semibold text-lg">{{ $barang->kode_barang }}</div>
                                </div>
                                
                                <div class="border-b pb-2">
                                    <span class="text-gray-500 text-sm">Kategori</span>
                                    <div class="font-semibold text-lg">
                                        <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">
                                            {{ $barang->kategori }}
                                        </span>
                                    </div>
                                </div>

                                <div class="border-b pb-2">
                                    <span class="text-gray-500 text-sm">Jumlah Stok</span>
                                    <div class="font-semibold text-lg">{{ $barang->jumlah }} {{ $barang->satuan }}</div>
                                </div>

                                <div class="border-b pb-2">
                                    <span class="text-gray-500 text-sm">Kondisi</span>
                                    <div class="font-semibold text-lg">
                                        @if($barang->kondisi == 'Baik')
                                            <span class="text-green-600">✔ Baik</span>
                                        @else
                                            <span class="text-red-600">⚠ {{ $barang->kondisi }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="border-b pb-2">
                                    <span class="text-gray-500 text-sm">Terakhir Diupdate</span>
                                    <div class="text-gray-700">{{ $barang->updated_at->format('d M Y, H:i') }} WIB</div>
                                </div>
                            </div>

                            <div class="mt-8 flex gap-3">
                                <a href="{{ route('barang.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                                    &larr; Kembali
                                </a>
                                <a href="{{ route('barang.edit', $barang->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                    Edit Barang
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>