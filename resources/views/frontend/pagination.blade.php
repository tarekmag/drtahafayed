@if ($paginator->hasPages())
    <nav class="pager" aria-label="{{ __('site.common.pagination') }}">
        @if ($paginator->onFirstPage())
            <span class="pager-btn is-disabled">{{ __('site.common.prev') }}</span>
        @else
            <button class="pager-btn" type="button" wire:click="previousPage" wire:loading.attr="disabled">{{ __('site.common.prev') }}</button>
        @endif

        <span class="pager-status">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>

        @if ($paginator->hasMorePages())
            <button class="pager-btn" type="button" wire:click="nextPage" wire:loading.attr="disabled">{{ __('site.common.next') }}</button>
        @else
            <span class="pager-btn is-disabled">{{ __('site.common.next') }}</span>
        @endif
    </nav>
@endif
