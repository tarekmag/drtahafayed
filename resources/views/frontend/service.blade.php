@use('App\Support\Content')
@use('App\Support\LocaleText')
@use('App\Support\MediaEmbed')

@php
    $title = LocaleText::get($service['title'] ?? '');
    $excerpt = LocaleText::get($service['excerpt'] ?? '');
    $body = LocaleText::get($service['body'] ?? '');
    $image = MediaEmbed::image($service['image'] ?? '');
    $video = MediaEmbed::video($service['video'] ?? '');
    $faqs = $service['faqs'] ?? [];
    $whatsapp = Content::whatsappUrl(__('site.contact.wa_intro').' — '.$title);
@endphp

@extends('frontend.layouts.app')

@section('meta_title', $title.' | '.__('site.brand.name'))
@section('meta_description', $excerpt)

@section('content')
    <x-page-hero
        :eyebrow="__('site.nav.services')"
        :title="$title"
        :lede="$excerpt"
        :crumbs="[__('site.nav.services') => route('site.services'), $title => null]"
    />

    <article class="section">
        <div class="container service-layout">
            <div>
                @if ($image)
                    <img class="service-cover" src="{{ $image }}" alt="{{ $title }}" style="width:100%;border-radius:1.2rem;margin-bottom:1.4rem">
                @endif

                @if ($body !== '')
                    <div class="rich-text">
                        {!! $body !!}
                    </div>
                @endif

                @if (! empty($service['conditions']))
                    <div class="service-conditions-block">
                        <h2>{{ __('site.services.conditions_title') }}</h2>
                        <ul class="condition-list">
                            @foreach ($service['conditions'] as $condition)
                                <li>{{ LocaleText::get($condition) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="media-frame" style="margin-top:2rem">
                    @if ($video && $video['type'] === 'file')
                        <video controls playsinline preload="metadata" src="{{ $video['src'] }}"></video>
                    @elseif ($video)
                        <iframe src="{{ $video['src'] }}" title="{{ $title }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    @else
                        <div class="empty-panel" style="height:100%;border:0;background:transparent;color:white">
                            <p>{{ __('site.services.video_pending') }}</p>
                        </div>
                    @endif
                </div>

                @if ($faqs)
                    <div style="margin-top:2.4rem">
                        <h2>{{ __('site.services.faq_title') }}</h2>
                        <x-faq-list :items="$faqs" group="service-faq" />
                    </div>
                @endif
            </div>

            <aside class="booking-card">
                <h2>{{ __('site.services.booking_title') }}</h2>
                <p>{{ __('site.services.booking_text') }}</p>
                <div class="clinic-actions">
                    <x-button :href="Content::bookingUrl()" variant="gold" icon="calendar">{{ __('site.nav.book') }}</x-button>
                    @if ($whatsapp)
                        <x-button :href="$whatsapp" variant="outline" icon="whatsapp" external>{{ __('site.common.whatsapp') }}</x-button>
                    @endif
                </div>
            </aside>
        </div>
    </article>

    @if ($related->isNotEmpty())
        <section class="section section-sand">
            <div class="container">
                <x-section-head :title="__('site.common.related_services')" />
                <div class="services-grid">
                    @foreach ($related as $item)
                        <x-service-card :service="$item" :index="$loop->index" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
