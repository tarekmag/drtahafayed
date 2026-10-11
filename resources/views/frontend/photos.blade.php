@extends('frontend.layouts.app')

@section('meta_title', \App\Support\Content::seo('photos')['title'])
@section('meta_description', \App\Support\Content::seo('photos')['description'])

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
