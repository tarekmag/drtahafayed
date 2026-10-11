<?php

namespace Database\Seeders;

use App\Models\SeoPage;
use Illuminate\Database\Seeder;

class SeoPageSeeder extends Seeder
{
    /**
     * Seed the current page titles and descriptions.
     */
    public function run(): void
    {
        if (SeoPage::query()->exists()) {
            return;
        }

        foreach (array_keys(SeoPage::PAGES) as $page) {
            SeoPage::query()->create([
                'page' => $page,
                'meta_title' => [
                    'ar' => (string) trans('site.'.$page.'.meta_title', [], 'ar'),
                    'en' => (string) trans('site.'.$page.'.meta_title', [], 'en'),
                ],
                'meta_description' => [
                    'ar' => (string) trans('site.'.$page.'.meta_description', [], 'ar'),
                    'en' => (string) trans('site.'.$page.'.meta_description', [], 'en'),
                ],
            ]);
        }
    }
}
