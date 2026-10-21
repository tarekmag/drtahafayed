<?php

namespace App\Support;

use App\Models\Article;
use App\Models\Clinic;
use App\Models\ClinicContact;
use App\Models\Doctor;
use App\Models\Faq;
use App\Models\PatientReview;
use App\Models\Photo;
use App\Models\SeoPage;
use App\Models\Service;
use App\Models\SocialProfile;
use App\Models\Video;
use Carbon\CarbonInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Single read model for public site content.
 * Doctor biography, contact details, social links, clinics, services, articles, photos, videos, FAQs, reviews, and page SEO come from the database.
 * Other sections still read config until their dashboard screens replace those sources.
 */
class Content
{
    /**
     * @var array<string, array{title: string, description: string}>
     */
    private static array $seoCache = [];

    public static function doctor(): array
    {
        $doctor = Doctor::query()->first();

        return $doctor?->toContentArray() ?? [];
    }

    public static function contact(): array
    {
        $contact = ClinicContact::query()->first();

        return $contact?->toContentArray() ?? [
            'phone' => '',
            'phone_secondary' => '',
            'whatsapp' => '',
            'email' => '',
            'booking_url' => '',
        ];
    }

    public static function phoneUrl(): ?string
    {
        $phone = self::contact()['phone'];

        return $phone !== '' ? 'tel:'.preg_replace('/\s+/', '', $phone) : null;
    }

    public static function secondaryPhoneUrl(): ?string
    {
        $phone = self::contact()['phone_secondary'];

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
        return SocialProfile::query()->first()?->toContentArray() ?? [];
    }

    public static function services(?string $specialty = null, ?int $perPage = null): Collection|LengthAwarePaginator
    {
        $services = Service::query()
            ->where('is_active', true)
            ->when($specialty, fn ($query) => $query->where('specialty', $specialty))
            ->orderBy('sort')
            ->orderBy('id');

        if ($perPage === null) {
            return $services->get()->map(fn (Service $service) => $service->toContentArray());
        }

        return $services
            ->paginate($perPage)
            ->through(fn (Service $service) => $service->toContentArray());
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
        return Article::query()
            ->where('is_active', true)
            ->orderByDesc('published_at')
            ->orderBy('sort')
            ->get()
            ->map(fn (Article $article) => $article->toContentArray());
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

    /**
     * Localized title and description for a public page.
     *
     * @return array{title: string, description: string}
     */
    public static function seo(string $page): array
    {
        $cacheKey = app()->getLocale().':'.$page;

        if (isset(self::$seoCache[$cacheKey])) {
            return self::$seoCache[$cacheKey];
        }

        $record = SeoPage::query()->where('page', $page)->first();
        $title = LocaleText::get($record?->meta_title ?? '');
        $description = LocaleText::get($record?->meta_description ?? '');

        return self::$seoCache[$cacheKey] = [
            'title' => $title !== '' ? $title : (string) __('site.'.$page.'.meta_title'),
            'description' => $description !== '' ? $description : (string) __('site.'.$page.'.meta_description'),
        ];
    }

    /**
     * The review page shows only approved reviews submitted on this website; without them it is just a form.
     */
    public static function hasPublishedWebsiteReviews(): bool
    {
        return PatientReview::query()
            ->where('is_published', true)
            ->where('source', 'website')
            ->exists();
    }

    public static function reviews(): Collection
    {
        return PatientReview::query()
            ->where('is_published', true)
            ->inRandomOrder()
            ->limit(20)
            ->get()
            ->map(fn (PatientReview $review) => [
                'rating' => $review->rating,
                'name' => $review->name,
                'place' => match ($review->source) {
                    'vezeeta' => ['ar' => 'فيزيتا', 'en' => 'Vezeeta'],
                    'clinido' => ['ar' => 'كليندو', 'en' => 'Clinido'],
                    default => ['ar' => 'الموقع', 'en' => 'Website'],
                },
                'text' => $review->body,
            ]);
    }

    public static function videos(): Collection
    {
        return Video::query()
            ->where('is_active', true)
            ->orderBy('sort')
            ->orderBy('id')
            ->get()
            ->map(fn (Video $video) => $video->toContentArray());
    }

    public static function gallery(): Collection
    {
        return Photo::query()
            ->where('is_active', true)
            ->orderBy('sort')
            ->orderBy('id')
            ->get()
            ->map(fn (Photo $photo) => $photo->toContentArray());
    }

    public static function faqs(): Collection
    {
        return Faq::query()
            ->where('is_active', true)
            ->orderBy('sort')
            ->orderBy('id')
            ->get()
            ->map(fn (Faq $faq) => $faq->toContentArray());
    }

    public static function clinics(): Collection
    {
        return Clinic::query()
            ->where('is_active', true)
            ->orderBy('sort')
            ->orderBy('id')
            ->get()
            ->map(fn (Clinic $clinic) => $clinic->toContentArray());
    }

    /**
     * Working days and opening times for a clinic content array.
     *
     * @param  array<string, mixed>  $clinic
     * @return array{days: string, time: string}
     */
    public static function schedule(array $clinic): array
    {
        $labels = trans('site.clinics.weekdays');
        $labels = is_array($labels) ? $labels : [];

        $days = collect($clinic['days'] ?? [])
            ->map(fn ($day) => $labels[(int) $day] ?? null)
            ->filter()
            ->implode(app()->getLocale() === 'ar' ? '، ' : ', ');

        $opens = self::clockLabel($clinic['opens'] ?? '');
        $closes = self::clockLabel($clinic['closes'] ?? '');
        $time = match (true) {
            $opens !== '' && $closes !== '' => $opens.' – '.$closes,
            $opens !== '' => $opens,
            default => $closes,
        };

        return ['days' => $days, 'time' => $time];
    }

    private static function clockLabel(mixed $value): string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return '';
        }

        $format = strlen($value) > 5 ? 'H:i:s' : 'H:i';

        try {
            return Carbon::createFromFormat($format, $value)->format('g:i A');
        } catch (\Throwable) {
            return $value;
        }
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
}
