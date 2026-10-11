<a {{ $attributes->class(['article-card', 'reveal', 'article-card-featured' => $featured]) }} href="{{ $article->url }}" style="--i: {{ $index }}">
    <span class="article-card-media">
        @if ($article->cover)
            <img src="{{ $article->cover }}" alt="" loading="lazy" decoding="async">
        @endif
    </span>
    <span class="article-card-body">
        @if ($article->category !== '')
            <span class="eyebrow">{{ $article->category }}</span>
        @endif
        <span class="article-card-title">{{ $article->title }}</span>
        @if ($article->excerpt !== '')
            <span class="article-card-excerpt">{{ $article->excerpt }}</span>
        @endif
        <span class="article-card-meta">
            @if ($article->dateLabel)
                <time datetime="{{ $article->dateIso }}">{{ $article->dateLabel }}</time>
            @endif
            @if ($article->readMinutes)
                <span>{{ __('site.common.minutes', ['count' => $article->readMinutes]) }}</span>
            @endif
        </span>
    </span>
</a>
