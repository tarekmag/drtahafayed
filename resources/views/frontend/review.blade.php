@extends('frontend.layouts.app')

@section('meta_title', \App\Support\Content::seo('review')['title'])
@section('meta_description', \App\Support\Content::seo('review')['description'])
@section('meta_robots', \App\Support\Seo\SearchIndexing::robots(\App\Support\Content::hasPublishedWebsiteReviews()))

@section('content')
    <x-page-hero
        :eyebrow="__('site.review.eyebrow')"
        :title="__('site.review.title')"
        :lede="__('site.review.lede')"
        :crumbs="[__('site.review.nav') => null]"
    />

    <section class="section">
        <div class="container">
            <livewire:frontend.review-form />
        </div>
    </section>
@endsection
