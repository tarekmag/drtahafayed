<?php

namespace App\Support;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Single read model for public site content.
 * Reads from config today; swap the item sources for Eloquent queries
 * when the dashboard is built, and the views stay unchanged.
 */
class Content
{
    public static function doctor(): array
    {
        return config('clinic.doctor', []);
    }

    public static function contact(): array
    {
        return [
            'phone' => trim((string) config('clinic.phone')),
            'whatsapp' => preg_replace('/\D+/', '', (string) config('clinic.whatsapp')),
            'email' => trim((string) config('clinic.email')),
            'booking_url' => trim((string) config('clinic.booking_url')),
        ];
    }

    public static function phoneUrl(): ?string
    {
        $phone = self::contact()['phone'];

        return $phone !== '' ? 'tel:'.preg_replace('/\s+/', '', $phone) : null;
    }

    public static function whatsappUrl(?string $message = null): ?string
    {
        $number = self::contact()['whatsapp'];

        if ($number === '') {
            return null;
        }

        return 'https://wa.me/'.$number.($message ? '?text='.rawurlencode($message) : '');
    }

    public static function bookingUrl(): string
    {
        return self::contact()['booking_url'] ?: route('site.contact');
    }

    /**
     * @return array<string, string>
     */
    public static function socials(): array
    {
        return array_filter([
            'facebook' => trim((string) config('clinic.facebook')),
            'youtube' => trim((string) config('clinic.youtube')),
            'tiktok' => trim((string) config('clinic.tiktok')),
        ]);
    }

    public static function services(): Collection
    {
        return self::items('medical_services.items');
    }

    public static function service(string $slug): ?array
    {
        return self::services()->firstWhere('slug', $slug);
    }

    public static function relatedServices(array $service, int $limit = 3): Collection
    {
        $related = collect($service['related'] ?? []);

        return self::services()
            ->reject(fn (array $item) => $item['slug'] === $service['slug'])
            ->sortBy(fn (array $item) => $related->search($item['slug']) === false ? PHP_INT_MAX : $related->search($item['slug']))
            ->take($limit)
            ->values();
    }

    public static function articles(): Collection
    {
        return self::items('articles.items')
            ->sortByDesc('published_at')
            ->values();
    }

    public static function article(string $slug): ?array
    {
        return self::articles()->firstWhere('slug', $slug);
    }

    public static function relatedArticles(array $article, int $limit = 3): Collection
    {
        return self::articles()
            ->reject(fn (array $item) => $item['slug'] === $article['slug'])
            ->take($limit)
            ->values();
    }

    public static function reviews(): Collection
    {
        return self::items('reviews.items');
    }

    public static function videos(): Collection
    {
        return self::items('videos.items');
    }

    public static function gallery(): Collection
    {
        return self::items('gallery.items');
    }

    public static function faqs(): Collection
    {
        return self::items('faqs.items');
    }

    public static function clinics(): Collection
    {
        return self::items('clinic.clinics');
    }

    /**
     * The clinic with the soonest upcoming working day, based on `days` (0 = Sunday).
     *
     * @return array{clinic: array, date: CarbonInterface}|null
     */
    public static function nextClinic(?CarbonInterface $now = null): ?array
    {
        $now ??= Carbon::now(config('app.timezone'));
        $best = null;

        foreach (self::clinics() as $clinic) {
            foreach ($clinic['days'] ?? [] as $day) {
                $date = $now->copy()->startOfDay();
                $offset = ((int) $day - $date->dayOfWeek + 7) % 7;
                $date = $date->addDays($offset);

                if ($offset === 0 && ! empty($clinic['closes']) && $now->format('H:i') >= $clinic['closes']) {
                    $date = $date->addDays(7);
                }

                if ($best === null || $date->lt($best['date'])) {
                    $best = ['clinic' => $clinic, 'date' => $date];
                }
            }
        }

        return $best;
    }

    private static function items(string $key): Collection
    {
        return collect(config($key, []))
            ->filter(fn (array $item) => $item['is_active'] ?? true)
            ->sortBy(fn (array $item) => $item['sort'] ?? PHP_INT_MAX)
            ->values();
    }
}
