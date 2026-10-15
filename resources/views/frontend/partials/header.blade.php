@use('App\Support\Asset')
@use('App\Support\Content')

@php
    $contact = Content::contact();
    $phone = Content::phoneUrl();
    $secondaryPhone = Content::secondaryPhoneUrl();
@endphp

<header class="site-header" data-header>
    <div class="topbar">
        <div class="container topbar-row">
            <p class="topbar-note">{{ __('site.brand.specialty') }}</p>
            <div class="topbar-actions">
                @if ($phone)
                    <a href="{{ $phone }}" dir="ltr">{{ $contact['phone'] }}</a>
                @endif
                @if ($secondaryPhone)
                    <a href="{{ $secondaryPhone }}" dir="ltr">{{ $contact['phone_secondary'] }}</a>
                @endif
                <x-social-links />
                <a class="lang-switch" href="{{ $switchUrl }}">{{ __('site.nav.switch') }}</a>
            </div>
        </div>
    </div>

    <div class="nav-bar">
        <div class="container nav-row">
            <a class="brand" href="{{ route('site.home') }}">
                <img src="{{ Asset::versioned('assets/images/logo.png') }}" alt="{{ __('site.brand.logo_alt') }}">
            </a>

            <button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="site-nav">
                <span class="sr-only">{{ __('site.nav.menu') }}</span>
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="site-nav" id="site-nav" data-nav aria-label="{{ __('site.nav.main') }}">
                <a class="nav-link {{ request()->routeIs('site.home') ? 'is-active' : '' }}" href="{{ route('site.home') }}" @if (request()->routeIs('site.home')) aria-current="page" @endif>{{ __('site.nav.home') }}</a>
                <a class="nav-link {{ request()->routeIs('site.about') ? 'is-active' : '' }}" href="{{ route('site.about') }}" @if (request()->routeIs('site.about')) aria-current="page" @endif>{{ __('site.nav.about') }}</a>
                <a class="nav-link {{ request()->routeIs('site.services', 'site.service') ? 'is-active' : '' }}" href="{{ route('site.services') }}" @if (request()->routeIs('site.services', 'site.service')) aria-current="page" @endif>{{ __('site.nav.services') }}</a>
                <a class="nav-link {{ request()->routeIs('site.clinics') ? 'is-active' : '' }}" href="{{ route('site.clinics') }}" @if (request()->routeIs('site.clinics')) aria-current="page" @endif>{{ __('site.nav.clinics') }}</a>
                <a class="nav-link {{ request()->routeIs('site.articles', 'site.article') ? 'is-active' : '' }}" href="{{ route('site.articles') }}" @if (request()->routeIs('site.articles', 'site.article')) aria-current="page" @endif>{{ __('site.nav.articles') }}</a>

                <div class="nav-drop">
                    <button class="nav-link nav-drop-btn" type="button" aria-expanded="false" data-drop-toggle>
                        {{ __('site.nav.media') }}
                        <x-icon name="chevron-down" />
                    </button>
                    <div class="nav-drop-menu">
                        <a class="{{ request()->routeIs('site.photos') ? 'is-active' : '' }}" href="{{ route('site.photos') }}" @if (request()->routeIs('site.photos')) aria-current="page" @endif>{{ __('site.nav.photos') }}</a>
                        <a class="{{ request()->routeIs('site.videos') ? 'is-active' : '' }}" href="{{ route('site.videos') }}" @if (request()->routeIs('site.videos')) aria-current="page" @endif>{{ __('site.nav.videos') }}</a>
                    </div>
                </div>

                <a class="nav-link {{ request()->routeIs('site.contact') ? 'is-active' : '' }}" href="{{ route('site.contact') }}" @if (request()->routeIs('site.contact')) aria-current="page" @endif>{{ __('site.nav.contact') }}</a>
                <x-button class="nav-cta" :href="Content::bookingUrl()" variant="gold" icon="calendar">{{ __('site.nav.book') }}</x-button>
            </nav>
        </div>
    </div>
</header>
