@extends('frontend.layouts.app')

@section('meta_title', __('site.articles.meta_title'))
@section('meta_description', __('site.articles.meta_description'))

@section('content')
    <x-page-hero
        :eyebrow="__('site.articles.eyebrow')"
        :title="__('site.articles.title')"
        :lede="__('site.articles.lede')"
        :crumbs="[__('site.nav.articles') => null]"
    />

    <section class="section">
        <div class="container">
            <livewire:frontend.articles-index />
        </div>
    </section>
@endsection
