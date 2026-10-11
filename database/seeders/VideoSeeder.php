<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    /**
     * Seed the demo videos.
     */
    public function run(): void
    {
        if (DB::table('videos')->exists()) {
            return;
        }

        $now = now();

        DB::table('videos')->insert(array_map(function (array $video) use ($now) {
            return [
                'url' => $video['url'],
                'cover' => $video['cover'] ?? null,
                'duration' => $video['duration'] ?? null,
                'service' => $video['service'] ?? null,
                'title' => json_encode($video['title'], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR),
                'sort' => $video['sort'] ?? 0,
                'is_active' => $video['is_active'] ?? true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, config('videos.items', [])));
    }
}
