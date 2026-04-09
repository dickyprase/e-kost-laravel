
<nav x-data="{ open: false, scrolled: false, dropdownKategori: false, dropdownAkun: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
     :class="scrolled ? 'navbar-scrolled' : 'bg-white/70 backdrop-blur-md'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b border-gray-100/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 group-hover:shadow-indigo-300 transition-shadow">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">E-Kos</span>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200">
                    Beranda
                </a>

                <!-- Kategori Dropdown -->
                <div class="relative" @click.away="dropdownKategori = false">
                    <button @click="dropdownKategori = !dropdownKategori" class="px-4 py-2 rounded-full text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200 flex items-center gap-1">
                        Kategori
                        <svg class="w-4 h-4 transition-transform duration-200" :class="dropdownKategori ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="dropdownKategori" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute top-full mt-2 left-0 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50" style="display: none;">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">Semua Kamar</a>
                        <div class="border-t border-gray-100 my-1"></div>
                        @foreach ($categories as $category)
                            <a href="{{ route('kategori.show', $category->id) }}" class="block px-4 py-2.5 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('aboutus') }}" class="px-4 py-2 rounded-full text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200">
                    Tentang Kami
                </a>
            </div>

            <!-- Account Button -->
            <div class="hidden md:flex items-center">
                <div class="relative" @click.away="dropdownAkun = false">
                    <button @click="dropdownAkun = !dropdownAkun" class="flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-sm font-medium hover:shadow-lg hover:shadow-indigo-200 transition-all duration-300">
                        <i class="bi bi-person-fill"></i>
                        <span>{{ Auth::user()->name ?? 'Akun' }}</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="dropdownAkun ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="dropdownAkun" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute top-full mt-2 right-0 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50" style="display: none;">
                        @auth
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                                <i class="bi bi-person"></i> Profile
                            </a>
                            <a href="{{ route('bookings.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                                <i class="bi bi-bag"></i> Pesanan
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="flex items-center gap-2 px-4 py-2.5 text-sm text-red-500 hover:text-red-600 hover:bg-red-50 transition-colors">
                                    <i class="bi bi-box-arrow-right"></i> Log Out
                                </a>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                                <i class="bi bi-box-arrow-in-right"></i> Log In
                            </a>
                            <a href="{{ route('register') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                                <i class="bi bi-person-plus"></i> Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Mobile Hamburger -->
            <button @click="open = !open" class="md:hidden p-2 rounded-xl text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        class="md:hidden bg-white border-t border-gray-100 shadow-lg" style="display: none;">
        <div class="px-4 py-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">Beranda</a>
            <a href="{{ route('aboutus') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">Tentang Kami</a>

            @foreach ($categories as $category)
                <a href="{{ route('kategori.show', $category->id) }}" class="block px-4 py-3 rounded-xl text-sm text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 transition-colors pl-8">{{ $category->name }}</a>
            @endforeach

            <div class="border-t border-gray-100 my-2"></div>

            @auth
                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">Profile</a>
                <a href="{{ route('bookings.index') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">Pesanan</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block px-4 py-3 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50 transition-colors">Log Out</a>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">Log In</a>
                <a href="{{ route('register') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">Register</a>
            @endauth
        </div>
    </div>
</nav>

<!-- Spacer for fixed navbar -->
<div class="h-16"></div>