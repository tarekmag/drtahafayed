<?php

namespace App\View\Presenters;

use App\Support\LocaleText;
use App\Support\MediaEmbed;

class PhotoPresenter
{
    public function __construct(
        public string $path,
        public ?string $full,
        public string $caption,
        public string $category,
    ) {}

    public static function make(array $photo): self
    {
        $path = (string) ($photo['image'] ?? '');

        return new self(
            path: $path,
            full: MediaEmbed::image($path),
            caption: LocaleText::get($photo['caption'] ?? ''),
            category: (string) ($photo['category'] ?? ''),
        );
    }
}
