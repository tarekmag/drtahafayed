@php
    $title = \App\Support\LocaleText::get($service['title'] ?? '');
    $excerpt = \App\Support\LocaleText::get($service['excerpt'] ?? '');
    $body = \App\Support\LocaleText::get($service['body'] ?? '');
    $image = \App\Support\MediaEmbed::image($service['image'] ?? '');
    $video = \App\Support\MediaEmbed::video($service['video'] ?? '');
@endphp

@extends('frontend.layouts.app')

@section('meta_title', $title.' | '.__('site.brand.name'))
@section('meta_description', $excerpt)

@section('content')
    <article class="section">
        <div class="container service-detail">
            <p class="service-back">
                <a class="text-link" href="{{ route('site.services') }}">{{ __('site.services.back') }}</a>
            </p>

            @if ($image)
                <img class="service-cover" src="{{ $image }}" alt="{{ $title }}" width="800" height="500">
            @endif

            <header class="service-heading">
                <h1>{{ $title }}</h1>
                @if ($excerpt !== '')
                    <p class="lede">{{ $excerpt }}</p>
                @endif
            </header>

            <div class="service-explain">
                <div class="service-video">
                    @if ($video && $video['type'] === 'file')
                        <video class="service-player" controls playsinline preload="metadata" src="{{ $video['src'] }}"></video>
                    @elseif ($video)
                        <iframe class="service-player" src="{{ $video['src'] }}" title="{{ $title }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    @else
                        <div class="service-video-empty">
                            <span class="play-mark" aria-hidden="true"></span>
                            <p>{{ __('site.services.video_pending') }}</p>
                        </div>
                    @endif
                </div>

                @if ($body !== '')
                    <div class="rich-text">
                        {!! $body !!}
                    </div>
                @endif
            </div>
        </div>
    </article>
@endsection
