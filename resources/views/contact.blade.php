<x-layout>
    <x-header title="Contact" />
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl text-gray-600 mb-6">Hubungi Kami</h2>
        <p class="text-lg mb-6">Kirim pesan langsung melalui formulir di bawah ini:</p>
        <form class="space-y-4 max-w-md mx-auto">
            <div>
                <label for="nama" class="block text-gray-700">Nama</label>
                <input type="text" id="nama" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label for="pesan" class="block text-gray-700">Pesan</label>
                <textarea id="pesan" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">Kirim</button>
        </form>
    </div>
</x-layout>