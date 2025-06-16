@props(['active' => false, 'href'])
<a {{ $attributes->merge(['href' => $href, 'class' => 'block px-4 py-2 text-gray-600 hover:text-yellow-600 transition-colors ' . ($active ? 'font-bold text-yellow-600 border-b-2 border-yellow-600' : '')]) }}>
    {{ $slot }}
</a>