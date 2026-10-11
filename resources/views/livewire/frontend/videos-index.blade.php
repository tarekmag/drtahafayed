<div>
    @if ($videos->isEmpty())
        <div class="empty-panel">
            <x-icon name="play" />
            <h2>{{ __('site.videos.empty') }}</h2>
        </div>
    @else
        <div class="video-grid">
            @foreach ($videos as $video)
                <x-video-card :video="$video" :index="$loop->index" />
            @endforeach
        </div>
        {{ $videos->links() }}
    @endif
</div>
