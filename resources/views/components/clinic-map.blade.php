@props(['clinic'])

@use('App\Support\LocaleText')
@use('App\Support\MediaEmbed')

@php
    $name = LocaleText::get($clinic['name'] ?? '');
    $map = MediaEmbed::map(($clinic['map'] ?? '') ?: LocaleText::get($clinic['address'] ?? ''));
@endphp

@if ($map)
    <div {{ $attributes->class(['clinic-map']) }}>
        <iframe
            title="{{ __('site.clinics.map_label', ['name' => $name]) }}"
            src="{{ $map['src'] }}"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </div>
@endif
