<x-layout>
    <x-header title="Daftar" class="text-left" />
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl text-center font-semibold text-gray-800 pb-8 mb-4">
            Daftarkan akunmu dan nikmati semua fitur FinLaB!
        </h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4 max-w-md mx-auto">
            @csrf
            <div>
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" class="w-full border rounded px-3 py-2 @error('username') border-red-500 @enderror" required>
            </div>
            <div>
                <label for="name" class="block text-gray-700">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" required>
            </div>
            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror" required>
            </div>
            <div>
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror" required>
            </div>
            <div>
                <label for="password_confirmation" class="block text-gray-700">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
            </div>

            <!-- Button Daftar -->
            <button type="submit" class="bg-blue-600 text-white text-center px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors w-full max-w-sm mx-auto block">
                Daftar
            </button>
        </form>

        <p class="text-center mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login sekarang</a>
            <br>
            <a href="{{ route('admin.login') }}" class="text-blue-600 hover:underline">Masuk sebagai Admin</a>
        </p>
    </div>
</x-layout>