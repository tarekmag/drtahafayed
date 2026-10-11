<button {{ $attributes->class(['photo-card', 'reveal']) }}
        style="--i: {{ $index }}"
        type="button"
        data-lightbox
        data-full="{{ $photo->full }}"
        data-caption="{{ $photo->caption }}">
    <x-picture :src="$photo->path" :alt="$photo->caption" sizes="(min-width: 700px) 30vw, 48vw" />
</button>
