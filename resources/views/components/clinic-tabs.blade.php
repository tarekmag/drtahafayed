@use('App\Support\Content')
@use('App\Support\LocaleText')

@php
    $clinics = Content::clinics();
@endphp

@if ($clinics->isNotEmpty())
    <div {{ $attributes->class(['clinic-tabs', 'reveal']) }} data-tabs>
        <div class="clinic-tablist" role="tablist">
            @foreach ($clinics as $clinic)
                @php $id = $clinic['id'] ?? 'clinic-'.$loop->index; @endphp
                <button
                    class="clinic-tab @if ($loop->first) is-active @endif"
                    type="button"
                    role="tab"
                    id="tab-{{ $id }}"
                    aria-controls="panel-{{ $id }}"
                    aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                    @unless ($loop->first) tabindex="-1" @endunless
                >
                    <span class="clinic-tab-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="clinic-tab-copy">
                        <strong>{{ LocaleText::get($clinic['name'] ?? '') }}</strong>
                        @php
                            $schedule = Content::schedule($clinic);
                            $daysLabel = trim($schedule['days'].($schedule['time'] !== '' ? ' '.$schedule['time'] : ''));
                        @endphp
                        <small>{{ $daysLabel }}</small>
                    </span>
                    <x-icon name="chevron" />
                </button>
            @endforeach
        </div>

        <div class="clinic-panels">
            @foreach ($clinics as $clinic)
                @php $id = $clinic['id'] ?? 'clinic-'.$loop->index; @endphp
                <div
                    class="clinic-panel @if ($loop->first) is-active @endif"
                    role="tabpanel"
                    id="panel-{{ $id }}"
                    aria-labelledby="tab-{{ $id }}"
                    tabindex="0"
                >
                    <div class="clinic-panel-info">
                        <h3 class="clinic-panel-title">{{ LocaleText::get($clinic['name'] ?? '') }}</h3>
                        <x-clinic-details :clinic="$clinic" />
                    </div>
                    <x-clinic-map :clinic="$clinic" />
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="empty-panel">
        <x-icon name="map-pin" />
        <p>{{ __('site.clinics.empty') }}</p>
    </div>
@endif
