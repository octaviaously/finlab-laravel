<x-layout>
    <div class="bg-finlab-bg min-h-screen text-gray-800">
        <!-- Navbar -->
        <nav class="bg-finlab-dark text-finlab-yellow py-4">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-finlab-yellow hover:text-finlab-yellow-dark">FinLaB Admin</a>
                <a href="{{ route('logout') }}" class="text-finlab-yellow hover:text-finlab-yellow-dark">Logout</a>
            </div>
        </nav>

        <!-- Header dan Tombol Navigasi -->
        <div class="container mx-auto px-4 py-8 text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang, {{ auth()->guard('admin')->user()->name }}!</h2>
            <p class="text-gray-600 mb-6">Gunakan tombol di bawah untuk mengelola konten FINLAB.</p>

            <!-- Tombol Navigasi CRUD -->
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                <a href="{{ route('admin.artikels.index') }}" class=" text-gray-900 bg-yellow-500 hover:bg hover:bg-slate-50 hover:text-yellow-700 px-6 py-3 rounded-lg flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    <span>Kelola Artikel</span>
                </a>
                <a href="{{ route('admin.courses.index') }}" class=" text-gray-900 bg-yellow-500 hover:bg hover:bg-slate-50 hover:text-yellow-700 px-6 py-3 rounded-lg flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Kelola Kursus Mini</span>
                </a>
                <a href="{{ route('admin.quizzes.index') }}" class=" text-gray-900 bg-yellow-500 hover:bg hover:bg-slate-50 hover:text-yellow-700 px-6 py-3 rounded-lg flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Kelola Kuis</span>
                </a>
                
            </div>

            <!-- Ringkasan Data -->
            <h3 class="text-2xl font-bold text-yellow-500  mb-6">Statistik FinLaB</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-finlab-dark text-white p-6 rounded-lg shadow-lg">
                    <h4 class="text-lg text-gray-800 font-semibold">Jumlah Pengguna</h4>
                    <p class="text-3xl text-gray-800 font-bold">{{ \App\Models\User::count() }}</p>
                </div>
                <div class="bg-finlab-dark text-white p-6 rounded-lg shadow-lg">
                    <h4 class="text-lg text-gray-800 font-semibold">Jumlah Artikel</h4>
                    <p class="text-3xl text-gray-800 font-bold">{{ \App\Models\Artikel::count() }}</p>
                </div>
                <div class="bg-finlab-dark text-white p-6 rounded-lg shadow-lg">
                    <h4 class="text-lg text-gray-800 font-semibold">Jumlah Kursus</h4>
                    <p class="text-3xl text-gray-800 font-bold">{{ \App\Models\Course::count() }}</p>
                </div>
            </div>

            <!-- Grafik -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Perbandingan Tingkat Kesulitan</h4>
                    <canvas id="difficultyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Chart.js untuk Grafik -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Grafik Tingkat Kesulitan
            const difficultyChart = new Chart(document.getElementById('difficultyChart'), {
                type: 'bar',
                data: {
                    labels: ['Pemula', 'Menengah', 'Lanjutan'],
                    datasets: [{
                        label: 'Jumlah Kursus',
                        data: [
                            {{ \App\Models\Course::where('tingkat_kesulitan', 'pemula')->count() }},
                            {{ \App\Models\Course::where('tingkat_kesulitan', 'menengah')->count() }},
                            {{ \App\Models\Course::where('tingkat_kesulitan', 'lanjut')->count() }}
                        ],
                        backgroundColor: ['#F2C94C', '#E6B800', '#1C1C1C']
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            
        </script>
    </div>
</x-layout>