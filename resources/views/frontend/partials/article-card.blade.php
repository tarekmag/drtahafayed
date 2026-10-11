<article class="article-card reveal" style="--delay: {{ ($index ?? 0) * 70 }}ms">
    <p class="card-kicker">{{ $article['category'] }}</p>
    <h3>{{ $article['title'] }}</h3>
    <p>{{ $article['excerpt'] }}</p>
    @if (! empty($article['slug']))
        <a class="text-link" href="{{ route('site.article') }}">{{ __('site.common.read_more') }}</a>
    @else
        <span class="soon">{{ __('site.common.coming_soon') }}</span>
    @endif
</article>
