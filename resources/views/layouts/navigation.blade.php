<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 border-b-4 border-blue-900 shadow-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="bg-white p-2 rounded-lg shadow-lg group-hover:shadow-2xl transition duration-300">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold text-xl text-white">POLRES</div>
                            <div class="text-xs text-blue-100">LOGISTIK</div>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-2 sm:-my-px sm:ml-16 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white' : 'text-blue-100 hover:bg-blue-500 hover:text-white' }} transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"></path>
                            <path d="M3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6z"></path>
                            <path d="M14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                        </svg>
                        {{ __('Dashboard') }}
                    </a>

                    <a href="{{ route('barang.index') }}" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('barang.*') ? 'bg-blue-500 text-white' : 'text-blue-100 hover:bg-blue-500 hover:text-white' }} transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"></path>
                        </svg>
                        {{ __('Data Barang') }}
                    </a>

                    <a href="{{ route('riwayat.index') }}" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('riwayat.*') ? 'bg-blue-500 text-white' : 'text-blue-100 hover:bg-blue-500 hover:text-white' }} transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Riwayat') }}
                    </a>

                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('kategori.index') }}" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('kategori.*') ? 'bg-blue-500 text-white' : 'text-blue-100 hover:bg-blue-500 hover:text-white' }} transition duration-200">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM15 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM5 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM15 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z"></path>
                            </svg>
                            {{ __('Kategori') }}
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-400 text-white font-semibold rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
                            <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center mr-2">
                                <span class="text-blue-600 font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                            <div class="text-right mr-2">
                                <div class="text-sm font-bold">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-blue-100 capitalize">{{ Auth::user()->role }}</div>
                            </div>
                            <svg class="fill-current h-4 w-4 text-blue-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <div class="border-t border-gray-100"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center text-red-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-blue-100 hover:text-white hover:bg-blue-500 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-700">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white' : 'text-blue-100 hover:bg-blue-500 hover:text-white' }}">
                {{ __('Dashboard') }}
            </a>

            <a href="{{ route('barang.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('barang.*') ? 'bg-blue-500 text-white' : 'text-blue-100 hover:bg-blue-500 hover:text-white' }}">
                {{ __('Data Barang') }}
            </a>

            <a href="{{ route('riwayat.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('riwayat.*') ? 'bg-blue-500 text-white' : 'text-blue-100 hover:bg-blue-500 hover:text-white' }}">
                {{ __('Riwayat Transaksi') }}
            </a>

            @if(Auth::user()->role == 'admin')
                <a href="{{ route('kategori.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('kategori.*') ? 'bg-blue-500 text-white' : 'text-blue-100 hover:bg-blue-500 hover:text-white' }}">
                    {{ __('Kategori') }}
                </a>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-blue-500">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-blue-100">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-100 hover:bg-blue-500 hover:text-white">
                    {{ __('Profile') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="block px-3 py-2 rounded-md text-base font-medium text-red-200 hover:bg-red-600 hover:text-white" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>