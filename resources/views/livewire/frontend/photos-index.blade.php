<div>
    <div class="filter-bar" role="toolbar" aria-label="{{ __('site.photos.filter') }}">
        <button class="chip {{ $active === '' ? 'is-active' : '' }}" type="button" wire:click="$set('category', '')">{{ __('site.common.all') }}</button>
        @foreach ($categories as $key => $label)
            <button class="chip {{ $active === $key ? 'is-active' : '' }}" type="button" wire:click="$set('category', '{{ $key }}')">{{ $label }}</button>
        @endforeach
    </div>

    @if ($photos->isEmpty())
        <div class="empty-panel">
            <p>{{ __('site.common.empty') }}</p>
        </div>
    @else
        <div class="photo-masonry">
            @foreach ($photos as $photo)
                <x-photo-card :photo="$photo" :index="$loop->index" />
            @endforeach
        </div>
        {{ $photos->links() }}
    @endif
</div>
