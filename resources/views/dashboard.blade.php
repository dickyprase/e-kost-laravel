<x-app-layout>
    <!-- Hero Section -->
    <header class="relative overflow-hidden" style="background: linear-gradient(135deg, rgba(79,70,229,0.9) 0%, rgba(124,58,237,0.9) 100%), url('{{ asset('img/bg-kos.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 md:py-36 relative z-10">
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight">
                    Selamat Datang di <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-200 to-pink-200">E-Kos</span>
                </h1>
                <p class="text-lg md:text-xl text-indigo-100 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Temukan hunian nyaman, aman, dan sesuai kebutuhanmu dengan mudah.
                </p>
                <a href="#room-section" class="inline-flex items-center gap-2 btn-gradient px-8 py-4 rounded-full text-white font-semibold text-base shadow-2xl shadow-indigo-500/30">
                    <i class="bi bi-search"></i>
                    Lihat Kamar
                </a>
            </div>
        </div>
        <!-- Decorative circles -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/5 rounded-full translate-x-1/3 translate-y-1/3"></div>
    </header>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-indigo-50 to-white border border-indigo-100/50 card-hover" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-lg shadow-indigo-200">
                        <i class="bi bi-shield-check text-white text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-3">Aman & Nyaman</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Dilengkapi fasilitas keamanan 24 jam dan lingkungan yang nyaman.</p>
                </div>

                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-emerald-50 to-white border border-emerald-100/50 card-hover" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-lg shadow-emerald-200">
                        <i class="bi bi-currency-dollar text-white text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-3">Harga Terjangkau</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Berbagai pilihan kamar dengan harga yang sesuai kebutuhan Anda.</p>
                </div>

                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-amber-50 to-white border border-amber-100/50 card-hover" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-lg shadow-amber-200">
                        <i class="bi bi-geo-alt text-white text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-3">Lokasi Strategis</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Dekat dengan pusat kota, kampus, dan akses transportasi umum.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Room Section -->
    <section id="room-section" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-3">Semua Kamar</h2>
                <div class="w-20 h-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full mx-auto mb-4"></div>
                <p class="text-gray-500 text-base">Pilih kamar yang sesuai dengan kebutuhan dan budget Anda</p>
            </div>

            <!-- Room Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($rooms as $room)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 card-hover border border-gray-100">
                        <!-- Image -->
                        <div class="relative h-52 overflow-hidden">
                            <img src="{{ $room->image ? asset('storage/'.$room->image) : asset('admin/assets/img/kamar.jpg') }}"
                                 alt="{{ $room->room_name }}"
                                 class="w-full h-full object-cover img-zoom" />

                            <!-- Badges -->
                            @if ($room->price < 600000)
                                <div class="absolute top-3 right-3 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">PROMO</div>
                            @endif
                            <div class="absolute top-3 left-3 {{ $room->status == 'ready' ? 'bg-emerald-500' : 'bg-gray-500' }} text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                {{ $room->status == 'ready' ? 'Tersedia' : 'Penuh' }}
                            </div>

                            <!-- Quick View Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4">
                                <a href="{{ route('rooms.show', $room->id) }}" class="px-5 py-2 bg-white/90 backdrop-blur-sm text-gray-800 text-sm font-medium rounded-full hover:bg-white transition-colors">
                                    <i class="bi bi-eye mr-1"></i> Quick View
                                </a>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="p-5">
                            <h5 class="font-bold text-gray-800 mb-1 text-base">{{ $room->room_name }}</h5>
                            <p class="text-gray-400 text-xs mb-3">
                                <i class="bi bi-tag mr-1"></i>{{ $room->category->name ?? 'Tanpa Kategori' }} &middot;
                                <i class="bi bi-door-closed mx-1"></i>{{ $room->room_number }}
                            </p>

                            <!-- Rating -->
                            <div class="flex items-center gap-1 mb-3">
                                @for($i = 0; $i < 5; $i++)
                                    <i class="bi bi-star-fill text-amber-400 text-xs"></i>
                                @endfor
                                <span class="text-gray-400 text-xs ml-1">(5.0)</span>
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                @if ($room->price > 600000)
                                    <span class="text-gray-400 text-xs line-through">Rp {{ number_format($room->price + 100000, 0, ',', '.') }}/bln</span>
                                @endif
                                <div class="text-lg font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    Rp {{ number_format($room->price, 0, ',', '.') }}<span class="text-sm font-normal text-gray-400">/bulan</span>
                                </div>
                            </div>

                            <!-- Button -->
                            <a href="{{ route('rooms.show', $room->id) }}" class="block w-full text-center btn-gradient py-2.5 rounded-xl text-white text-sm font-semibold">
                                <i class="bi bi-info-circle mr-1"></i> Detail Kamar
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full" data-aos="fade-up">
                    <div class="text-center py-16 px-8 bg-white rounded-2xl border border-gray-100">
                        <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-5">
                            <i class="bi bi-info-circle text-indigo-500 text-3xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Tidak ada kamar tersedia</h4>
                        <p class="text-gray-500 text-sm">Silakan coba kembali nanti atau hubungi admin untuk informasi lebih lanjut.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative overflow-hidden" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center relative z-10" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">Butuh Bantuan?</h2>
                <p class="text-indigo-100 mb-8 text-lg max-w-lg mx-auto">Hubungi kami untuk informasi lebih lanjut mengenai ketersediaan kamar.</p>
                <button class="inline-flex items-center gap-2 bg-white text-indigo-600 px-8 py-4 rounded-full font-semibold text-base hover:bg-indigo-50 hover:shadow-xl transition-all duration-300 shadow-lg">
                    <i class="bi bi-chat-dots"></i>
                    Hubungi Kami
                </button>
            </div>
        </div>
        <!-- Decorative -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -translate-x-1/2 translate-y-1/2"></div>
    </section>
</x-app-layout>