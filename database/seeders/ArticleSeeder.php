<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Seed the demo articles.
     */
    public function run(): void
    {
        if (DB::table('articles')->exists()) {
            return;
        }

        $now = now();

        DB::table('articles')->insert(array_map(function (array $article) use ($now) {
            return [
                'slug' => $article['slug'],
                'category' => $this->json($article['category']),
                'title' => $this->json($article['title']),
                'excerpt' => $this->json($article['excerpt']),
                'body' => $this->json($article['body']),
                'published_at' => $article['published_at'],
                'read_minutes' => $article['read_minutes'],
                'cover' => $article['cover'] ?? null,
                'sort' => $article['sort'] ?? 0,
                'is_active' => $article['is_active'] ?? true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, config('articles.items', [])));
    }

    private function json(mixed $value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    }
}
