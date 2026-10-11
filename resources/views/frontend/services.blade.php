@extends('frontend.layouts.app')

@section('meta_title', \App\Support\Content::seo('services')['title'])
@section('meta_description', \App\Support\Content::seo('services')['description'])

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
