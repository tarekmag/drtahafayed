@if ($video->embedSrc)
    <button {{ $attributes->class(['video-card', 'reveal']) }}
            style="--i: {{ $index }}"
            type="button"
            data-lightbox
            data-video="{{ $video->embedSrc }}"
            data-video-type="{{ $video->embedType }}"
            data-caption="{{ $video->title }}">
        <span class="video-card-media">
            @if ($video->cover)
                <img src="{{ $video->cover }}" alt="" loading="lazy" decoding="async">
            @endif
            <span class="play-button" aria-hidden="true"><x-icon name="play" /></span>
            @if ($video->duration)
                <span class="video-duration">{{ $video->duration }}</span>
            @endif
        </span>
        <span class="video-card-title">{{ $video->title }}</span>
        <span class="sr-only">{{ __('site.common.play_video') }}</span>
    </button>
@endif
