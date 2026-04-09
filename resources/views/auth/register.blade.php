<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h2>
        <p class="text-gray-500 mt-2 text-sm">Isi data diri untuk mendaftar</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="form-input-modern w-full px-4 py-2.5 rounded-xl text-gray-700 text-sm" placeholder="Nama lengkap">
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autocomplete="username"
                    class="form-input-modern w-full px-4 py-2.5 rounded-xl text-gray-700 text-sm" placeholder="Username">
                <x-input-error :messages="$errors->get('username')" class="mt-1" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="form-input-modern w-full px-4 py-2.5 rounded-xl text-gray-700 text-sm" placeholder="email@contoh.com">
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- NIK -->
            <div>
                <label for="nik" class="block text-sm font-semibold text-gray-700 mb-1">NIK</label>
                <input id="nik" type="text" name="nik" value="{{ old('nik') }}"
                    class="form-input-modern w-full px-4 py-2.5 rounded-xl text-gray-700 text-sm" placeholder="Nomor Induk KTP">
                <x-input-error :messages="$errors->get('nik')" class="mt-1" />
            </div>

            <!-- Address -->
            <div class="sm:col-span-2">
                <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
                <input id="address" type="text" name="address" value="{{ old('address') }}"
                    class="form-input-modern w-full px-4 py-2.5 rounded-xl text-gray-700 text-sm" placeholder="Alamat lengkap">
                <x-input-error :messages="$errors->get('address')" class="mt-1" />
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <label for="birth_date" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Lahir</label>
                <input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date') }}"
                    class="form-input-modern w-full px-4 py-2.5 rounded-xl text-gray-700 text-sm">
                <x-input-error :messages="$errors->get('birth_date')" class="mt-1" />
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <label for="gender" class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kelamin</label>
                <select name="gender" id="gender" class="form-input-modern w-full px-4 py-2.5 rounded-xl text-gray-700 text-sm">
                    <option value="unknown">Pilih</option>
                    <option value="laki-laki" {{ old('gender') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-1" />
            </div>

            <!-- No Telepon -->
            <div>
                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1">No. Telepon</label>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                    class="form-input-modern w-full px-4 py-2.5 rounded-xl text-gray-700 text-sm" placeholder="08xxxxxxxxxx">
                <x-input-error :messages="$errors->get('phone')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="form-input-modern w-full px-4 py-2.5 rounded-xl text-gray-700 text-sm" placeholder="Min. 8 karakter">
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="form-input-modern w-full px-4 py-2.5 rounded-xl text-gray-700 text-sm" placeholder="Ketik ulang password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-gradient w-full py-3 px-6 rounded-xl text-white font-semibold text-base mt-6">
            Daftar
        </button>

        <p class="text-center mt-4 text-sm text-gray-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:text-indigo-700 transition-colors">
                Masuk di sini
            </a>
        </p>
    </form>
</x-guest-layout>
