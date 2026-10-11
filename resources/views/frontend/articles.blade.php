@extends('frontend.layouts.app')

@section('meta_title', \App\Support\Content::seo('articles')['title'])
@section('meta_description', \App\Support\Content::seo('articles')['description'])

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
