@php
    use App\Support\Asset;
    use App\Support\Content;
    use App\Support\MediaEmbed;
    use App\Support\Seo\PageUrls;
    use App\Support\Seo\SearchIndexing;

    $locale = app()->getLocale();
    $direction = $locale === 'ar' ? 'rtl' : 'ltr';
    $otherLocale = $locale === 'ar' ? 'en' : 'ar';
    $switchUrl = PageUrls::localized($otherLocale);
    $alternates = PageUrls::alternates();
    $canonical = PageUrls::canonical();
    $page = PageUrls::page();
    $title = trim($__env->yieldContent('meta_title', __('site.brand.name')));
    $title = $page > 1 ? $title.' – '.__('site.common.page_number', ['page' => $page]) : $title;
    $description = trim($__env->yieldContent('meta_description', __('site.brand.description')));
    $robots = trim($__env->yieldContent('meta_robots', SearchIndexing::robots()));
    $ogType = trim($__env->yieldContent('og_type', 'website'));
    $ogImage = trim($__env->yieldContent('og_image')) ?: MediaEmbed::image(Content::doctor()['hero_image'] ?? 'assets/images/dr-1.jpeg');
    $fonts = $locale === 'ar'
        ? 'family=Alexandria:wght@500;600;700&family=Cairo:wght@400;500;600;700'
        : 'family=Cairo:wght@400;500;600;700&family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500';
    $isHome = request()->routeIs('site.home');
    $contact = Content::contact();
    $hasDock = $contact['phone'] !== '' || $contact['whatsapp'] !== '';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $direction }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="robots" content="{{ $robots }}">
    <meta name="theme-color" content="#14343C">
    <link rel="canonical" href="{{ $canonical }}">
    @foreach ($alternates as $hreflang => $href)
        <link rel="alternate" hreflang="{{ $hreflang }}" href="{{ $href }}">
    @endforeach
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:site_name" content="{{ __('site.brand.name') }}">
    <meta property="og:locale" content="{{ $locale === 'ar' ? 'ar_EG' : 'en_US' }}">
    <meta property="og:locale:alternate" content="{{ $locale === 'ar' ? 'en_US' : 'ar_EG' }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:alt" content="{{ $title }}">
    @stack('meta')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?{{ $fonts }}&display=swap" rel="stylesheet">
    @stack('preload')
    <script>document.documentElement.classList.add('js');</script>
    <link rel="stylesheet" href="{{ Asset::versioned('frontend/css/tokens.css') }}">
    <link rel="stylesheet" href="{{ Asset::versioned('frontend/css/base.css') }}">
    <link rel="stylesheet" href="{{ Asset::versioned('frontend/css/components.css') }}">
    <link rel="stylesheet" href="{{ Asset::versioned('frontend/css/sections.css') }}">
    @stack('styles')
    @livewireStyles
    <x-json-ld :title="$title" :description="$description" :url="$canonical" />
</head>
<body @class(['page-home' => $isHome, 'has-dock' => $hasDock])>
    <a class="skip-link" href="#content">{{ __('site.common.skip') }}</a>
    <div class="read-progress" hidden data-progress><span></span></div>

    @include('frontend.partials.header', ['switchUrl' => $switchUrl])

    <main id="content">
        @yield('content')
    </main>

    @include('frontend.partials.footer')
    <x-dock />

    <div class="lightbox" data-lightbox-root hidden>
        <button class="lightbox-backdrop" type="button" data-lightbox-close aria-label="{{ __('site.photos.close') }}"></button>
        <figure class="lightbox-figure">
            <img src="" alt="" data-lightbox-image hidden>
            <div data-lightbox-embed hidden></div>
            <figcaption data-lightbox-caption></figcaption>
        </figure>
        <button class="lightbox-nav lightbox-prev" type="button" data-lightbox-prev aria-label="{{ __('site.photos.prev') }}">
            <x-icon name="arrow" />
        </button>
        <button class="lightbox-nav lightbox-next" type="button" data-lightbox-next aria-label="{{ __('site.photos.next') }}">
            <x-icon name="arrow" />
        </button>
        <button class="lightbox-close" type="button" data-lightbox-close aria-label="{{ __('site.photos.close') }}">
            <x-icon name="close" />
        </button>
    </div>

    @isset($pageViewId)
        <script>
            (() => {
                const started = performance.now();
                let sent = false;
                const send = () => {
                    if (sent) {
                        return;
                    }

                    const seconds = Math.min(1800, Math.round((performance.now() - started) / 1000));

                    if (seconds < 1) {
                        return;
                    }

                    sent = true;
                    const token = document.querySelector('meta[name="csrf-token"]')?.content;

                    fetch(@json(route('site.page-views.duration', $pageViewId)), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token,
                        },
                        body: JSON.stringify({ seconds }),
                        keepalive: true,
                    }).catch(() => {});
                };

                document.addEventListener('visibilitychange', () => {
                    if (document.visibilityState === 'hidden') {
                        send();
                    }
                });
                window.addEventListener('pagehide', send);
            })();
        </script>
    @endisset
    @stack('scripts')
    @livewireScripts
    <script src="{{ Asset::versioned('frontend/js/site.js') }}" defer></script>
</body>
</html>
