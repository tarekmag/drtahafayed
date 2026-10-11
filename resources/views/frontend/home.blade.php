@use('App\Support\Content')
@use('App\Support\LocaleText')

@php
    $doctor = Content::doctor();
    $next = Content::nextClinic();
    $services = Content::services();
    $articles = Content::articles()->take(3);
    $photos = Content::gallery()->take(6);
    $faqs = Content::faqs();
    $nextLabel = null;

    if ($next) {
        $date = $next['date'];
        $nextLabel = $date->isToday()
            ? __('site.home.today')
            : ($date->isTomorrow() ? __('site.home.tomorrow') : $date->locale(app()->getLocale())->translatedFormat('l'));
    }
@endphp

@extends('frontend.layouts.app')

@section('meta_title', __('site.home.meta_title'))
@section('meta_description', __('site.home.meta_description'))

@section('content')
    <section class="hero">
        <div class="hero-media">
            <x-picture :src="$doctor['hero_image'] ?? 'assets/images/dr-1.jpeg'" :alt="__('site.about.portrait_alt')" sizes="100vw" priority />
        </div>
        <div class="container hero-grid">
            <div class="hero-copy">
                <p class="eyebrow eyebrow-light">{{ LocaleText::get($doctor['title'] ?? __('site.brand.specialty')) }}</p>
                <h1>{{ LocaleText::get($doctor['name'] ?? __('site.brand.name')) }}</h1>
                <p class="lede">{{ __('site.home.hero_lede') }}</p>
                <div class="hero-actions">
                    <x-button :href="Content::bookingUrl()" variant="gold" icon="calendar">{{ __('site.nav.book') }}</x-button>
                    <x-button :href="route('site.services')" variant="light-outline">{{ __('site.home.hero_services') }}</x-button>
                </div>
                <a class="scroll-hint" href="#specialties">{{ __('site.common.scroll') }} <x-icon name="chevron-down" /></a>
            </div>
            @if ($next)
                <aside class="hero-card reveal">
                    <small>{{ __('site.home.next_label') }}</small>
                    <strong>{{ LocaleText::get($next['clinic']['name'] ?? '') }}</strong>
                    <p>{{ $nextLabel }} · {{ LocaleText::get($next['clinic']['hours'] ?? '') }}</p>
                </aside>
            @endif
        </div>
    </section>

    <section class="section" id="specialties">
        <div class="container">
            <div class="specialties">
                @foreach (__('site.home.specialties') as $item)
                    <article class="specialty reveal" style="--i: {{ $loop->index }}">
                        <span class="specialty-icon"><x-icon :name="$item['icon']" /></span>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section-sand">
        <div class="container">
            <x-section-head
                :eyebrow="__('site.home.services_eyebrow')"
                :title="__('site.home.services_title')"
                :text="__('site.home.services_text')"
            >
                <x-slot:actions>
                    <x-button :href="route('site.services')" variant="outline">{{ __('site.common.all_services') }}</x-button>
                </x-slot:actions>
            </x-section-head>
            <div class="services-grid">
                @foreach ($services as $service)
                    <x-service-card :service="$service" :featured="$loop->first" :index="$loop->index" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <x-section-head
                align="center"
                :eyebrow="__('site.home.journey_eyebrow')"
                :title="__('site.home.journey_title')"
                :text="__('site.home.journey_text')"
            />
            <div class="journey">
                @foreach (__('site.home.journey') as $step)
                    <article class="journey-step reveal" style="--i: {{ $loop->index }}">
                        <h3>{{ $step['title'] }}</h3>
                        <p>{{ $step['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section-sand">
        <div class="container split">
            <div class="split-media reveal">
                <x-picture :src="$doctor['portrait'] ?? 'assets/images/dr-2.jpeg'" :alt="__('site.about.portrait_alt')" sizes="(min-width: 860px) 42vw, 100vw" />
            </div>
            <div class="split-copy reveal" style="--i: 1">
                <p class="eyebrow">{{ __('site.home.about_eyebrow') }}</p>
                <h2>{{ __('site.home.about_title') }}</h2>
                <div class="rich-text">{!! LocaleText::get($doctor['summary'] ?? '') !!}</div>
                @if (! empty($doctor['credentials']))
                    <h3>{{ __('site.home.credentials_title') }}</h3>
                    <ul class="credentials">
                        @foreach (array_slice($doctor['credentials'], 0, 4) as $item)
                            <li><x-icon name="check" /> <span>{{ LocaleText::get($item) }}</span></li>
                        @endforeach
                    </ul>
                @endif
                <x-stats />
                <x-button :href="route('site.about')" variant="primary">{{ __('site.home.about_cta') }}</x-button>
            </div>
        </div>
    </section>

    <section class="section" id="clinics">
        <div class="container">
            <x-section-head
                :eyebrow="__('site.home.clinics_eyebrow')"
                :title="__('site.home.clinics_title')"
                :text="__('site.home.clinics_text')"
            >
                <x-slot:actions>
                    <x-button :href="route('site.clinics')" variant="outline">{{ __('site.nav.clinics') }}</x-button>
                </x-slot:actions>
            </x-section-head>
            <x-clinic-tabs />
        </div>
    </section>

    <section class="section section-sand" id="reviews">
        <div class="container">
            <x-section-head
                align="center"
                :eyebrow="__('site.home.reviews_eyebrow')"
                :title="__('site.home.reviews_title')"
                :text="__('site.home.reviews_text')"
            >
                <x-slot:actions>
                    <x-button :href="route('site.review')" variant="gold" icon="star">{{ __('site.nav.review') }}</x-button>
                    <x-button :href="config('clinic.vezeeta')" variant="outline" icon="vezeeta" external>{{ __('site.nav.vezeeta') }}</x-button>
                </x-slot:actions>
            </x-section-head>
            <x-reviews-slider />
        </div>
    </section>

    <section class="section">
        <div class="container">
            <x-section-head
                :eyebrow="__('site.home.articles_eyebrow')"
                :title="__('site.home.articles_title')"
                :text="__('site.home.articles_text')"
            >
                <x-slot:actions>
                    <x-button :href="route('site.articles')" variant="outline">{{ __('site.common.all_articles') }}</x-button>
                </x-slot:actions>
            </x-section-head>
            <div class="article-grid">
                @foreach ($articles as $article)
                    <x-article-card :article="$article" :index="$loop->index" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section-sand">
        <div class="container">
            <x-section-head
                :eyebrow="__('site.home.faq_eyebrow')"
                :title="__('site.home.faq_title')"
                :text="__('site.home.faq_text')"
            />
            <x-faq-list :items="$faqs" />
        </div>
    </section>

    @if ($photos->isNotEmpty())
        <section class="section section-tight">
            <div class="container">
                <x-section-head
                    :eyebrow="__('site.home.gallery_eyebrow')"
                    :title="__('site.home.gallery_title')"
                >
                    <x-slot:actions>
                        <x-button :href="route('site.photos')" variant="outline">{{ __('site.common.all_photos') }}</x-button>
                    </x-slot:actions>
                </x-section-head>
                <div class="photo-masonry">
                    @foreach ($photos as $photo)
                        <x-photo-card :photo="$photo" :index="$loop->index" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-cta-band />
@endsection
