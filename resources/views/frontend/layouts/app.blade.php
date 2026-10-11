@php
    $locale = app()->getLocale();
    $direction = $locale === 'ar' ? 'rtl' : 'ltr';
    $otherLocale = $locale === 'ar' ? 'en' : 'ar';
    $currentRoute = Route::current();
    $routeParameters = array_intersect_key(
        $currentRoute->originalParameters(),
        array_flip($currentRoute->parameterNames())
    );
    $switchUrl = route($currentRoute->getName(), array_merge($routeParameters, ['locale' => $otherLocale]));
    $alternateAr = route($currentRoute->getName(), array_merge($routeParameters, ['locale' => 'ar']));
    $alternateEn = route($currentRoute->getName(), array_merge($routeParameters, ['locale' => 'en']));
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $direction }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('meta_title', __('site.brand.name'))</title>
    <meta name="description" content="@yield('meta_description', __('site.brand.description'))">
    <meta name="theme-color" content="#14343C">
    <link rel="alternate" hreflang="ar" href="{{ $alternateAr }}">
    <link rel="alternate" hreflang="en" href="{{ $alternateEn }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <script>document.documentElement.classList.add('js');</script>
    <link rel="stylesheet" href="{{ asset('frontend/css/site.css') }}?v={{ filemtime(public_path('frontend/css/site.css')) }}">
</head>
<body>
    <a class="skip-link" href="#content">{{ __('site.common.skip') }}</a>

    @include('frontend.partials.header', ['switchUrl' => $switchUrl])

    <main id="content">
        @yield('content')
    </main>

    @include('frontend.partials.footer')

    @if (config('clinic.whatsapp'))
        <a class="whatsapp-float" href="https://wa.me/{{ config('clinic.whatsapp') }}" target="_blank" rel="noopener noreferrer">
            {{ __('site.common.whatsapp') }}
        </a>
    @endif

    <div class="lightbox" data-lightbox-root hidden>
        <button class="lightbox-backdrop" type="button" data-lightbox-close aria-label="{{ __('site.photos.close') }}"></button>
        <figure class="lightbox-figure">
            <img src="" alt="" data-lightbox-image>
            <figcaption data-lightbox-caption></figcaption>
        </figure>
        <button class="lightbox-nav lightbox-prev" type="button" data-lightbox-prev aria-label="{{ __('site.photos.prev') }}">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14.5 6.5 9 12l5.5 5.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <button class="lightbox-nav lightbox-next" type="button" data-lightbox-next aria-label="{{ __('site.photos.next') }}">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9.5 6.5 15 12l-5.5 5.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <button class="lightbox-close" type="button" data-lightbox-close aria-label="{{ __('site.photos.close') }}">
            <span aria-hidden="true"></span>
        </button>
    </div>

    <script src="{{ asset('frontend/js/site.js') }}?v={{ filemtime(public_path('frontend/js/site.js')) }}" defer></script>
</body>
</html>
