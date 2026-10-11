@extends('frontend.layouts.app')

@section('meta_title', __('site.videos.meta_title'))
@section('meta_description', __('site.videos.meta_description'))

@section('content')
    <x-page-hero
        :eyebrow="__('site.videos.eyebrow')"
        :title="__('site.videos.title')"
        :lede="__('site.videos.lede')"
        :crumbs="[__('site.nav.videos') => null]"
    />

    <section class="section">
        <div class="container">
            <livewire:frontend.videos-index />
        </div>
    </section>
@endsection
