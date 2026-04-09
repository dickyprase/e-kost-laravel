<x-app-layout>
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8" data-aos="fade-up">
                <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Daftar Pesanan Saya</h1>
                <div class="w-16 h-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full"></div>
            </div>

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-xl mb-6 flex items-center gap-3" data-aos="fade-up">
                    <i class="bi bi-check-circle-fill text-emerald-500 text-lg"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (count($bookings) > 0)
                <div class="space-y-4">
                    @foreach ($bookings as $index => $booking)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 card-hover" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <!-- Room Image & Info -->
                            <div class="flex items-center gap-4 flex-1">
                                <img src="{{ $booking->room->image ? asset('storage/'.$booking->room->image) : asset('admin/assets/img/kamar.jpg') }}"
                                     alt="{{ $booking->room->room_name }}"
                                     class="w-16 h-16 rounded-xl object-cover shadow-sm flex-shrink-0" />
                                <div class="min-w-0">
                                    <h4 class="font-bold text-gray-800 truncate">{{ $booking->room->room_name }}</h4>
                                    <p class="text-xs text-gray-400">No. {{ $booking->room->room_number }}</p>
                                </div>
                            </div>

                            <!-- Duration -->
                            <div class="text-center sm:text-right">
                                <p class="text-xs text-gray-400 mb-0.5">Durasi</p>
                                <p class="text-sm font-semibold text-gray-700">{{ $booking->durasi_sewa }} bulan</p>
                            </div>

                            <!-- Total -->
                            <div class="text-center sm:text-right">
                                <p class="text-xs text-gray-400 mb-0.5">Total</p>
                                <p class="text-sm font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Rp {{ number_format($booking->nominal_tagihan, 0, ',', '.') }}</p>
                            </div>

                            <!-- Date -->
                            <div class="text-center sm:text-right hidden md:block">
                                <p class="text-xs text-gray-400 mb-0.5">Tanggal</p>
                                <p class="text-sm text-gray-600">{{ $booking->created_at->format('d M Y') }}</p>
                            </div>

                            <!-- Status -->
                            <div class="text-center sm:text-right">
                                @if($booking->payment)
                                    @if($booking->payment->validasi == 'valid')
                                        <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1.5 rounded-full">
                                            <i class="bi bi-check-circle-fill"></i> Terverifikasi
                                        </span>
                                    @elseif($booking->payment->validasi == 'pending')
                                        <span class="inline-flex items-center gap-1 bg-amber-100 text-amber-700 text-xs font-semibold px-3 py-1.5 rounded-full">
                                            <i class="bi bi-hourglass-split"></i> Menunggu
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 text-xs font-semibold px-3 py-1.5 rounded-full">
                                            <i class="bi bi-x-circle-fill"></i> Ditolak
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">
                                        <i class="bi bi-clock"></i> Belum Bayar
                                    </span>
                                @endif
                            </div>

                            <!-- Action -->
                            <a href="{{ route('bookings.detail', $booking->id) }}" class="inline-flex items-center gap-1.5 btn-gradient px-4 py-2.5 rounded-xl text-white text-xs font-semibold flex-shrink-0">
                                <i class="bi bi-eye-fill"></i> Detail
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 px-8 bg-white rounded-2xl border border-gray-100" data-aos="fade-up">
                    <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-5">
                        <i class="bi bi-bag text-indigo-500 text-3xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Belum ada pesanan</h4>
                    <p class="text-gray-500 text-sm mb-6">Anda belum memiliki pesanan.</p>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 btn-gradient px-6 py-3 rounded-xl text-white font-semibold text-sm">
                        <i class="bi bi-search"></i> Lihat Daftar Kamar
                    </a>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>