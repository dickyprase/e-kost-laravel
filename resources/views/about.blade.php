@php
$setting = \App\Models\Setting::first();
@endphp

<x-app-layout>
    <!-- Hero Section -->
    <header class="relative overflow-hidden" style="background: linear-gradient(135deg, rgba(79,70,229,0.9) 0%, rgba(124,58,237,0.9) 100%), url('{{ asset('img/bg-kos.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4">Tentang Kami</h1>
                <p class="text-lg text-indigo-100 max-w-lg mx-auto">Cari informasi tentang kami? Ada disini</p>
            </div>
        </div>
        <div class="absolute top-0 left-0 w-72 h-72 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/5 rounded-full translate-x-1/3 translate-y-1/3"></div>
    </header>

    <!-- Maps Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10" data-aos="fade-up">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-3">Lokasi Kami</h2>
                <div class="w-20 h-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full mx-auto"></div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-10 border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                {!! $setting->maps_embed !!}
            </div>

            <!-- Contact Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white rounded-2xl shadow-sm p-8 text-center border border-gray-100 card-hover">
                    <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-indigo-200">
                        <i class="bi bi-map-fill text-white text-xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Alamat</h4>
                    <div class="w-12 h-0.5 bg-indigo-200 mx-auto mb-4 rounded-full"></div>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $setting->alamat }}</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-8 text-center border border-gray-100 card-hover">
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-emerald-200">
                        <i class="bi bi-whatsapp text-white text-xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-2">No. Telp / WhatsApp</h4>
                    <div class="w-12 h-0.5 bg-emerald-200 mx-auto mb-4 rounded-full"></div>
                    <p class="text-gray-500 text-sm">{{ $setting->whatsapp }}</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
