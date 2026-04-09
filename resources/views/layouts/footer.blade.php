
<footer class="bg-gray-900 text-white">
    <!-- Gradient accent line -->
    <div class="h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Brand -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold">E-Kos</span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">Temukan hunian nyaman, aman, dan sesuai kebutuhanmu dengan mudah.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-gray-400 mb-4">Menu</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition-colors text-sm">Beranda</a></li>
                    <li><a href="{{ route('aboutus') }}" class="text-gray-300 hover:text-white transition-colors text-sm">Tentang Kami</a></li>
                    @auth
                    <li><a href="{{ route('bookings.index') }}" class="text-gray-300 hover:text-white transition-colors text-sm">Pesanan Saya</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-gray-400 mb-4">Kontak</h4>
                <ul class="space-y-3">
                    <li class="flex items-center gap-2 text-gray-300 text-sm">
                        <i class="bi bi-envelope"></i>
                        <span>info@ekos.com</span>
                    </li>
                    <li class="flex items-center gap-2 text-gray-300 text-sm">
                        <i class="bi bi-geo-alt"></i>
                        <span>Indonesia</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-10 pt-8 text-center">
            <p class="text-gray-500 text-sm">&copy; E-Kos {{ date('Y') }}. All rights reserved.</p>
        </div>
    </div>
</footer>