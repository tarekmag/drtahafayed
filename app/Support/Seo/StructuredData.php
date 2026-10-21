<?php

namespace App\Support\Seo;

use App\Support\Content;
use App\Support\LocaleText;
use App\Support\MediaEmbed;
use App\Support\ResponsiveImage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

/**
 * Request-scoped schema.org graph for the current public page.
 * Views register breadcrumbs or an article; the layout renders one JSON-LD block.
 */
class StructuredData
{
    /**
     * @var array<string, string>
     */
    private const PAGE_TYPES = [
        'site.about' => 'AboutPage',
        'site.contact' => 'ContactPage',
        'site.services' => 'CollectionPage',
        'site.articles' => 'CollectionPage',
        'site.photos' => 'CollectionPage',
        'site.videos' => 'CollectionPage',
        'site.service' => 'MedicalWebPage',
        'site.article' => 'MedicalWebPage',
    ];

    /**
     * Schema.org MedicalSpecialty members matching general, oncologic, and gland (endocrine) surgery.
     *
     * @var list<string>
     */
    private const SPECIALTIES = [
        'https://schema.org/Surgical',
        'https://schema.org/Oncologic',
        'https://schema.org/Endocrine',
    ];

    /**
     * @var list<string>
     */
    private const WEEKDAYS = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    /**
     * @var list<array{name: string, url: string|null}>
     */
    private array $breadcrumbs = [];

    /**
     * @var array<string, mixed>|null
     */
    private ?array $article = null;

    /**
     * @param  array<string, string|null>  $crumbs  Label => URL, with null for the current page.
     */
    public function breadcrumbs(array $crumbs): static
    {
        $this->breadcrumbs = [['name' => (string) __('site.nav.home'), 'url' => route('site.home')]];

        foreach ($crumbs as $label => $url) {
            $this->breadcrumbs[] = ['name' => (string) $label, 'url' => $url];
        }

        return $this;
    }

    /**
     * @param  array<string, mixed>  $article  Content::article() shape.
     */
    public function article(array $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function toJson(string $title, string $description, string $url): string
    {
        return json_encode(
            $this->graph($title, $description, $url),
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_THROW_ON_ERROR,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function graph(string $title, string $description, string $url): array
    {
        $nodes = [
            $this->website(),
            $this->physician(),
            $this->doctor(),
            $this->webPage($title, $description, $url),
        ];

        if (count($this->breadcrumbs) > 1) {
            $nodes[] = $this->breadcrumbList($url);
        }

        if ($this->article !== null) {
            $nodes[] = $this->articleNode($url);
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $nodes,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function website(): array
    {
        return [
            '@type' => 'WebSite',
            '@id' => $this->id('website'),
            'url' => route('site.home'),
            'name' => (string) __('site.brand.name'),
            'inLanguage' => app()->getLocale(),
            'publisher' => ['@id' => $this->id('physician')],
        ];
    }

    /**
     * The doctor's practice. Every branch is a real clinic managed from the dashboard.
     *
     * @return array<string, mixed>
     */
    private function physician(): array
    {
        $doctor = Content::doctor();
        $contact = Content::contact();

        return $this->filled([
            '@type' => 'Physician',
            '@id' => $this->id('physician'),
            'name' => LocaleText::get($doctor['name'] ?? '') ?: (string) __('site.brand.name'),
            'description' => (string) __('site.brand.description'),
            'url' => route('site.home'),
            'logo' => asset('assets/images/logo.png'),
            'image' => MediaEmbed::image($doctor['portrait'] ?? $doctor['hero_image'] ?? null),
            'telephone' => $contact['phone'] ?: null,
            'email' => $contact['email'] ?: null,
            'medicalSpecialty' => self::SPECIALTIES,
            'sameAs' => array_values(Content::socials()),
            'department' => Content::clinics()->values()->map(fn (array $clinic, int $index) => $this->clinic($clinic, $index))->all(),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function doctor(): array
    {
        $doctor = Content::doctor();

        return $this->filled([
            '@type' => 'Person',
            '@id' => $this->id('doctor'),
            'name' => LocaleText::get($doctor['name'] ?? '') ?: (string) __('site.brand.name'),
            'jobTitle' => LocaleText::get($doctor['title'] ?? '') ?: (string) __('site.brand.specialty'),
            'description' => $this->plain(LocaleText::get($doctor['summary'] ?? '')),
            'image' => MediaEmbed::image($doctor['portrait'] ?? null),
            'url' => route('site.about'),
            'worksFor' => ['@id' => $this->id('physician')],
        ]);
    }

    /**
     * @param  array<string, mixed>  $clinic
     * @return array<string, mixed>
     */
    private function clinic(array $clinic, int $index): array
    {
        $anchor = $clinic['id'] ?? 'clinic-'.$index;
        $map = MediaEmbed::map($clinic['map'] ?? '');
        $separator = app()->getLocale() === 'ar' ? '، ' : ', ';
        $street = preg_replace('/\s*\R+\s*/u', $separator, LocaleText::get($clinic['address'] ?? '')) ?? '';

        return $this->filled([
            '@type' => 'MedicalClinic',
            '@id' => $this->id('clinic-'.$anchor),
            'name' => LocaleText::get($clinic['name'] ?? ''),
            'url' => route('site.clinics').'#'.$anchor,
            'telephone' => ($clinic['phone'] ?? '') ?: null,
            'address' => $street !== '' ? [
                '@type' => 'PostalAddress',
                'streetAddress' => $street,
                'addressCountry' => 'EG',
            ] : null,
            'geo' => $this->coordinates($clinic['map'] ?? ''),
            'hasMap' => $map['link'] ?? null,
            'openingHoursSpecification' => $this->openingHours($clinic),
        ]);
    }

    /**
     * @param  array<string, mixed>  $clinic
     * @return array<string, mixed>|null
     */
    private function openingHours(array $clinic): ?array
    {
        $days = collect($clinic['days'] ?? [])
            ->map(fn ($day) => self::WEEKDAYS[(int) $day] ?? null)
            ->filter()
            ->map(fn (string $day) => 'https://schema.org/'.$day)
            ->values()
            ->all();
        $opens = substr(trim((string) ($clinic['opens'] ?? '')), 0, 5);
        $closes = substr(trim((string) ($clinic['closes'] ?? '')), 0, 5);

        if ($days === [] || $opens === '' || $closes === '') {
            return null;
        }

        return [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => $days,
            'opens' => $opens,
            'closes' => $closes,
        ];
    }

    /**
     * @return array<string, mixed>|null
     */
    private function coordinates(string $map): ?array
    {
        if (! preg_match('/^\s*(-?\d{1,2}(?:\.\d+)?)\s*,\s*(-?\d{1,3}(?:\.\d+)?)\s*$/', $map, $matches)) {
            return null;
        }

        return [
            '@type' => 'GeoCoordinates',
            'latitude' => (float) $matches[1],
            'longitude' => (float) $matches[2],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function webPage(string $title, string $description, string $url): array
    {
        return $this->filled([
            '@type' => self::PAGE_TYPES[Route::currentRouteName()] ?? 'WebPage',
            '@id' => $url.'#webpage',
            'url' => $url,
            'name' => $title,
            'description' => $description,
            'inLanguage' => app()->getLocale(),
            'isPartOf' => ['@id' => $this->id('website')],
            'about' => ['@id' => $this->id('physician')],
            'breadcrumb' => count($this->breadcrumbs) > 1 ? ['@id' => $url.'#breadcrumb'] : null,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function breadcrumbList(string $url): array
    {
        $items = [];

        foreach ($this->breadcrumbs as $index => $crumb) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $crumb['name'],
                'item' => $crumb['url'] ?? $url,
            ];
        }

        return [
            '@type' => 'BreadcrumbList',
            '@id' => $url.'#breadcrumb',
            'itemListElement' => $items,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function articleNode(string $url): array
    {
        $article = $this->article ?? [];
        $published = ! empty($article['published_at']) ? Carbon::parse($article['published_at'])->toDateString() : null;
        $cover = MediaEmbed::image($article['cover'] ?? null);

        return $this->filled([
            '@type' => 'Article',
            '@id' => $url.'#article',
            'headline' => LocaleText::get($article['title'] ?? ''),
            'description' => LocaleText::get($article['excerpt'] ?? ''),
            'articleSection' => LocaleText::get($article['category'] ?? ''),
            'image' => ResponsiveImage::isRaster($cover) ? [$cover] : null,
            'datePublished' => $published,
            'inLanguage' => app()->getLocale(),
            'author' => ['@id' => $this->id('doctor')],
            'publisher' => ['@id' => $this->id('physician')],
            'mainEntityOfPage' => ['@id' => $url.'#webpage'],
            'isPartOf' => ['@id' => $url.'#webpage'],
        ]);
    }

    private function id(string $name): string
    {
        return SiteUrl::root().'/#'.$name;
    }

    private function plain(string $html): string
    {
        return trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($html))) ?? '');
    }

    /**
     * @param  array<string, mixed>  $node
     * @return array<string, mixed>
     */
    private function filled(array $node): array
    {
        return array_filter($node, fn ($value) => $value !== null && $value !== '' && $value !== []);
    }
}
