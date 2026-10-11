@extends('frontend.layouts.app')

@section('meta_title', __('site.contact.meta_title'))
@section('meta_description', __('site.contact.meta_description'))

@section('content')
    <x-page-hero
        :eyebrow="__('site.contact.eyebrow')"
        :title="__('site.contact.title')"
        :lede="__('site.contact.lede')"
        :crumbs="[__('site.nav.contact') => null]"
    />

    <section class="section">
        <div class="container contact-grid">
            <livewire:frontend.contact-form />
            <x-contact-aside />
        </div>
    </section>

    <section class="section section-sand">
        <div class="container">
            <x-section-head :title="__('site.contact.clinics_title')" />
            <x-clinic-tabs />
        </div>
    </section>
@endsection
