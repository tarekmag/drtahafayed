@extends('frontend.layouts.app')

@section('meta_title', __('site.articles.meta_title'))
@section('meta_description', __('site.articles.meta_description'))

@section('content')
    <header class="page-hero">
        <div class="container">
            <p class="eyebrow">{{ __('site.articles.eyebrow') }}</p>
            <h1>{{ __('site.articles.title') }}</h1>
            <p class="lede">{{ __('site.articles.lede') }}</p>
        </div>
    </header>

    <section class="section">
        <div class="container">
            <div class="article-grid">
                @foreach (__('site.articles.items') as $article)
                    @include('frontend.partials.article-card', ['article' => $article, 'index' => $loop->index])
                @endforeach
            </div>
        </div>
    </section>
@endsection
