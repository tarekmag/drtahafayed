@props([
    'src',
    'alt' => '',
    'sizes' => '100vw',
    'priority' => false,
    'width' => null,
    'height' => null,
])

@php
    $isRemote = preg_match('#^https?://#i', $src);
    $url = $isRemote ? $src : asset(ltrim($src, '/'));
    $sources = [];

    if (! $isRemote && preg_match('/\.(jpe?g|png)$/i', $src)) {
        $base = preg_replace('/\.(jpe?g|png)$/i', '', ltrim($src, '/'));
        foreach ([480, 800, 1200] as $w) {
            if (is_file(public_path("{$base}-{$w}.webp"))) {
                $sources[] = asset("{$base}-{$w}.webp")." {$w}w";
            }
        }
    }
@endphp

<picture {{ $attributes->only('class') }}>
    @if ($sources)
        <source type="image/webp" srcset="{{ implode(', ', $sources) }}" sizes="{{ $sizes }}">
    @endif
    <img
        src="{{ $url }}"
        alt="{{ $alt }}"
        @if ($width) width="{{ $width }}" @endif
        @if ($height) height="{{ $height }}" @endif
        @if ($priority) fetchpriority="high" @else loading="lazy" @endif
        decoding="async"
        {{ $attributes->except('class') }}
    >
</picture>
