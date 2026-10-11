@props(['labels' => false])

@use('App\Support\Content')

@php
    $socials = Content::socials();
@endphp

@if ($socials)
    <div {{ $attributes->class(['social-links', 'social-links-labeled' => $labels]) }}>
        @foreach ($socials as $network => $url)
            <a class="social-link" href="{{ $url }}" target="_blank" rel="noopener noreferrer" @unless ($labels) aria-label="{{ __('site.nav.'.$network) }}" @endunless>
                <span class="social-icon"><x-icon :name="$network" /></span>
                @if ($labels)
                    <span>{{ __('site.nav.'.$network) }}</span>
                @endif
            </a>
        @endforeach
    </div>
@endif
