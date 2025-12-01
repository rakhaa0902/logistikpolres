<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Logistik Polres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                        <a href="{{ route('barang.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-150 ease-in-out">
                            + Tambah Barang 
                            <a href="{{ route('barang.cetak_pdf') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                                Cetak PDF
                            </a>
                        </a>

                        <form action="{{ route('barang.index') }}" method="GET" class="flex w-full sm:w-auto">
                            <input type="text" name="search" placeholder="Cari nama/kode..." value="{{ request('search') }}" 
                                class="border-gray-300 rounded-l-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-full sm:w-64">
                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-r-md hover:bg-gray-700 transition">
                                Cari
                            </button>
                        </form>
                    </div>

                   <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th> <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kondisi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($barangs as $barang)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($barang->gambar)
                                            <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Foto" class="w-16 h-16 object-cover rounded shadow">
                                        @else
                                            <span class="text-xs text-gray-400">No Image</span>
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $barang->kode_barang }}</td>
                                   <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-700">
    <a href="{{ route('barang.show', $barang->id) }}" class="hover:text-blue-600 hover:underline">
        {{ $barang->nama_barang }}
    </a>
</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $barang->kategori }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $barang->jumlah }} {{ $barang->satuan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        @if($barang->kondisi == 'Baik')
                                            <span class="text-green-600 font-bold">Baik</span>
                                        @else
                                            <span class="text-red-600 font-bold">{{ $barang->kondisi }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-3 items-center mt-4">
                                        <a href="{{ route('barang.edit', $barang->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Edit</a>
                                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $barang->nama_barang }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                        Data tidak ditemukan. Silakan tambah data baru.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $barangs->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>