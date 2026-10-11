@extends('frontend.layouts.app')

@section('meta_title', __('site.videos.meta_title'))
@section('meta_description', __('site.videos.meta_description'))

@section('content')
    <header class="page-hero">
        <div class="container">
            <p class="eyebrow">{{ __('site.videos.eyebrow') }}</p>
            <h1>{{ __('site.videos.title') }}</h1>
            <p class="lede">{{ __('site.videos.lede') }}</p>
        </div>
    </header>

    <section class="section">
        <div class="container">
            <div class="empty-panel empty-panel-wide">
                <span class="play-mark" aria-hidden="true"></span>
                <h2>{{ __('site.videos.empty') }}</h2>
                <p>{{ __('site.common.coming_soon') }}</p>
            </div>
        </div>
    </section>
@endsection
