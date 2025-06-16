<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'FINLAB' }} - FINLAB</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex flex-col">
        <x-navbar />
        <main class="flex-grow">
            {{ $slot }}
        </main>
        <footer class="bg-gray-900 text-white py-12">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4">FINLAB</h3>
                        <p class="mb-2">Hubungi Kami</p>
                        <p class="mb-2">finlabs@gmail.com</p>
                        <p>Jl. Rungkut Madya, Gn. Anyar, Surabaya, Jawa Timur 60294</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Fitur</h3>
                        <ul class="space-y-2">
                            <li><a href="/artikels" class="hover:text-blue-400">Artikel</a></li>
                            <li><a href="/courses" class="hover:text-blue-400">Kursus Mini</a></li>
                            <li><a href="/budget" class="hover:text-blue-400">Simulasi Anggaran</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Tautan</h3>
                        <ul class="space-y-2">
                            <li><a href="/" class="hover:text-blue-400">Beranda</a></li>
                            <li><a href="/about" class="hover:text-blue-400">Tentang FINLAB</a></li>
                            <li><a href="/artikels" class="hover:text-blue-400">Artikel</a></li>
                            <li><a href="/courses" class="hover:text-blue-400">Kursus Mini</a></li>
                            <li><a href="/contact" class="hover:text-blue-400">Kontak</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <p class="text-sm">© 2025 FINLAB. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>