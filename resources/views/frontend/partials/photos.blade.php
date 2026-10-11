@php
    $photos = [
        ['file' => 'dr-1.jpeg', 'key' => 'dr1'],
        ['file' => 'dr-2.jpeg', 'key' => 'dr2'],
        ['file' => 'dr-3.jpeg', 'key' => 'dr3'],
        ['file' => 'dr-4.jpeg', 'key' => 'dr4'],
    ];
@endphp
<div class="photo-grid">
    @foreach ($photos as $photo)
        @php $alt = __('site.photos.alt.'.$photo['key']); @endphp
        <button
            class="photo-card reveal"
            style="--delay: {{ $loop->index * 70 }}ms"
            type="button"
            data-lightbox
            data-full="{{ asset('assets/images/'.$photo['file']) }}"
        >
            <img src="{{ asset('assets/images/'.$photo['file']) }}" alt="{{ $alt }}" @if ($loop->first) fetchpriority="high" @else loading="lazy" @endif>
        </button>
    @endforeach
</div>
