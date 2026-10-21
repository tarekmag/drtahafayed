@use('App\Support\Asset')
@use('App\Support\Content')

@php
    $contact = Content::contact();
    $phone = Content::phoneUrl();
    $secondaryPhone = Content::secondaryPhoneUrl();
    $email = $contact['email'];
@endphp

<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            <a class="brand" href="{{ route('site.home') }}">
                <picture>
                    <source type="image/webp" srcset="{{ Asset::versioned('assets/images/logo-240.webp') }}">
                    <img src="{{ Asset::versioned('assets/images/logo.png') }}" alt="{{ __('site.brand.logo_alt') }}" width="239" height="240" loading="lazy" decoding="async">
                </picture>
            </a>
            <p>{{ __('site.footer.tagline') }}</p>
            <x-social-links class="social-links-labeled" labels />
        </div>

        <nav class="footer-links" aria-label="{{ __('site.footer.links') }}">
            <p class="footer-label">{{ __('site.footer.links') }}</p>
            <a href="{{ route('site.home') }}">{{ __('site.nav.home') }}</a>
            <a href="{{ route('site.about') }}">{{ __('site.nav.about') }}</a>
            <a href="{{ route('site.services') }}">{{ __('site.nav.services') }}</a>
            <a href="{{ route('site.articles') }}">{{ __('site.nav.articles') }}</a>
            <a href="{{ route('site.photos') }}">{{ __('site.nav.photos') }}</a>
            <a href="{{ route('site.videos') }}">{{ __('site.nav.videos') }}</a>
            <a href="{{ route('site.review') }}">{{ __('site.nav.review') }}</a>
            <a href="{{ route('site.contact') }}">{{ __('site.nav.contact') }}</a>
        </nav>

        <nav class="footer-branches" aria-label="{{ __('site.footer.branches') }}">
            <p class="footer-label">{{ __('site.footer.branches') }}</p>
            @forelse (Content::clinics() as $place)
                <a href="{{ route('site.clinics') }}#{{ $place['id'] ?? 'clinic-'.$loop->index }}">{{ \App\Support\LocaleText::get($place['name'] ?? '') }}</a>
            @empty
                <a href="{{ route('site.clinics') }}">{{ __('site.nav.clinics') }}</a>
            @endforelse
        </nav>

        <div class="footer-contact">
            <p class="footer-label">{{ __('site.footer.contact') }}</p>
            @if ($phone)
                <a href="{{ $phone }}" dir="ltr">{{ $contact['phone'] }}</a>
            @endif
            @if ($secondaryPhone)
                <a href="{{ $secondaryPhone }}" dir="ltr">{{ $contact['phone_secondary'] }}</a>
            @endif
            @if ($email)
                <a href="mailto:{{ $email }}">{{ $email }}</a>
            @endif
            <a href="{{ Content::bookingUrl() }}">{{ __('site.nav.book') }}</a>
        </div>
    </div>

    <div class="container footer-base">
        <p class="disclaimer">{{ __('site.footer.disclaimer') }}</p>
        <p class="rights">© {{ date('Y') }} {{ __('site.brand.name') }}. {{ __('site.footer.rights') }}</p>
    </div>
</footer>
