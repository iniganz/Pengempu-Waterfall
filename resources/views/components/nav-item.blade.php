@props(['active'])

@php
$base = '
    inline-flex items-center
    min-h-[40px]
    px-4 py-2
    rounded-full
    text-base
    transition-colors transition-shadow
    duration-300
    text-lg

';

$classes = ($active ?? false)
    ? $base . ' font-bold text-white border border-white/40 bg-white/15'
    : $base . ' font-medium text-white/80 hover:text-white hover:bg-white/10';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
