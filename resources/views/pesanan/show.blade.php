@php
$setting = \App\Models\Setting::first();
@endphp

<x-app-layout>
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Top Actions -->
            <div class="flex flex-wrap gap-3 mb-8" data-aos="fade-right">
                <a href="{{ route('bookings.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-indigo-600 bg-white px-4 py-2.5 rounded-xl border border-gray-200 hover:border-indigo-200 transition-all">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                @if($booking->payment && $booking->payment->validasi == 'valid')
                    <a href="{{ route('invoice.show', request()->segment(2)) }}" target="_blank" class="inline-flex items-center gap-2 text-sm btn-gradient px-4 py-2.5 rounded-xl text-white font-semibold">
                        <i class="bi bi-printer"></i> Cetak Invoice
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Order Details Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" data-aos="fade-up">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                            <h5 class="text-white font-bold flex items-center gap-2">
                                <i class="bi bi-receipt"></i> Detail Pesanan #{{ $booking->id }}
                            </h5>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Room Info -->
                                <div>
                                    <h6 class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-3">Informasi Kamar</h6>
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $booking->room->image ? asset('storage/'.$booking->room->image) : asset('admin/assets/img/kamar.jpg') }}"
                                             alt="{{ $booking->room->room_name }}"
                                             class="w-20 h-20 rounded-xl object-cover shadow-sm" />
                                        <div>
                                            <h5 class="font-bold text-gray-800">{{ $booking->room->room_name }}</h5>
                                            <p class="text-xs text-gray-400">Nomor: {{ $booking->room->room_number }}</p>
                                            <p class="text-xs text-gray-400">{{ $booking->room->category->name ?? 'Tanpa Kategori' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Booking Info -->
                                <div>
                                    <h6 class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-3">Informasi Pemesanan</h6>
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Tanggal Pesan</span>
                                            <span class="text-gray-800 font-medium">{{ $booking->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Durasi Sewa</span>
                                            <span class="text-gray-800 font-medium">{{ $booking->durasi_sewa }} bulan</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Total Tagihan</span>
                                            <span class="font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Rp {{ number_format($booking->nominal_tagihan, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-100 pt-6">
                                <h6 class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-4">Informasi Pembayaran</h6>
                                @if($booking->payment)
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-500">Tgl Pembayaran</span>
                                                <span class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($booking->payment->tanggal_pembayaran)->format('d M Y, H:i') }}</span>
                                            </div>
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-500">Nominal Dibayar</span>
                                                <span class="font-bold text-gray-800">Rp {{ number_format($booking->payment->nominal_dibayar, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="flex justify-between text-sm items-center">
                                                <span class="text-gray-500">Status</span>
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
                                            </div>
                                        </div>

                                        <!-- Payment Proof -->
                                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                            <h6 class="text-xs font-semibold text-gray-500 mb-3">Bukti Pembayaran</h6>
                                            <a href="{{ asset('storage/'.$booking->payment->bukti_pembayaran) }}" target="_blank" class="block">
                                                <img src="{{ asset('storage/'.$booking->payment->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="rounded-lg mx-auto max-h-48 object-contain hover:opacity-80 transition-opacity" />
                                            </a>
                                            <p class="text-xs text-gray-400 text-center mt-2">Klik untuk memperbesar</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-amber-50 border border-amber-200 text-amber-700 p-4 rounded-xl text-sm flex items-center gap-2">
                                        <i class="bi bi-exclamation-triangle"></i> Belum ada data pembayaran.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6" data-aos="fade-up" data-aos-delay="100">
                    <!-- Status Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-sky-500 to-blue-600 px-6 py-4">
                            <h5 class="text-white font-bold flex items-center gap-2">
                                <i class="bi bi-info-circle"></i> Status Pesanan
                            </h5>
                        </div>
                        <div class="p-6 text-center">
                            @if($booking->payment)
                                @if($booking->payment->validasi == 'valid')
                                    <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="bi bi-check-lg text-emerald-500 text-4xl"></i>
                                    </div>
                                    <h4 class="text-lg font-bold text-gray-800 mb-2">Terverifikasi</h4>
                                    <p class="text-sm text-gray-500">Pembayaran Anda telah diverifikasi. Kamar siap ditempati sesuai durasi sewa.</p>
                                @elseif($booking->payment->validasi == 'pending')
                                    <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="bi bi-hourglass-split text-amber-500 text-3xl"></i>
                                    </div>
                                    <h4 class="text-lg font-bold text-gray-800 mb-2">Menunggu Verifikasi</h4>
                                    <p class="text-sm text-gray-500">Pembayaran sedang diproses. Mohon tunggu konfirmasi dari admin.</p>
                                @else
                                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="bi bi-x-lg text-red-500 text-4xl"></i>
                                    </div>
                                    <h4 class="text-lg font-bold text-gray-800 mb-2">Ditolak</h4>
                                    <p class="text-sm text-gray-500">Pembayaran Anda ditolak. Silahkan hubungi admin.</p>
                                @endif
                            @else
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="bi bi-clock-history text-gray-400 text-3xl"></i>
                                </div>
                                <h4 class="text-lg font-bold text-gray-800 mb-2">Belum Bayar</h4>
                                <p class="text-sm text-gray-500">Silahkan lakukan pembayaran untuk melanjutkan.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Contact Admin -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-gray-800 px-6 py-4">
                            <h5 class="text-white font-bold flex items-center gap-2">
                                <i class="bi bi-headset"></i> Kontak Admin
                            </h5>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-500 mb-4">Pertanyaan terkait pesanan? Hubungi admin:</p>
                            <a href="https://wa.me/{{ $setting->whatsapp }}" target="_blank"
                                class="w-full inline-flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-semibold text-sm transition-colors shadow-lg shadow-emerald-200">
                                <i class="bi bi-whatsapp"></i> WhatsApp Admin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>