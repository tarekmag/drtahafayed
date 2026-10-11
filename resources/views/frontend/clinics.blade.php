@extends('frontend.layouts.app')

@section('meta_title', \App\Support\Content::seo('clinics')['title'])
@section('meta_description', \App\Support\Content::seo('clinics')['description'])

@section('content')
    <x-page-hero
        :eyebrow="__('site.clinics.eyebrow')"
        :title="__('site.clinics.title')"
        :lede="__('site.clinics.lede')"
        :crumbs="[__('site.nav.clinics') => null]"
    />

    <section class="section">
        <div class="container">
            <x-clinic-stack />
        </div>
    </section>

    <x-cta-band />
@endsection
