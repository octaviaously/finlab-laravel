<x-layout>
    <x-header title="Reset Password" />
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Reset Password</h2>
        <p class="text-gray-600 mb-4">Masukkan password baru Anda.</p>
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
        <form method="POST" action="{{ route('password.reset') }}" class="space-y-4 max-w-md mx-auto">
            @csrf
            <div>
                <label for="password" class="block text-gray-700">Password Baru</label>
                <input type="password" id="password" name="password" class="w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-gray-700">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border rounded px-3 py-2 @error('password_confirmation') border-red-500 @enderror" required>
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">Ganti Password Baru</button>
        </form>
        <p class="text-center mt-4">Kembali ke <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a></p>
    </div>
</x-layout>