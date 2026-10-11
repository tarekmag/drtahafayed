<div>
    @if ($categories !== [])
        <div class="filter-bar" role="toolbar" aria-label="{{ __('site.articles.filter') }}">
            <button class="chip {{ $active === '' ? 'is-active' : '' }}" type="button" wire:click="$set('category', '')">{{ __('site.common.all') }}</button>
            @foreach ($categories as $key => $label)
                <button class="chip {{ $active === $key ? 'is-active' : '' }}" type="button" wire:click="$set('category', '{{ $key }}')">{{ $label }}</button>
            @endforeach
        </div>
    @endif

    @if ($articles->isEmpty())
        <div class="empty-panel">
            <p>{{ __('site.common.empty') }}</p>
        </div>
    @else
        <div class="article-grid">
            @foreach ($articles as $article)
                <x-article-card
                    :article="$article"
                    :featured="$loop->first && $articles->currentPage() === 1 && $active === ''"
                    :index="$loop->index"
                />
            @endforeach
        </div>
        {{ $articles->links() }}
    @endif
</div>
