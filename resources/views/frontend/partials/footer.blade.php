@php
    $clinic = config('clinic');
    $phoneHref = $clinic['phone'] ? 'tel:'.preg_replace('/\s+/', '', $clinic['phone']) : null;
@endphp
<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            <a class="brand" href="{{ route('site.home') }}">
                <img src="{{ asset('assets/images/logo.png') }}?v={{ filemtime(public_path('assets/images/logo.png')) }}" alt="{{ __('site.brand.logo_alt') }}">
            </a>
            <p>{{ __('site.brand.specialty') }}</p>
        </div>

        <nav class="footer-links" aria-label="{{ __('site.nav.home') }}">
            <a href="{{ route('site.home') }}">{{ __('site.nav.home') }}</a>
            <a href="{{ route('site.about') }}">{{ __('site.nav.about') }}</a>
            <a href="{{ route('site.services') }}">{{ __('site.nav.services') }}</a>
            <a href="{{ route('site.clinics') }}">{{ __('site.nav.clinics') }}</a>
            <a href="{{ route('site.articles') }}">{{ __('site.nav.articles') }}</a>
            <a href="{{ route('site.photos') }}">{{ __('site.nav.photos') }}</a>
            <a href="{{ route('site.videos') }}">{{ __('site.nav.videos') }}</a>
            <a href="{{ route('site.contact') }}">{{ __('site.nav.contact') }}</a>
        </nav>

        <nav class="footer-branches" aria-label="{{ __('site.footer.branches') }}">
            <p class="footer-label">{{ __('site.footer.branches') }}</p>
            @forelse ($clinic['clinics'] as $place)
                @php
                    $branchName = \App\Support\LocaleText::get($place['name'] ?? '');
                    $branchId = $place['id'] ?? 'branch-'.$loop->index;
                @endphp
                <a href="{{ route('site.clinics') }}#{{ $branchId }}">{{ $branchName !== '' ? $branchName : __('site.nav.clinics') }}</a>
            @empty
                <a href="{{ route('site.clinics') }}">{{ __('site.nav.clinics') }}</a>
            @endforelse
        </nav>

        <div class="footer-contact">
            @if ($phoneHref)
                <a href="{{ $phoneHref }}">{{ $clinic['phone'] }}</a>
            @endif
            @if ($clinic['email'])
                <a href="mailto:{{ $clinic['email'] }}">{{ $clinic['email'] }}</a>
            @endif
            @include('frontend.partials.social-links')
        </div>
    </div>

    <div class="container footer-base">
        <p class="disclaimer">{{ __('site.footer.disclaimer') }}</p>
        <p class="rights">© {{ date('Y') }} {{ __('site.brand.name') }}. {{ __('site.footer.rights') }}</p>
    </div>
</footer>
