<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Transaksi') }}
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
                    
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <h3 class="text-lg font-bold">Log Keluar Masuk Barang</h3>

                        <form action="{{ route('riwayat.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2 items-center">
                            <label class="text-sm text-gray-600">Dari:</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="border rounded px-2 py-1 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            
                            <label class="text-sm text-gray-600">Sampai:</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="border rounded px-2 py-1 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            
                            <button type="submit" class="bg-gray-800 text-white px-4 py-1.5 rounded text-sm hover:bg-gray-700 transition">
                                Filter
                            </button>
                            
                            @if(request('start_date'))
                                <a href="{{ route('riwayat.index') }}" class="bg-gray-200 text-gray-700 px-3 py-1.5 rounded text-sm hover:bg-gray-300 transition">
                                    Reset
                                </a>
                            @endif
                        </form>
                    </div>

                    <div class="flex flex-wrap gap-2 mb-4">
                        <a href="{{ route('riwayat.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition">
                            + Catat Transaksi
                        </a>

                        <a href="{{ route('riwayat.cetak_pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" target="_blank" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow transition">
                            Cetak Laporan PDF
                        </a>
                    </div>

                    <div class="overflow-x-auto border rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petugas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($riwayats as $riwayat)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $riwayat->created_at->translatedFormat('l, d F Y') }}
                                            </span>
                                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full inline-block w-fit">
                                                {{ $riwayat->created_at->format('H:i') }} WIB
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">
                                        {{ $riwayat->user->name ?? 'User Terhapus' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <div class="font-medium">{{ $riwayat->barang->nama_barang ?? 'Barang Terhapus' }}</div>
                                        <div class="text-xs text-gray-400">{{ $riwayat->barang->kode_barang ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($riwayat->jenis_transaksi == 'masuk')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Masuk (Stok +)
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Keluar (Stok -)
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                        {{ $riwayat->jumlah }} {{ $riwayat->barang->satuan ?? '' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 italic">
                                        {{ $riwayat->keterangan ?? '-' }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Data tidak ditemukan untuk periode ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $riwayats->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>