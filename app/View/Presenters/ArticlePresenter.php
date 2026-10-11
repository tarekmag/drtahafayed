<?php

namespace App\View\Presenters;

use App\Support\LocaleText;
use App\Support\MediaEmbed;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ArticlePresenter
{
    public function __construct(
        public string $title,
        public string $category,
        public string $categoryKey,
        public ?string $cover,
        public string $excerpt,
        public string $url,
        public ?string $dateIso,
        public ?string $dateLabel,
        public ?int $readMinutes,
    ) {}

    public static function make(array $article): self
    {
        $category = LocaleText::get($article['category'] ?? '');
        $english = is_array($article['category'] ?? null)
            ? (string) ($article['category']['en'] ?? $category)
            : $category;
        $date = ! empty($article['published_at'])
            ? Carbon::parse($article['published_at'])->locale(app()->getLocale())
            : null;

        return new self(
            title: LocaleText::get($article['title'] ?? ''),
            category: $category,
            categoryKey: Str::slug($english),
            cover: MediaEmbed::image($article['cover'] ?? ''),
            excerpt: LocaleText::get($article['excerpt'] ?? ''),
            url: route('site.article', ['article' => $article['slug']]),
            dateIso: $date?->toDateString(),
            dateLabel: $date?->translatedFormat('j F Y'),
            readMinutes: isset($article['read_minutes']) ? (int) $article['read_minutes'] : null,
        );
    }
}
