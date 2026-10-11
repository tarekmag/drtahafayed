@extends('frontend.layouts.app')

@section('meta_title', __('site.contact.clinics_meta_title'))
@section('meta_description', __('site.contact.clinics_meta_description'))

@section('content')
    <header class="page-hero page-hero-center">
        <div class="container">
            <p class="eyebrow">{{ __('site.contact.clinics_eyebrow') }}</p>
            <h1>{{ __('site.contact.clinics_title') }}</h1>
            <p class="lede">{{ __('site.contact.clinics_text') }}</p>
        </div>
    </header>

    <section class="section">
        <div class="container branches">
            @include('frontend.partials.clinics')
        </div>
    </section>

    <section class="band">
        <div class="container band-row">
            <div>
                <h2>{{ __('site.contact.book_title') }}</h2>
                <p>{{ __('site.contact.book_text') }}</p>
            </div>
            <div class="band-actions">
                <a class="btn btn-light" href="{{ route('site.contact') }}">{{ __('site.nav.book') }}</a>
            </div>
        </div>
    </section>
@endsection
