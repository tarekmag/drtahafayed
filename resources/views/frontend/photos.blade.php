@extends('frontend.layouts.app')

@section('meta_title', __('site.photos.meta_title'))
@section('meta_description', __('site.photos.meta_description'))

@section('content')
    <x-page-hero
        :eyebrow="__('site.photos.eyebrow')"
        :title="__('site.photos.title')"
        :lede="__('site.photos.lede')"
        :crumbs="[__('site.nav.photos') => null]"
    />

    <section class="section">
        <div class="container">
            <livewire:frontend.photos-index />
        </div>
    </section>
@endsection
