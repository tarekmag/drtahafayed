@use('App\Support\Asset')

@once
    @push('styles')
        <link rel="stylesheet" href="{{ Asset::versioned('frontend/vendor/swiper/swiper-bundle.min.css') }}">
    @endpush
    @push('scripts')
        <script src="{{ Asset::versioned('frontend/vendor/swiper/swiper-bundle.min.js') }}" defer></script>
    @endpush
@endonce
