<div>
    @if ($specialties !== [])
        <div class="filter-bar" role="toolbar" aria-label="{{ __('site.services.filter') }}">
            <button class="chip {{ $active === '' ? 'is-active' : '' }}" type="button" wire:click="$set('category', '')">{{ __('site.common.all') }}</button>
            @foreach ($specialties as $key => $label)
                <button class="chip {{ $active === $key ? 'is-active' : '' }}" type="button" wire:click="$set('category', '{{ $key }}')">{{ $label }}</button>
            @endforeach
        </div>
    @endif

    @if ($services->isEmpty())
        <div class="empty-panel">
            <p>{{ __('site.common.empty') }}</p>
        </div>
    @else
        <div class="services-grid">
            @foreach ($services as $service)
                <x-service-card :service="$service" :featured="$loop->first && $active === ''" :index="$loop->index" />
            @endforeach
        </div>
    @endif
</div>
