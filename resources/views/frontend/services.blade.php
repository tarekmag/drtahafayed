@extends('frontend.layouts.app')

@section('meta_title', __('site.services.meta_title'))
@section('meta_description', __('site.services.meta_description'))

@section('content')
    <header class="page-hero">
        <div class="container">
            <p class="eyebrow">{{ __('site.services.eyebrow') }}</p>
            <h1>{{ __('site.services.title') }}</h1>
            <p class="lede">{{ __('site.services.lede') }}</p>
        </div>
    </header>

    <section class="section">
        <div class="container services-grid">
            @foreach (config('medical_services.items') as $service)
                @include('frontend.partials.service-card', ['service' => $service, 'index' => $loop->index])
            @endforeach
        </div>
    </section>
@endsection
