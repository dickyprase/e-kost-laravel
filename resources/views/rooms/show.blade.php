<x-app-layout>
    <!-- Room Detail Section -->
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back button -->
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-indigo-600 transition-colors mb-6" data-aos="fade-right">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8" data-aos="fade-up">
                <!-- Room Image -->
                <div class="rounded-2xl overflow-hidden shadow-lg bg-white">
                    <img src="{{ $room->image ? asset('storage/'.$room->image) : asset('admin/assets/img/kamar.jpg') }}"
                         alt="{{ $room->room_name }}"
                         class="w-full h-[400px] object-cover" />
                </div>

                <!-- Room Info -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <h1 class="text-3xl font-extrabold text-gray-800 mb-4">{{ $room->room_name }}</h1>

                    <div class="mb-6">
                        <span class="inline-block bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-lg font-bold px-5 py-2 rounded-full shadow-lg shadow-indigo-200">
                            Rp {{ number_format($room->price, 0, ',', '.') }}/bulan
                        </span>
                    </div>

                    <p class="text-gray-600 leading-relaxed mb-6">{{ $room->description }}</p>

                    <div class="flex flex-wrap gap-3 mb-6">
                        <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium">
                            <i class="bi bi-door-closed text-indigo-500"></i>
                            Nomor: {{ $room->room_number }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium">
                            <i class="bi bi-tag text-indigo-500"></i>
                            {{ $room->category->name ?? 'Tanpa Kategori' }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 {{ $room->status == 'ready' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }} px-4 py-2 rounded-full text-sm font-medium">
                            <i class="bi {{ $room->status == 'ready' ? 'bi-check-circle' : 'bi-x-circle' }}"></i>
                            {{ $room->status == 'ready' ? 'Tersedia' : 'Tidak Tersedia' }}
                        </span>
                    </div>

                    @if($room->status == 'ready')
                        <button onclick="document.getElementById('bookingModal').classList.remove('hidden')" class="w-full btn-gradient py-4 rounded-xl text-white font-semibold text-base flex items-center justify-center gap-2">
                            <i class="bi bi-calendar-check"></i>
                            Pesan Sekarang
                        </button>
                    @else
                        <button class="w-full bg-gray-300 text-gray-500 py-4 rounded-xl font-semibold text-base cursor-not-allowed flex items-center justify-center gap-2" disabled>
                            <i class="bi bi-x-circle"></i>
                            Tidak Tersedia
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Modal -->
    <div id="bookingModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="document.getElementById('bookingModal').classList.add('hidden')"></div>

            <!-- Modal Content -->
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-auto animate-fade-in-up overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-5">
                    <div class="flex items-center justify-between">
                        <h5 class="text-lg font-bold text-white flex items-center gap-2">
                            <i class="bi bi-calendar-check"></i>
                            Pemesanan Kamar <span class="font-extrabold">{{ $room->room_name }}</span>
                        </h5>
                        <button onclick="document.getElementById('bookingModal').classList.add('hidden')" class="text-white/80 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                </div>

                <!-- Body -->
                <div class="p-6 max-h-[70vh] overflow-y-auto">
                    <form action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <!-- Room Summary -->
                        <div class="flex items-center gap-4 p-4 bg-indigo-50 rounded-xl mb-6 border border-indigo-100">
                            <img src="{{ $room->image ? asset('storage/'.$room->image) : asset('admin/assets/img/kamar.jpg') }}"
                                 alt="{{ $room->room_name }}"
                                 class="w-16 h-16 rounded-xl object-cover shadow" />
                            <div>
                                <h6 class="font-bold text-gray-800">{{ $room->room_name }}</h6>
                                <p class="text-xs text-gray-500">Nomor: {{ $room->room_number }} | {{ $room->category->name ?? 'Tanpa Kategori' }}</p>
                            </div>
                        </div>

                        <!-- Duration & Total -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="durasi_sewa" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="bi bi-calendar-range mr-1 text-indigo-500"></i> Durasi Sewa
                                </label>
                                <select id="durasi_sewa" name="durasi_sewa" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-0 transition-colors text-sm">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ $i }} bulan</option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="bi bi-cash-stack mr-1 text-indigo-500"></i> Total Tagihan
                                </label>
                                <div class="flex items-center">
                                    <span class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-4 py-3 rounded-l-xl text-sm font-bold">Rp</span>
                                    <input type="text" id="nominal_tagihan" name="nominal_tagihan" readonly value="{{ number_format($room->price, 0, ',', '.') }}" class="w-full px-4 py-3 rounded-r-xl border-2 border-l-0 border-gray-200 bg-gray-50 text-sm font-semibold">
                                </div>
                                <p class="text-xs text-gray-400 mt-1"><i class="bi bi-info-circle mr-1"></i>Otomatis dihitung</p>
                            </div>
                        </div>

                        <!-- Bank Info -->
                        <div class="mb-6">
                            <h6 class="text-sm font-semibold text-gray-700 mb-3"><i class="bi bi-credit-card mr-1 text-indigo-500"></i> Informasi Pembayaran</h6>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($banks as $bank)
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                    <div class="flex items-center gap-3 mb-3">
                                        @if($bank->logo)
                                        <img src="{{ asset('storage/'.$bank->logo) }}" alt="{{ $bank->bank_name }}" class="h-8 rounded">
                                        @endif
                                        <span class="font-bold text-gray-800 text-sm">{{ $bank->bank_name }}</span>
                                    </div>
                                    <div class="text-xs space-y-1">
                                        <p><span class="text-gray-500">No. Rek:</span> <span class="text-indigo-600 font-semibold">{{ $bank->number }}</span></p>
                                        <p><span class="text-gray-500">A.N:</span> {{ $bank->name }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Upload -->
                        <div class="mb-6">
                            <label for="bukti_pembayaran" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="bi bi-file-earmark-image mr-1 text-indigo-500"></i> Upload Bukti Pembayaran
                            </label>
                            <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" required accept="image/*"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-0 transition-colors text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-indigo-50 file:text-indigo-600 file:font-semibold file:text-xs" />
                            <p class="text-xs text-gray-400 mt-1"><i class="bi bi-info-circle mr-1"></i>Format: JPEG, PNG, JPG (Maks. 2MB)</p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col gap-3">
                            <button type="submit" class="w-full btn-gradient py-3 rounded-xl text-white font-semibold flex items-center justify-center gap-2">
                                <i class="bi bi-check-circle-fill"></i> Kirim Pesanan
                            </button>
                            <button type="button" onclick="document.getElementById('bookingModal').classList.add('hidden')" class="w-full py-3 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold hover:bg-gray-50 transition-colors flex items-center justify-center gap-2">
                                <i class="bi bi-x-circle"></i> Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });

            // Price calculation
            const durasiSelect = document.getElementById('durasi_sewa');
            const nominalInput = document.getElementById('nominal_tagihan');
            const hargaPerBulan = {{ $room->price }};

            function formatRupiah(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            durasiSelect.addEventListener('change', function() {
                const durasi = parseInt(this.value);
                const total = durasi * hargaPerBulan;
                nominalInput.value = formatRupiah(total);
            });
        });
    </script>
</x-app-layout>