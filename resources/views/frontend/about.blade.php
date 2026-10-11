@use('App\Support\Content')
@use('App\Support\LocaleText')

@php
    $doctor = Content::doctor();
@endphp

@extends('frontend.layouts.app')

@section('meta_title', \App\Support\Content::seo('about')['title'])
@section('meta_description', \App\Support\Content::seo('about')['description'])

@section('content')
    <x-page-hero
        :eyebrow="__('site.about.eyebrow')"
        :title="LocaleText::get($doctor['name'] ?? __('site.brand.name'))"
        :lede="__('site.about.lede')"
        :crumbs="[__('site.nav.about') => null]"
    />

    <section class="section">
        <div class="container split">
            <div class="split-media reveal">
                <x-picture :src="$doctor['portrait'] ?? 'assets/images/dr-2.jpeg'" :alt="__('site.about.portrait_alt')" sizes="(min-width: 860px) 42vw, 100vw" />
            </div>
            <div class="rich-text reveal">
                {!! LocaleText::get($doctor['bio'] ?? '') !!}
            </div>
        </div>
    </section>

    <section class="section section-sand">
        <div class="container">
            <x-section-head :title="__('site.about.credentials_title')" />
            <ul class="credentials">
                @foreach ($doctor['credentials'] ?? [] as $item)
                    <li class="reveal" style="--i: {{ $loop->index }}"><x-icon name="check" /> <span>{{ LocaleText::get($item) }}</span></li>
                @endforeach
            </ul>
            <x-stats />
        </div>
    </section>

    <section class="section">
        <div class="container">
            <x-section-head
                :eyebrow="__('site.about.pillars_eyebrow')"
                :title="__('site.about.pillars_title')"
            />
            <div class="pillars">
                @foreach (__('site.home.specialties') as $item)
                    <article class="pillar-card reveal" style="--i: {{ $loop->index }}">
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
                :eyebrow="__('site.about.values_eyebrow')"
                :title="__('site.about.values_title')"
            />
            <div class="values">
                @foreach (__('site.about.values') as $value)
                    <article class="value-card reveal" style="--i: {{ $loop->index }}">
                        <span class="specialty-icon"><x-icon :name="$value['icon']" /></span>
                        <h3>{{ $value['title'] }}</h3>
                        <p>{{ $value['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-band />
@endsection
