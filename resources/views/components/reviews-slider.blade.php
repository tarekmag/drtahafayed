@use('App\Support\Content')

@php
    $reviews = Content::reviews();
@endphp

@if ($reviews->isNotEmpty())
    <x-swiper-assets />
    <div {{ $attributes->class(['reviews-slider', 'reveal']) }}>
        <div class="swiper" data-swiper="reviews">
            <div class="swiper-wrapper">
                @foreach ($reviews as $review)
                    <div class="swiper-slide">
                        <x-review-card :review="$review" />
                    </div>
                @endforeach
            </div>
        </div>
        <div class="slider-controls">
            <button class="slider-btn slider-prev" type="button" aria-label="{{ __('site.common.prev') }}"><x-icon name="arrow" /></button>
            <div class="slider-pagination"></div>
            <button class="slider-btn slider-next" type="button" aria-label="{{ __('site.common.next') }}"><x-icon name="arrow" /></button>
        </div>
    </div>
@else
    <div class="empty-panel">
        <x-icon name="chat" />
        <p>{{ __('site.common.empty') }}</p>
    </div>
@endif
