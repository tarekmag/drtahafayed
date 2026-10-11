@extends('frontend.layouts.app')

@section('meta_title', __('site.clinics.meta_title'))
@section('meta_description', __('site.clinics.meta_description'))

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
