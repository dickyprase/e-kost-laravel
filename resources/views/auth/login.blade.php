<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali</h2>
        <p class="text-gray-500 mt-2 text-sm">Masuk ke akun Anda untuk melanjutkan</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email or Username -->
        <div class="mb-5">
            <label for="login" class="block text-sm font-semibold text-gray-700 mb-2">Email atau Username</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input id="login" type="text" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="form-input-modern w-full pl-12 pr-4 py-3 rounded-xl text-gray-700 placeholder-gray-400"
                    placeholder="Masukkan email atau username">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="form-input-modern w-full pl-12 pr-4 py-3 rounded-xl text-gray-700 placeholder-gray-400"
                    placeholder="Masukkan password">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-gradient w-full py-3 px-6 rounded-xl text-white font-semibold text-base">
            Masuk
        </button>

        <!-- Register Link -->
        @if (Route::has('register'))
            <p class="text-center mt-6 text-sm text-gray-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:text-indigo-700 transition-colors">
                    Daftar di sini
                </a>
            </p>
        @endif
    </form>
</x-guest-layout>
