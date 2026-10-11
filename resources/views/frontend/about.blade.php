@extends('frontend.layouts.app')

@section('meta_title', __('site.about.meta_title'))
@section('meta_description', __('site.about.meta_description'))

@section('content')
    <header class="page-hero">
        <div class="container">
            <p class="eyebrow">{{ __('site.about.eyebrow') }}</p>
            <h1>{{ __('site.about.title') }}</h1>
            <p class="lede">{{ __('site.about.lede') }}</p>
        </div>
    </header>

    <section class="section">
        <div class="container split">
            <div class="split-media reveal">
                <img src="{{ asset('assets/images/dr-2.jpeg') }}" alt="{{ __('site.about.portrait_alt') }}">
            </div>
            <div class="split-copy reveal" style="--delay: 80ms">
                @foreach (__('site.about.intro') as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
                <a class="btn btn-accent" href="{{ route('site.contact') }}">{{ __('site.nav.book') }}</a>
            </div>
        </div>
    </section>

    <section class="section section-sand">
        <div class="container">
            <div class="section-head reveal">
                <h2>{{ __('site.about.pillars_title') }}</h2>
            </div>
            <div class="services-grid services-grid-3">
                @foreach (__('site.about.pillars') as $pillar)
                    <article class="plain-card reveal" style="--delay: {{ $loop->index * 70 }}ms">
                        <h3>{{ $pillar['title'] }}</h3>
                        <p>{{ $pillar['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container empty-grid">
            <article class="empty-panel reveal">
                <h2>{{ __('site.about.awards_title') }}</h2>
                <p>{{ __('site.about.awards_text') }}</p>
                <span class="soon">{{ __('site.common.coming_soon') }}</span>
            </article>
            <article class="empty-panel reveal" style="--delay: 80ms">
                <h2>{{ __('site.about.reviews_title') }}</h2>
                @if (empty(config('reviews.items')))
                    <p>{{ __('site.about.reviews_text') }}</p>
                    <span class="soon">{{ __('site.common.coming_soon') }}</span>
                @else
                    <p>{{ __('site.home.reviews_text') }}</p>
                    <a class="text-link" href="{{ route('site.home') }}#reviews">{{ __('site.home.reviews_title') }}</a>
                @endif
            </article>
        </div>
    </section>
@endsection
