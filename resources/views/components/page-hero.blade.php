@props([
    'eyebrow' => null,
    'title',
    'lede' => null,
    'crumbs' => [],
])

<header {{ $attributes->class(['page-hero']) }}>
    <div class="page-hero-glow" aria-hidden="true"></div>
    <div class="container page-hero-inner">
        <nav class="breadcrumbs" aria-label="{{ __('site.common.breadcrumb') }}">
            <ol>
                <li><a href="{{ route('site.home') }}">{{ __('site.nav.home') }}</a></li>
                @foreach ($crumbs as $label => $url)
                    <li>
                        @if ($url)
                            <a href="{{ $url }}">{{ $label }}</a>
                        @else
                            <span aria-current="page">{{ $label }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
        @if ($eyebrow)
            <p class="eyebrow eyebrow-light">{{ $eyebrow }}</p>
        @endif
        <h1 class="page-hero-title">{{ $title }}</h1>
        @if ($lede)
            <p class="page-hero-lede">{{ $lede }}</p>
        @endif
        {{ $slot }}
    </div>
</header>
