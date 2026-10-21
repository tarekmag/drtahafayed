@props([
    'src',
    'alt' => '',
    'sizes' => '100vw',
    'priority' => false,
    'width' => null,
    'height' => null,
])

@use('App\Support\ResponsiveImage')

@php
    $url = ResponsiveImage::url($src);
    $srcset = ResponsiveImage::webpSrcset($src);
@endphp

@if ($priority)
    @push('preload')
        @if ($srcset)
            <link rel="preload" as="image" type="image/webp" imagesrcset="{{ $srcset }}" imagesizes="{{ $sizes }}" fetchpriority="high">
        @else
            <link rel="preload" as="image" href="{{ $url }}" fetchpriority="high">
        @endif
    @endpush
@endif

<picture {{ $attributes->only('class') }}>
    @if ($srcset)
        <source type="image/webp" srcset="{{ $srcset }}" sizes="{{ $sizes }}">
    @endif
    <img
        src="{{ $url }}"
        alt="{{ $alt }}"
        @if ($width) width="{{ $width }}" @endif
        @if ($height) height="{{ $height }}" @endif
        @if ($priority) fetchpriority="high" @else loading="lazy" @endif
        decoding="{{ $priority ? 'sync' : 'async' }}"
        {{ $attributes->except('class') }}
    >
</picture>
