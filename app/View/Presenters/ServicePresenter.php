<?php

namespace App\View\Presenters;

use App\Support\LocaleText;
use App\Support\MediaEmbed;

class ServicePresenter
{
    public function __construct(
        public string $title,
        public string $excerpt,
        public ?string $image,
        public string $icon,
        public string $specialty,
        public string $url,
        public array $conditions = [],
    ) {}

    public static function make(array $service): self
    {
        return new self(
            title: LocaleText::get($service['title'] ?? ''),
            excerpt: LocaleText::get($service['excerpt'] ?? ''),
            image: MediaEmbed::image($service['image'] ?? ''),
            icon: $service['icon'] ?? 'general',
            specialty: (string) ($service['specialty'] ?? ''),
            url: route('site.service', ['service' => $service['slug']]),
            conditions: collect($service['conditions'] ?? [])
                ->map(fn (mixed $item) => LocaleText::get($item))
                ->filter()
                ->values()
                ->all(),
        );
    }
}
