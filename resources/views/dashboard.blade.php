<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}</h3>
                            <p class="text-gray-600 mt-1">Selamat datang di Sistem Manajemen Logistik</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <span class="text-sm text-gray-500">{{ now()->format('l, d F Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Utama -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" x-data="{ 
                totalBarang: {{ $totalBarang }},
                barangBaik: {{ $barangBaik }},
                barangRusak: {{ $barangRusak }},
                animatedTotal: 0,
                animatedBaik: 0,
                animatedRusak: 0
            }" 
            x-init="
                function animateValue(obj, start, end, duration) {
                    let startTimestamp = null;
                    const step = (timestamp) => {
                        if (!startTimestamp) startTimestamp = timestamp;
                        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                        obj = Math.floor(progress * (end - start) + start);
                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        }
                    };
                    window.requestAnimationFrame(step);
                }
                
                setTimeout(() => {
                    animateValue(animatedTotal, 0, {{ $totalBarang }}, 2000);
                    animateValue(animatedBaik, 0, {{ $barangBaik }}, 2000);
                    animateValue(animatedRusak, 0, {{ $barangRusak }}, 2000);
                }, 500);
            ">
                <!-- Total Aset -->
                <div class="group">
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm transition-all duration-300 transform hover:-translate-y-1 border-l-4 border-blue-500">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Aset</p>
                                    <p class="text-3xl font-bold text-gray-800 mt-1" x-text="animatedTotal">0</p>
                                    <p class="text-xs text-gray-500 mt-1">Unit Barang Terdaftar</p>
                                </div>
                                <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dalam Keadaan Baik -->
                <div class="group">
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm transition-all duration-300 transform hover:-translate-y-1 border-l-4 border-green-500">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Dalam Keadaan Baik</p>
                                    <p class="text-3xl font-bold text-gray-800 mt-1" x-text="animatedBaik">0</p>
                                    <p class="text-xs text-gray-500 mt-1">Unit Siap Digunakan</p>
                                </div>
                                <div class="p-3 rounded-lg bg-green-50 text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Perlu Perbaikan -->
                <div class="group">
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm transition-all duration-300 transform hover:-translate-y-1 border-l-4 border-red-500">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Perlu Perbaikan</p>
                                    <p class="text-3xl font-bold text-gray-800 mt-1" x-text="animatedRusak">0</p>
                                    <p class="text-xs text-gray-500 mt-1">Unit Perlu Perbaikan</p>
                                </div>
                                <div class="p-3 rounded-lg bg-red-50 text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                </div>        


                <!-- Barang Baik Card -->
                <div class="group">
                    <div class="bg-white overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border-l-4 border-green-500 hover:border-green-600">
                        <div class="p-8">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide">Kondisi Baik</p>
                                    <p class="text-4xl md:text-5xl font-bold text-green-600 mt-2" x-text="animatedBaik"></p>
                                    <p class="text-gray-400 text-xs mt-2">Siap Digunakan</p>
                                </div>
                                <div class="bg-green-100 p-4 rounded-full">
                                    <svg class="w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: {{ $totalBarang > 0 ? ($barangBaik / $totalBarang * 100) : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Barang Rusak Card -->
                <div class="group">
                    <div class="bg-white overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border-l-4 border-red-500 hover:border-red-600">
                        <div class="p-8">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide">Perlu Perbaikan</p>
                                    <p class="text-4xl md:text-5xl font-bold text-red-600 mt-2" x-text="animatedRusak"></p>
                                    <p class="text-gray-400 text-xs mt-2">Rusak Ringan/Berat</p>
                                </div>
                                <div class="bg-red-100 p-4 rounded-full">
                                    <svg class="w-12 h-12 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width: {{ $totalBarang > 0 ? ($barangRusak / $totalBarang * 100) : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Animated Quick Actions & Info -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Quick Actions -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zm-6 4a1 1 0 00-1 1v2a1 1 0 001 1h.01a1 1 0 001-1v-2a1 1 0 00-1-1h-.01zM16 15a4 4 0 00-8 0v1h8v-1zm-6 4a1 1 0 00-1 1v2a1 1 0 001 1h.01a1 1 0 001-1v-2a1 1 0 00-1-1h-.01z"></path>
                            </svg>
                            Aksi Cepat
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <a href="{{ route('barang.create') }}" class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:from-blue-100 hover:to-blue-200 transition duration-300 border border-blue-200 hover:border-blue-300 group">
                                <svg class="w-8 h-8 text-blue-600 mr-3 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold text-gray-800">Tambah Barang Baru</span>
                            </a>
                            
                            <a href="{{ route('barang.cetak_pdf') }}" class="flex items-center p-4 bg-gradient-to-r from-red-50 to-red-100 rounded-xl hover:from-red-100 hover:to-red-200 transition duration-300 border border-red-200 hover:border-red-300 group">
                                <svg class="w-8 h-8 text-red-600 mr-3 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10h6v6H9v-6z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6"></path>
                                </svg>
                                <span class="font-semibold text-gray-800">Cetak Laporan PDF</span>
                            </a>

                            @if(Auth::user()->role == 'admin')
                            <a href="{{ route('kategori.index') }}" class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl hover:from-purple-100 hover:to-purple-200 transition duration-300 border border-purple-200 hover:border-purple-300 group">
                                <svg class="w-8 h-8 text-purple-600 mr-3 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM15 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM5 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM15 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z"></path>
                                </svg>
                                <span class="font-semibold text-gray-800">Kelola Kategori</span>
                            </a>

                            <a href="{{ route('riwayat.index') }}" class="flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl hover:from-green-100 hover:to-green-200 transition duration-300 border border-green-200 hover:border-green-300 group">
                                <svg class="w-8 h-8 text-green-600 mr-3 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold text-gray-800">Lihat Riwayat</span>
                            </a>
                            @else
                            <a href="{{ route('riwayat.index') }}" class="flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl hover:from-green-100 hover:to-green-200 transition duration-300 border border-green-200 hover:border-green-300 group col-span-2">
                                <svg class="w-8 h-8 text-green-600 mr-3 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold text-gray-800">Lihat Riwayat Transaksi</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Info Box -->
                <div>
                    <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 rounded-2xl shadow-lg p-8 text-white">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM8 7a1 1 0 000 2h6a1 1 0 000-2H8zm0 4a1 1 0 000 2h3a1 1 0 000-2H8z" clip-rule="evenodd"></path>
                            </svg>
                            Informasi Sistem
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-start">
                                <span class="text-indigo-200 mr-3">📊</span>
                                <span>Sistem terintegrasi untuk manajemen logistik dan aset Polres</span>
                            </div>
                            <div class="flex items-start">
                                <span class="text-indigo-200 mr-3">🔒</span>
                                <span>Data terenkripsi dan terlindungi dengan baik</span>
                            </div>
                            <div class="flex items-start">
                                <span class="text-indigo-200 mr-3">⏰</span>
                                <span>Tracking real-time setiap transaksi</span>
                            </div>
                            <div class="flex items-start">
                                <span class="text-indigo-200 mr-3">👥</span>
                                <span>Role-based access control</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</x-app-layout>