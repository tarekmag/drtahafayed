@extends('frontend.layouts.app')

@section('meta_title', __('site.photos.meta_title'))
@section('meta_description', __('site.photos.meta_description'))

@section('content')
    <header class="page-hero">
        <div class="container">
            <p class="eyebrow">{{ __('site.photos.eyebrow') }}</p>
            <h1>{{ __('site.photos.title') }}</h1>
            <p class="lede">{{ __('site.photos.lede') }}</p>
        </div>
    </header>

    <section class="section">
        <div class="container">
            @include('frontend.partials.photos')
        </div>
    </section>
@endsection
