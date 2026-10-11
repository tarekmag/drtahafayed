@props(['clinic'])

@use('App\Support\LocaleText')
@use('App\Support\MediaEmbed')

@php
    $address = LocaleText::get($clinic['address'] ?? '');
    $hours = LocaleText::get($clinic['hours'] ?? '');
    $phone = trim((string) ($clinic['phone'] ?? ''));
    $map = MediaEmbed::map(($clinic['map'] ?? '') ?: $address);
@endphp

<ul {{ $attributes->class(['clinic-facts']) }}>
    @if ($address !== '')
        <li>
            <span class="clinic-fact-icon"><x-icon name="map-pin" /></span>
            <span><small>{{ __('site.clinics.address') }}</small>{{ $address }}</span>
        </li>
    @endif
    @if ($hours !== '')
        <li>
            <span class="clinic-fact-icon"><x-icon name="clock" /></span>
            <span><small>{{ __('site.clinics.hours') }}</small>{{ $hours }}</span>
        </li>
    @endif
    @if ($phone !== '')
        <li>
            <span class="clinic-fact-icon"><x-icon name="phone" /></span>
            <span><small>{{ __('site.clinics.phone') }}</small><a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" dir="ltr">{{ $phone }}</a></span>
        </li>
    @endif
</ul>

@if ($map || $phone !== '')
    <div class="clinic-actions">
        @if ($phone !== '')
            <x-button :href="'tel:'.preg_replace('/\s+/', '', $phone)" variant="primary" icon="phone">{{ __('site.clinics.call_branch') }}</x-button>
        @endif
        @if ($map)
            <x-button :href="$map['link']" variant="outline" icon="map-pin" external>{{ __('site.clinics.map_link') }}</x-button>
        @endif
    </div>
@endif
