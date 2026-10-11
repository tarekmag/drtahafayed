@extends('frontend.layouts.app')

@section('meta_title', __('site.review.meta_title'))
@section('meta_description', __('site.review.meta_description'))

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
