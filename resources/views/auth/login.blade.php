<x-layout>
    <x-header title="Login" />
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Login ke FinLaB</h2>
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
        <form method="POST" action="{{ route('login') }}" class="space-y-4 max-w-md mx-auto">
            @csrf
            <div>
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" class="w-full border rounded px-3 py-2 @error('username') border-red-500 @enderror" required>
            </div>
            <div>
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror" required>
            </div>
            <div class="flex justify-between items-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">Login</button>
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Lupa Password?</a>
            </div>
        </form>
        <p class="text-center mt-4">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar</a></p>
    </div>
</x-layout>