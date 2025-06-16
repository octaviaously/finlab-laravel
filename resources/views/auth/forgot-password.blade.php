<x-layout>
    <x-header title="Lupa Password" />
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Lupa Password</h2>
        <p class="text-gray-600 mb-4">Masukkan email Anda untuk mendapatkan kode OTP.</p>
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
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
        <form method="POST" action="{{ route('password.sendOtp') }}" class="space-y-4 max-w-md mx-auto">
            @csrf
            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">Lanjutkan</button>
        </form>
        <p class="text-center mt-4">Kembali ke <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a></p>
    </div>
</x-layout>