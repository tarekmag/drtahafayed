@extends('frontend.layouts.app')

@section('meta_title', __('site.services.meta_title'))
@section('meta_description', __('site.services.meta_description'))

@section('content')
    <x-page-hero
        :eyebrow="__('site.services.eyebrow')"
        :title="__('site.services.title')"
        :lede="__('site.services.lede')"
        :crumbs="[__('site.nav.services') => null]"
    />

    <section class="section">
        <div class="container">
            <livewire:frontend.services-index />
        </div>
    </section>

    <x-cta-band />
@endsection
