<a {{ $attributes->class(['service-card', 'reveal', 'service-card-featured' => $featured]) }} href="{{ $service->url }}" style="--i: {{ $index }}">
    <span class="service-card-media">
        @if ($service->image)
            <img src="{{ $service->image }}" alt="" loading="lazy" decoding="async">
        @else
            <span class="service-card-icon"><x-icon :name="$service->icon" /></span>
        @endif
    </span>
    <span class="service-card-body">
        <span class="service-card-title">{{ $service->title }}</span>
        @if ($service->excerpt !== '')
            <span class="service-card-excerpt">{{ $service->excerpt }}</span>
        @endif
        @if ($detailed && $service->conditions !== [])
            <span class="service-conditions">
                @foreach ($service->conditions as $condition)
                    <span>{{ $condition }}</span>
                @endforeach
            </span>
        @endif
        <span class="service-card-more">{{ __('site.common.learn_more') }} <x-icon name="arrow" /></span>
    </span>
</a>
