<x-app-layout>
    <!-- Hero Header -->
    <header class="relative overflow-hidden" style="background: linear-gradient(135deg, rgba(79,70,229,0.9) 0%, rgba(124,58,237,0.9) 100%), url('{{ asset('img/bg-kos.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3">{{ $category->name }}</h1>
                <p class="text-lg text-indigo-100">Kamar yang tersedia di kategori ini</p>
            </div>
        </div>
        <div class="absolute top-0 left-0 w-72 h-72 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/5 rounded-full translate-x-1/3 translate-y-1/3"></div>
    </header>

    <!-- Room Cards -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back link -->
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-indigo-600 transition-colors mb-8" data-aos="fade-right">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($category->rooms as $room)
                    @if($room->status == 'ready')
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 card-hover border border-gray-100">
                            <!-- Image -->
                            <div class="relative h-52 overflow-hidden">
                                <img src="{{ $room->image ? asset('storage/'.$room->image) : asset('admin/assets/img/kamar.jpg') }}"
                                     alt="{{ $room->room_name }}"
                                     class="w-full h-full object-cover img-zoom" />

                                <div class="absolute top-3 left-3 bg-emerald-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                    Tersedia
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
                                <p class="text-gray-400 text-xs mb-3 line-clamp-2">{{ $room->description }}</p>

                                <!-- Rating -->
                                <div class="flex items-center gap-1 mb-3">
                                    @for($i = 0; $i < 5; $i++)
                                        <i class="bi bi-star-fill text-amber-400 text-xs"></i>
                                    @endfor
                                    <span class="text-gray-400 text-xs ml-1">(5.0)</span>
                                </div>

                                <!-- Price -->
                                <div class="mb-4">
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
                    @endif
                @empty
                    <div class="col-span-full" data-aos="fade-up">
                        <div class="text-center py-16 px-8 bg-white rounded-2xl border border-gray-100">
                            <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-5">
                                <i class="bi bi-info-circle text-indigo-500 text-3xl"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-800 mb-2">Tidak ada kamar tersedia</h4>
                            <p class="text-gray-500 text-sm mb-6">Belum ada kamar yang tersedia di kategori ini.</p>
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 btn-gradient px-6 py-3 rounded-xl text-white font-semibold text-sm">
                                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
