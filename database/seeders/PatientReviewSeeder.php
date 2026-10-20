<?php

namespace Database\Seeders;

use App\Models\PatientReview;
use Illuminate\Database\Seeder;

class PatientReviewSeeder extends Seeder
{
    /**
     * Seed the reviews already published on the site.
     */
    public function run(): void
    {
        foreach (config('reviews.items', []) as $review) {
            $name = trim((string) (is_array($review['name'] ?? null) ? ($review['name']['ar'] ?? $review['name']['en'] ?? '') : ($review['name'] ?? '')));
            $body = trim((string) (is_array($review['text'] ?? null) ? ($review['text']['ar'] ?? $review['text']['en'] ?? '') : ($review['text'] ?? '')));

            if ($name === '' || $body === '') {
                continue;
            }

            PatientReview::query()->firstOrCreate(
                [
                    'name' => mb_substr($name, 0, 80),
                    'body' => $body,
                ],
                [
                    'rating' => (int) ($review['rating'] ?? 5),
                    'locale' => 'ar',
                    'source' => (string) ($review['source'] ?? 'vezeeta'),
                    'is_published' => (bool) ($review['is_active'] ?? true),
                ],
            );
        }
    }
}
