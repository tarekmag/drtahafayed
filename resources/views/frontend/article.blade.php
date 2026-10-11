@use('App\Support\Content')
@use('App\Support\LocaleText')
@use('App\Support\MediaEmbed')
@use('Illuminate\Support\Carbon')
@use('Illuminate\Support\Str')

@php
    $title = LocaleText::get($article['title'] ?? '');
    $excerpt = LocaleText::get($article['excerpt'] ?? '');
    $body = LocaleText::get($article['body'] ?? '');
    $cover = MediaEmbed::image($article['cover'] ?? '');
    $date = ! empty($article['published_at']) ? Carbon::parse($article['published_at'])->locale(app()->getLocale()) : null;
    $toc = [];

    if (preg_match_all('/<h2>(.*?)<\/h2>/u', $body, $matches)) {
        foreach ($matches[1] as $index => $heading) {
            $id = 'section-'.($index + 1);
            $plain = trim(strip_tags($heading));
            $body = Str::replaceFirst('<h2>'.$heading.'</h2>', '<h2 id="'.$id.'">'.$heading.'</h2>', $body);
            $toc[] = ['id' => $id, 'title' => $plain];
        }
    }
@endphp

@extends('frontend.layouts.app')

@section('meta_title', $title.' | '.__('site.brand.name'))
@section('meta_description', $excerpt)
@section('og_image', $cover ?: '')

@section('content')
    <x-page-hero
        :eyebrow="LocaleText::get($article['category'] ?? __('site.articles.eyebrow'))"
        :title="$title"
        :lede="$excerpt"
        :crumbs="[__('site.nav.articles') => route('site.articles'), $title => null]"
    />

    <article class="section" data-article>
        <div class="container article-layout">
            <aside>
                @if ($toc)
                    <div class="toc-card">
                        <h2>{{ __('site.articles.toc') }}</h2>
                        @foreach ($toc as $item)
                            <a href="#{{ $item['id'] }}">{{ $item['title'] }}</a>
                        @endforeach
                    </div>
                @endif
            </aside>

            <div>
                <div class="article-toolbar">
                    <p class="article-meta">
                        @if ($date)
                            <time datetime="{{ $date->toDateString() }}">{{ $date->translatedFormat('j F Y') }}</time>
                        @endif
                        @if (! empty($article['read_minutes']))
                            <span>{{ __('site.common.minutes', ['count' => $article['read_minutes']]) }}</span>
                        @endif
                        <span>{{ __('site.articles.author') }} {{ __('site.brand.name') }}</span>
                    </p>
                    <div class="share-row">
                        <button class="btn btn-outline" type="button" data-copy-link data-copied="{{ __('site.common.copied') }}">{{ __('site.common.copy_link') }}</button>
                    </div>
                </div>

                @if ($cover)
                    <img src="{{ $cover }}" alt="" style="width:100%;border-radius:1.2rem;margin-bottom:1.4rem">
                @endif

                <div class="rich-text">
                    {!! $body !!}
                </div>

                <p class="disclaimer" style="margin-top:2rem">{{ __('site.articles.disclaimer') }}</p>
                <p><a class="link-arrow" href="{{ route('site.articles') }}">{{ __('site.articles.back') }} <x-icon name="arrow" /></a></p>
            </div>
        </div>
    </article>

    @if ($related->isNotEmpty())
        <section class="section section-sand">
            <div class="container">
                <x-section-head :title="__('site.common.related_articles')" />
                <div class="article-grid">
                    @foreach ($related as $item)
                        <x-article-card :article="$item" :index="$loop->index" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
