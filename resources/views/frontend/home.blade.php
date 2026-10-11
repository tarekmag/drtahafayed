@extends('frontend.layouts.app')

@section('meta_title', __('site.home.meta_title'))
@section('meta_description', __('site.home.meta_description'))

@section('content')
    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-copy">
                <p class="eyebrow">{{ __('site.brand.specialty') }}</p>
                <h1>{{ __('site.brand.name') }}</h1>
                <p class="lede">{{ __('site.home.lede') }}</p>
                <div class="hero-actions">
                    <a class="btn btn-accent" href="{{ route('site.contact') }}">{{ __('site.nav.book') }}</a>
                    <a class="btn btn-ghost" href="{{ route('site.about') }}">{{ __('site.nav.about') }}</a>
                </div>
            </div>
            <div class="hero-media">
                <img src="{{ asset('assets/images/dr-1.jpeg') }}" alt="{{ __('site.photos.alt.dr1') }}" fetchpriority="high">
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head reveal">
                <p class="eyebrow">{{ __('site.home.services_eyebrow') }}</p>
                <h2>{{ __('site.home.services_title') }}</h2>
                <p>{{ __('site.home.services_text') }}</p>
            </div>
            <div class="services-grid">
                @foreach (config('medical_services.items') as $service)
                    @include('frontend.partials.service-card', ['service' => $service, 'index' => $loop->index])
                @endforeach
            </div>
            <p class="section-more">
                <a class="text-link" href="{{ route('site.services') }}">{{ __('site.common.all_services') }}</a>
            </p>
        </div>
    </section>

    <section class="section section-sand">
        <div class="container split">
            <div class="split-media reveal">
                <img src="{{ asset('assets/images/dr-2.jpeg') }}" alt="{{ __('site.about.portrait_alt') }}" loading="lazy">
            </div>
            <div class="split-copy reveal" style="--delay: 80ms">
                <p class="eyebrow">{{ __('site.home.about_eyebrow') }}</p>
                <h2>{{ __('site.home.about_title') }}</h2>
                <p>{{ __('site.home.about_text') }}</p>
                <a class="btn btn-accent" href="{{ route('site.about') }}">{{ __('site.home.about_cta') }}</a>
            </div>
        </div>
    </section>

    <section class="band">
        <div class="container band-row reveal">
            <div>
                <p class="eyebrow eyebrow-light">{{ __('site.home.visit_eyebrow') }}</p>
                <h2>{{ __('site.home.visit_title') }}</h2>
                <p>{{ __('site.home.visit_text') }}</p>
            </div>
            <div class="band-actions">
                <a class="btn btn-light" href="{{ route('site.contact') }}">{{ __('site.nav.contact') }}</a>
                @include('frontend.partials.social-links', ['linkClass' => 'btn btn-line'])
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head reveal">
                <p class="eyebrow">{{ __('site.home.articles_eyebrow') }}</p>
                <h2>{{ __('site.home.articles_title') }}</h2>
                <p>{{ __('site.home.articles_text') }}</p>
            </div>
            <div class="article-grid">
                @foreach (__('site.articles.items') as $article)
                    @include('frontend.partials.article-card', ['article' => $article, 'index' => $loop->index])
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section-sand" id="reviews">
        <div class="container">
            <div class="section-head reveal">
                <p class="eyebrow">{{ __('site.home.reviews_eyebrow') }}</p>
                <h2>{{ __('site.home.reviews_title') }}</h2>
                <p>{{ __('site.home.reviews_text') }}</p>
            </div>
            @include('frontend.partials.reviews')
        </div>
    </section>

    <section class="section" id="clinics">
        <div class="container">
            <div class="section-head reveal">
                <p class="eyebrow">{{ __('site.contact.clinics_eyebrow') }}</p>
                <h2>{{ __('site.contact.clinics_title') }}</h2>
                <p>{{ __('site.contact.clinics_text') }}</p>
            </div>
            @include('frontend.partials.clinics')
            <p class="section-more">
                <a class="text-link" href="{{ route('site.clinics') }}">{{ __('site.nav.clinics') }}</a>
            </p>
        </div>
    </section>

    <section class="section section-tight">
        <div class="container">
            <div class="section-head reveal">
                <p class="eyebrow">{{ __('site.home.gallery_eyebrow') }}</p>
                <h2>{{ __('site.home.gallery_title') }}</h2>
                <p>{{ __('site.home.gallery_text') }}</p>
            </div>
            @include('frontend.partials.photos')
            <p class="section-more">
                <a class="text-link" href="{{ route('site.photos') }}">{{ __('site.common.all_photos') }}</a>
            </p>
        </div>
    </section>
@endsection
