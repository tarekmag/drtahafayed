@php
    $title = \App\Support\LocaleText::get($service['title'] ?? '');
    $excerpt = \App\Support\LocaleText::get($service['excerpt'] ?? '');
    $image = \App\Support\MediaEmbed::image($service['image'] ?? '');
@endphp
<a class="service-card reveal" @isset($index) style="--delay: {{ $index * 60 }}ms" @endisset href="{{ route('site.service', ['service' => $service['id']]) }}">
    @if ($image)
        <img class="service-photo" src="{{ $image }}" alt="{{ $title }}" width="800" height="500" loading="lazy">
    @endif
    <div class="service-card-body">
        <h3>{{ $title }}</h3>
        <p>{{ $excerpt }}</p>
    </div>
</a>
