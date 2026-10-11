@use('App\Support\Content')
@use('App\Support\LocaleText')
@use('App\Support\MediaEmbed')

@php
    $clinics = Content::clinics();
@endphp

@if ($clinics->isEmpty())
    <div class="empty-panel">
        <x-icon name="map-pin" />
        <p>{{ __('site.clinics.empty') }}</p>
    </div>
@else
    <div class="clinic-stack">
        @foreach ($clinics as $clinic)
            @php
                $id = $clinic['id'] ?? 'clinic-'.$loop->index;
                $name = LocaleText::get($clinic['name'] ?? '');
            @endphp
            <article class="clinic-block" id="{{ $id }}">
                <header class="clinic-block-head">
                    <span class="clinic-block-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h2>{{ $name }}</h2>
                </header>
                <div class="clinic-block-body">
                    <x-clinic-details :clinic="$clinic" />
                    <x-clinic-map :clinic="$clinic" />
                    @if (! empty($clinic['photos']))
                        <div class="clinic-photos" aria-label="{{ __('site.clinics.photos_label', ['name' => $name]) }}">
                            @foreach ($clinic['photos'] as $photo)
                                @php $src = MediaEmbed::image($photo); @endphp
                                @if ($src)
                                    <img src="{{ $src }}" alt="" loading="lazy">
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </article>
        @endforeach
    </div>
@endif
