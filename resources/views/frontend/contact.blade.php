@extends('frontend.layouts.app')

@section('meta_title', __('site.contact.meta_title'))
@section('meta_description', __('site.contact.meta_description'))

@section('content')
    @php
        $clinic = config('clinic');
        $phoneHref = $clinic['phone'] ? 'tel:'.preg_replace('/\s+/', '', $clinic['phone']) : null;
    @endphp

    <header class="page-hero">
        <div class="container">
            <p class="eyebrow">{{ __('site.contact.eyebrow') }}</p>
            <h1>{{ __('site.contact.title') }}</h1>
            <p class="lede">{{ __('site.contact.lede') }}</p>
        </div>
    </header>

    <section class="section">
        <div class="container contact-grid">
            <form class="contact-form" data-contact-form action="javascript:void(0)">
                <label>
                    <span>{{ __('site.contact.name') }}</span>
                    <input type="text" name="name" autocomplete="name" required>
                </label>
                <label>
                    <span>{{ __('site.contact.phone') }}</span>
                    <input type="tel" name="phone" autocomplete="tel" required>
                </label>
                <label>
                    <span>{{ __('site.contact.email') }}</span>
                    <input type="email" name="email" autocomplete="email" required>
                </label>
                <label>
                    <span>{{ __('site.contact.message') }}</span>
                    <textarea name="message" rows="5" required></textarea>
                </label>
                <button class="btn btn-accent" type="submit">{{ __('site.contact.submit') }}</button>
                <p class="form-notice" data-form-notice hidden tabindex="-1" role="status">{{ __('site.contact.notice') }}</p>
            </form>

            <aside class="contact-card">
                <h2>{{ __('site.contact.channels_title') }}</h2>

                <div class="channel">
                    <h3>{{ __('site.contact.phone_label') }}</h3>
                    @if ($phoneHref)
                        <a href="{{ $phoneHref }}">{{ $clinic['phone'] }}</a>
                    @else
                        <p>{{ __('site.contact.missing_phone') }}</p>
                    @endif
                </div>

                <div class="channel">
                    <h3>{{ __('site.contact.email_label') }}</h3>
                    @if ($clinic['email'])
                        <a href="mailto:{{ $clinic['email'] }}">{{ $clinic['email'] }}</a>
                    @else
                        <p>{{ __('site.contact.missing_email') }}</p>
                    @endif
                </div>

                @include('frontend.partials.social-links', ['linkClass' => 'btn btn-accent'])
            </aside>
        </div>
    </section>

    <section class="section section-tight" id="clinics">
        <div class="container">
            <div class="section-head reveal">
                <p class="eyebrow">{{ __('site.contact.clinics_eyebrow') }}</p>
                <h2>{{ __('site.contact.clinics_title') }}</h2>
                <p>{{ __('site.contact.clinics_text') }}</p>
            </div>

            @include('frontend.partials.clinics')
        </div>
    </section>
@endsection
