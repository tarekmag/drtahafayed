@props(['items' => []])

<div {{ $attributes->class(['filter-bar']) }} data-filter>
    <button class="chip is-active" type="button" data-filter-btn data-filter="">{{ __('site.common.all') }}</button>
    @foreach ($items as $key => $label)
        <button class="chip" type="button" data-filter-btn data-filter="{{ $key }}">{{ $label }}</button>
    @endforeach
</div>
