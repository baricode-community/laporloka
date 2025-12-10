<nav x-data="{ isOpen: false }" class="bg-white/70 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-20">
            <div class="flex-shrink-0 flex items-center gap-2">
                <a href="{{ url('/') }}"
                    class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-green-600 bg-clip-text text-transparent">
                    LaporLoka
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}"
                    class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition-colors {{ request()->is('/') ? 'text-blue-600' : '' }}">
                    Beranda
                </a>
                <a href="{{ url('/about') }}"
                    class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition-colors {{ request()->is('about') ? 'text-blue-600' : '' }}">
                    Tentang
                </a>
                <a href="{{ url('/laporan') }}"
                    class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition-colors {{ request()->is('laporan') ? 'text-blue-600' : '' }}">
                    Data Laporan
                </a>
                @auth
                    <a href="{{ url('/laporan/create') }}"
                        class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition-colors {{ request()->is('laporan/create') ? 'text-blue-600' : '' }}">
                        Buat Laporan
                    </a>
                @endauth
            </div>

            <div class="hidden md:flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}"
                        class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-colors shadow-lg shadow-blue-200">
                        Daftar
                    </a>
                @else
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false"
                            class="flex items-center gap-2 text-sm font-semibold text-gray-700 hover:text-blue-600 transition-colors">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-1">
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <div class="md:hidden flex items-center">
                <button @click="isOpen = !isOpen" class="text-gray-600 hover:text-blue-600 focus:outline-none p-2">
                    <svg class="h-6 w-6" x-show="!isOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="h-6 w-6" x-show="isOpen" x-cloak fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden bg-white border-t border-gray-100 absolute w-full shadow-lg">
        <div class="px-4 pt-2 pb-6 space-y-1">
            <a href="{{ url('/') }}"
                class="block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">Home</a>
            <a href="{{ url('/about') }}"
                class="block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">About</a>

            <div class="border-t border-gray-100 my-2"></div>

            @guest
                <a href="{{ route('login') }}"
                    class="block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">Masuk</a>
                <a href="{{ route('register') }}"
                    class="block px-3 py-3 mt-2 text-center rounded-lg text-base font-medium bg-blue-600 text-white hover:bg-blue-700">Daftar
                    Sekarang</a>
            @else
                <a href="{{ route('dashboard') }}"
                    class="block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-3 py-3 rounded-lg text-base font-medium text-red-600 hover:bg-red-50">
                        Keluar
                    </button>
                </form>
            @endguest
        </div>
    </div>
</nav>
