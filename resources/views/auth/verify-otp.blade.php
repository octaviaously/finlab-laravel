<x-layout>
    <x-header title="Verifikasi OTP" />
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Verifikasi Kode OTP</h2>
        <p class="text-gray-600 mb-4">Masukkan kode OTP yang telah dikirim ke email Anda: 1234</p>
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
        <form method="POST" action="{{ route('password.verify') }}" class="space-y-4 max-w-md mx-auto">
            @csrf
            <div>
                <label for="otp" class="block text-gray-700">Kode OTP</label>
                <input type="text" id="otp" name="otp" class="w-full border rounded px-3 py-2 @error('otp') border-red-500 @enderror" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">Lanjutkan</button>
        </form>
        <p class="text-center mt-4">Kembali ke <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a></p>
    </div>
</x-layout>