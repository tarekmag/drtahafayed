@extends('frontend.layouts.app')

@section('meta_title', __('site.article.meta_title'))
@section('meta_description', __('site.article.meta_description'))

@section('content')
    <article class="section article-page">
        <div class="container narrow">
            <a class="text-link back-link" href="{{ route('site.articles') }}">{{ __('site.article.back') }}</a>
            <p class="card-kicker">{{ __('site.common.educational') }}</p>
            <h1>{{ __('site.article.title') }}</h1>
            <p class="lede">{{ __('site.article.lede') }}</p>

            @foreach (__('site.article.sections') as $section)
                <section class="article-section reveal">
                    <h2>{{ $section['heading'] }}</h2>
                    @foreach ($section['paragraphs'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </section>
            @endforeach

            <aside class="disclaimer-box">
                <p>{{ __('site.footer.disclaimer') }}</p>
            </aside>
        </div>
    </article>
@endsection
