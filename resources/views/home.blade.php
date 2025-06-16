<x-layout>
    <x-header title="Beranda" />
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Tentang FINLAB</h2>
                <p class="text-lg text-gray-700 mb-6">Kelola keuangan dengan lebih cerdas di FINLAB. Kami membantu Anda membuat keputusan finansial yang lebih baik dengan edukasi dan alat praktis.</p>
                <p class="text-lg text-gray-600 italic mb-6">"Wujudkan Masa Depan Finansial Anda Bersama FINLAB!"</p>
                <div class="flex space-x-6">
                    @guest
                        <a href="{{ route('register') }}" class="bg-gray-900 text-white px-6 py-3 rounded-lg hover:bg-gray-500 transition-colors">Daftar Sekarang</a>
                    @endguest
                    <a href="https://www.instagram.com/finlab_id" target="_blank" class="flex items-center text-yellow-600 hover:text-yellow-700 contact-button">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.336 3.608 1.311.975.975 1.249 2.242 1.311 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.336 2.633-1.311 3.608-.975.975-2.242 1.249-3.608 1.311-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.336-3.608-1.311-.975-.975-1.249-2.242-1.311-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.336-2.633 1.311-3.608.975-.975 2.242-1.249 3.608-1.311 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-1.453.066-2.747.406-3.789 1.448s-1.382 2.336-1.448 3.789c-.058 1.28-.072 1.688-.072 4.947s.014 3.667.072 4.947c.066 1.453.406 2.747 1.448 3.789s2.336 1.382 3.789 1.448c1.28.058 1.688.072 4.947.072s3.667-.014 4.947-.072c1.453-.066 2.747-.406 3.789-1.448s1.382-2.336 1.448-3.789c.058-1.28.072-1.688.072-4.947s-.014-3.667-.072-4.947c-.066-1.453-.406-2.747-1.448-3.789s-2.336-1.382-3.789-1.448c-1.28-.058-1.688-.072-4.947-.072z"/>
                            <path d="M12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a3.999 3.999 0 110-7.998 3.999 3.999 0 010 7.998z"/>
                            <circle cx="18.406" cy="5.594" r="1.44"/>
                        </svg>
                        Instagram
                    </a>
                    <a href="mailto:finlabs@gmail.com" class="flex items-center text-yellow-600 hover:text-yellow-700 contact-button">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12.713l11.985-7.856A2.97 2.97 0 0021 3H3a2.97 2.97 0 00-2.985 1.857L12 12.713zm0 2.574L.015 7.429A2.97 2.97 0 000 8.143v9.714A2.97 2.97 0 002.97 21h18.06A2.97 2.97 0 0024 18.857V8.143a2.97 2.97 0 00-.015-.714L12 15.287z"/>
                        </svg>
                        Email
                    </a>
                </div>
            </div>
            <div class="flex justify-center">
                <img src="/img/modelhomepage.png" alt="FINLAB Banner" class="max-w-[80%] h-auto">
            </div>
        </div>
    </div>
</x-layout>