<x-layout>
    <x-header title="Masuk sebagai Admin" class="text-left" />
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl text-center font-semibold text-gray-800 pb-8 mb-4">
            Masuk ke akun admin Anda
        </h2>

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

        <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4 max-w-md mx-auto">
            @csrf
            <div>
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" class="w-full border rounded px-3 py-2 @error('username') border-red-500 @enderror" required>
            </div>
            <div>
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white text-center px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors w-full max-w-sm mx-auto block">
                Masuk
            </button>
        </form>

        <p class="text-center mt-4">
            Bukan admin? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login sebagai pengguna</a>
        </p>
    </div>
</x-layout>