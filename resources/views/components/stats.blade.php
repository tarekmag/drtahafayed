@use('App\Support\Content')
@use('App\Support\LocaleText')

@php
    $stats = Content::doctor()['stats'] ?? [];
@endphp

@if ($stats)
    <dl {{ $attributes->class(['stats']) }}>
        @foreach ($stats as $stat)
            <div class="stat reveal" style="--i: {{ $loop->index }}">
                <dt class="stat-value">
                    <span data-count="{{ (int) $stat['value'] }}">{{ number_format((int) $stat['value']) }}</span>{{ $stat['suffix'] ?? '' }}
                </dt>
                <dd class="stat-label">{{ LocaleText::get($stat['label'] ?? '') }}</dd>
            </div>
        @endforeach
    </dl>
@endif
