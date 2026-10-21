@props(['title', 'description', 'url'])

<script type="application/ld+json">{!! app(\App\Support\Seo\StructuredData::class)->toJson($title, $description, $url) !!}</script>
