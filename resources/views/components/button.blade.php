@props([
    'href',
    'variant' => 'primary',
    'icon' => null,
    'iconEnd' => null,
    'external' => false,
])

<a {{ $attributes->class(['btn', 'btn-'.$variant]) }} href="{{ $href }}" @if ($external) target="_blank" rel="noopener noreferrer" @endif>
    @if ($icon)
        <x-icon :name="$icon" />
    @endif
    <span>{{ $slot }}</span>
    @if ($iconEnd)
        <x-icon :name="$iconEnd" />
    @endif
</a>
