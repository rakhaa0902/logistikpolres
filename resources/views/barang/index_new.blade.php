<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-3xl text-gray-800">
                Daftar Data Barang Logistik
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('barang.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    Tambah Barang
                </a>
                <a href="{{ route('barang.cetak_pdf') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000-2A4 4 0 000 5v10a4 4 0 004 4h12a4 4 0 004-4V5a4 4 0 00-4-4 1 1 0 000 2 2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z" clip-rule="evenodd"></path></svg>
                    Cetak PDF
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Search Bar -->
            <div class="mb-8">
                <form action="{{ route('barang.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" placeholder="Cari nama atau kode barang..." value="{{ request('search') }}" 
                            class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none shadow-sm hover:border-gray-300 transition">
                    </div>
                    <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg transition duration-200 flex items-center justify-center whitespace-nowrap">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        Cari
                    </button>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Kode</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Nama Barang</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Stok</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Kondisi</th>
                                <th class="px-6 py-4 text-right text-sm font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($barangs as $barang)
                            <tr class="hover:bg-blue-50 transition duration-150 border-b border-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($barang->gambar)
                                        <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Foto" class="w-12 h-12 object-cover rounded-lg shadow-md hover:shadow-lg transition">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                        {{ $barang->kode_barang }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('barang.show', $barang->id) }}" class="text-gray-900 font-bold hover:text-blue-600 transition flex items-center">
                                        {{ $barang->nama_barang }}
                                        <svg class="w-4 h-4 ml-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                                        {{ $barang->kategori }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-900 font-bold">{{ $barang->jumlah }}</span>
                                    <span class="text-gray-500 text-sm">{{ $barang->satuan }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($barang->kondisi == 'Baik')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                            ✓ Baik
                                        </span>
                                    @elseif($barang->kondisi == 'Rusak Ringan')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                            ⚠ Rusak Ringan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                            ✕ Rusak Berat
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('barang.edit', $barang->id) }}" class="text-blue-600 hover:text-blue-900 font-bold p-2 hover:bg-blue-100 rounded-lg transition">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                        </a>
                                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold p-2 hover:bg-red-100 rounded-lg transition">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"></path></svg>
                                        <p class="text-gray-500 text-lg font-semibold">Belum ada data barang</p>
                                        <p class="text-gray-400 text-sm mt-2">Mulai dengan menambahkan barang baru ke sistem</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($barangs->count() > 0)
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $barangs->links() }}
                </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
