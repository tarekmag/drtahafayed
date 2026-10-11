@extends('frontend.layouts.app')

@section('meta_title', \App\Support\Content::seo('videos')['title'])
@section('meta_description', \App\Support\Content::seo('videos')['description'])

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
