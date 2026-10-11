@php
    $locale = app()->getLocale();
    $text = function ($value) use ($locale) {
        if (is_array($value)) {
            return $value[$locale] ?? $value['ar'] ?? $value['en'] ?? '';
        }

        return trim((string) $value);
    };

    $reviews = config('reviews.items', []);
@endphp

@if (! empty($reviews))
    <div class="review-grid">
        @foreach ($reviews as $review)
            <blockquote class="review-card reveal" style="--delay: {{ $loop->index * 70 }}ms">
                <p>{{ $text($review['text'] ?? '') }}</p>
                <footer>
                    @if ($text($review['name'] ?? '') !== '')
                        <strong>{{ $text($review['name'] ?? '') }}</strong>
                    @endif
                    @if ($text($review['place'] ?? '') !== '')
                        <span>{{ $text($review['place'] ?? '') }}</span>
                    @endif
                </footer>
            </blockquote>
        @endforeach
    </div>
@else
    <article class="empty-panel">
        <p>{{ __('site.about.reviews_text') }}</p>
        <span class="soon">{{ __('site.common.coming_soon') }}</span>
    </article>
@endif
