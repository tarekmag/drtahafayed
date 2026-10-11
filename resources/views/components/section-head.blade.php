@props([
    'eyebrow' => null,
    'title',
    'text' => null,
    'align' => 'start',
    'tag' => 'h2',
])

<div {{ $attributes->class(['section-head', 'section-head-center' => $align === 'center', 'has-actions' => $actions ?? false, 'reveal']) }}>
    <div class="section-head-copy">
        @if ($eyebrow)
            <p class="eyebrow">{{ $eyebrow }}</p>
        @endif
        <{{ $tag }} class="section-title">{{ $title }}</{{ $tag }}>
        @if ($text)
            <p class="section-text">{{ $text }}</p>
        @endif
    </div>
    @isset($actions)
        <div class="section-head-actions">{{ $actions }}</div>
    @endisset
</div>
