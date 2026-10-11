@props(['items', 'group' => 'faq'])

@use('App\Support\LocaleText')

<div {{ $attributes->class(['faq-list']) }}>
    @foreach ($items as $item)
        <details class="faq-item reveal" style="--i: {{ $loop->index }}" name="{{ $group }}" @if ($loop->first) open @endif>
            <summary>
                <span>{{ LocaleText::get($item['q'] ?? '') }}</span>
                <span class="faq-icon" aria-hidden="true"><x-icon name="plus" /></span>
            </summary>
            <div class="faq-body">
                <p>{{ LocaleText::get($item['a'] ?? '') }}</p>
            </div>
        </details>
    @endforeach
</div>
