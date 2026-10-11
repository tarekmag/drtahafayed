@php
    $name = \App\Support\LocaleText::get($clinic['name'] ?? '');
    $address = \App\Support\LocaleText::get($clinic['address'] ?? '');
    $phone = trim((string) ($clinic['phone'] ?? ''));
    $phoneHref = $phone !== '' ? 'tel:'.preg_replace('/\s+/', '', $phone) : null;

    $mapRaw = trim((string) ($clinic['map'] ?? ''));
    if ($mapRaw === '') {
        $mapRaw = $address;
    }

    $mapLink = null;
    $mapSrc = null;
    if (preg_match('#^https?://#i', $mapRaw)) {
        $mapLink = $mapRaw;
        $mapSrc = $mapRaw;
    } elseif ($mapRaw !== '') {
        $encoded = rawurlencode($mapRaw);
        $mapSrc = 'https://maps.google.com/maps?q='.$encoded.'&z=15&output=embed';
        $mapLink = 'https://www.google.com/maps/search/?api=1&query='.$encoded;
    }

    $photos = array_values(array_filter(array_map(
        fn ($photo) => \App\Support\MediaEmbed::image(is_string($photo) ? $photo : ''),
        $clinic['photos'] ?? []
    )));
@endphp

<article class="branch" @if (! empty($branchId)) id="{{ $branchId }}" @endif>
    @if ($name !== '')
        <h2>{{ $name }}</h2>
    @endif

    @if ($address !== '' || $phoneHref || $mapLink)
        <ul class="branch-facts">
            @if ($address !== '')
                <li>{{ $address }}</li>
            @endif
            @if ($phoneHref)
                <li><a href="{{ $phoneHref }}">{{ $phone }}</a></li>
            @endif
            @if ($mapLink)
                <li><a href="{{ $mapLink }}" target="_blank" rel="noopener noreferrer">{{ __('site.contact.map_link') }}</a></li>
            @endif
        </ul>
    @endif

    @if ($mapSrc)
        <div class="branch-map">
            <iframe
                title="{{ $name !== '' ? $name : __('site.contact.map_label') }}"
                src="{{ $mapSrc }}"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    @endif

    @if ($photos !== [])
        <div class="branch-photos" aria-label="{{ __('site.contact.photos_label') }}">
            @foreach ($photos as $photo)
                <img src="{{ $photo }}" alt="{{ $name !== '' ? $name : __('site.contact.photos_label') }}" loading="lazy">
            @endforeach
        </div>
    @endif
</article>
