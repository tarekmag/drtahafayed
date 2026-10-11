<?php

namespace App\View\Presenters;

use App\Support\LocaleText;
use App\Support\MediaEmbed;

class VideoPresenter
{
    public function __construct(
        public string $title,
        public ?string $cover,
        public ?string $duration,
        public ?string $embedSrc,
        public ?string $embedType,
    ) {}

    public static function make(array $video): self
    {
        $embed = MediaEmbed::video($video['url'] ?? '');

        return new self(
            title: LocaleText::get($video['title'] ?? ''),
            cover: MediaEmbed::image($video['cover'] ?? '') ?? MediaEmbed::thumbnail($video['url'] ?? ''),
            duration: isset($video['duration']) ? (string) $video['duration'] : null,
            embedSrc: $embed['src'] ?? null,
            embedType: $embed['type'] ?? null,
        );
    }
}
