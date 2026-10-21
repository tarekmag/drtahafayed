@if ($paginator->hasPages())
    @php
        $previousUrl = \App\Support\Seo\PageUrls::withoutFirstPage((string) $paginator->previousPageUrl());
    @endphp
    <nav class="pager" aria-label="{{ __('site.common.pagination') }}">
        @if ($paginator->onFirstPage())
            <span class="pager-btn is-disabled">{{ __('site.common.prev') }}</span>
        @else
            <a class="pager-btn" href="{{ $previousUrl }}" rel="prev" wire:click.prevent="previousPage" wire:loading.attr="disabled">{{ __('site.common.prev') }}</a>
        @endif

        <span class="pager-status">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>

        @if ($paginator->hasMorePages())
            <a class="pager-btn" href="{{ $paginator->nextPageUrl() }}" rel="next" wire:click.prevent="nextPage" wire:loading.attr="disabled">{{ __('site.common.next') }}</a>
        @else
            <span class="pager-btn is-disabled">{{ __('site.common.next') }}</span>
        @endif
    </nav>
@endif
