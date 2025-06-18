<nav class="fixed top-0 left-0 w-full z-50 bg-white shadow">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
            <a href="/" class="text-3xl font-bold text-yellow-600">FINLAB</a>
            <div class="hidden md:flex space-x-6 items-center">
                <x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link>
                <x-nav-link href="/artikels" :active="request()->is('artikels')" class="protected-link">Artikel</x-nav-link>
                <x-nav-link href="/courses" :active="request()->is('courses')" class="protected-link">Kursus Mini</x-nav-link>
                @auth
                    <a href="{{ route('profile') }}" class="flex items-center text-gray-600 hover:text-yellow-600">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        {{ Auth::user()->name }}
                    </a>
                @else
                    <x-nav-link href="/signup" :active="request()->is('signup')" class="border border-yellow-600 text-yellow-600 px-4 py-2 rounded-lg hover:bg-yellow-600 hover:text-yellow-50 transition-colors">Daftar</x-nav-link>
                @endauth
            </div>
            <div class="md:hidden">
                <button type="button" class="text-gray-600 hover:text-yellow-600 focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-white shadow mt-2">
            <div class="px-4 py-4 space-y-2">
                <x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link>
                <x-nav-link href="/artikels" :active="request()->is('artikels*')" class="protected-link">Artikel</x-nav-link>
                <x-nav-link href="/courses" :active="request()->is('courses')" class="protected-link">Kursus Mini</x-nav-link>
                @auth
                    <x-nav-link href="{{ route('profile') }}">{{ Auth::user()->name }}</x-nav-link>
                @else
                    <x-nav-link href="/signup" :active="request()->is('signup')" class="border border-yellow-600 text-yellow-600 px-4 py-2 rounded-lg hover:bg-yellow-600 hover:text-white transition-colors block text-center">Daftar</x-nav-link>
                @endauth
            </div>
        </div>
    </div>

    <!-- Pop-up -->
    <div id="auth-popup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full text-center">
    <h3 class="text-lg font-bold mb-4">Silakan Login atau Daftar</h3>
    <p class="text-gray-600 mb-4">Anda perlu login atau daftar untuk mengakses fitur ini.</p>
    <div class="flex flex-col space-y-1 items-center">
        <a href="{{ route('login') }}" class="w-full border border-gray-900 text-gray-900 bg-white px-4 py-2 rounded-lg hover:bg-gray-100">
            Login
        </a>
        <a href="{{ route('register') }}" class="w-full bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-800">
            Daftar
        </a>
        </div>
        <button class="mt-4 text-gray-600 hover:text-gray-800" onclick="document.getElementById('auth-popup').classList.add('hidden')">
            Tutup
        </button>
    </div>

    </div>

    <script>
        document.querySelectorAll('.protected-link').forEach(link => {
            link.addEventListener('click', function(event) {
                @if (!Auth::check())
                    event.preventDefault();
                    document.getElementById('auth-popup').classList.remove('hidden');
                @endif
            });
        });
    </script>
</nav>