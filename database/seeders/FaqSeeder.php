<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Seed the homepage FAQs.
     */
    public function run(): void
    {
        if (DB::table('faqs')->exists()) {
            return;
        }

        $now = now();

        DB::table('faqs')->insert(array_map(function (array $faq) use ($now) {
            return [
                'question' => $this->json($faq['q']),
                'answer' => $this->json($faq['a']),
                'sort' => $faq['sort'] ?? 0,
                'is_active' => $faq['is_active'] ?? true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, config('faqs.items', [])));
    }

    private function json(mixed $value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    }
}
