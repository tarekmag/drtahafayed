@props(['review'])

@use('App\Support\Content')
@use('App\Support\LocaleText')

@php
    $rating = max(0, min(5, (int) ($review['rating'] ?? 5)));
    $service = ! empty($review['service']) ? Content::service($review['service']) : null;
    $name = LocaleText::get($review['name'] ?? '');
@endphp

<figure {{ $attributes->class(['review-card']) }}>
    <div class="review-top">
        <span class="review-quote"><x-icon name="quote" /></span>
        <span class="stars" role="img" aria-label="{{ __('site.common.rating', ['count' => $rating]) }}">
            @for ($i = 1; $i <= 5; $i++)
                <x-icon name="star" @class(['is-off' => $i > $rating]) />
            @endfor
        </span>
    </div>
    <blockquote>
        <p>{{ LocaleText::get($review['text'] ?? '') }}</p>
    </blockquote>
    <figcaption>
        <span class="review-avatar" aria-hidden="true">{{ mb_substr($name, 0, 1) }}</span>
        <span class="review-person">
            <strong>{{ $name }}</strong>
            <span>{{ LocaleText::get($review['place'] ?? '') }}</span>
        </span>
        @if ($service)
            <span class="chip">{{ LocaleText::get($service['title']) }}</span>
        @endif
    </figcaption>
</figure>
