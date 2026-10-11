<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotoSeeder extends Seeder
{
    /**
     * Seed the demo gallery photos.
     */
    public function run(): void
    {
        if (DB::table('photos')->exists()) {
            return;
        }

        $now = now();

        DB::table('photos')->insert(array_map(function (array $photo) use ($now) {
            return [
                'image' => $photo['image'],
                'category' => $photo['category'],
                'caption' => json_encode($photo['caption'], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR),
                'sort' => $photo['sort'] ?? 0,
                'is_active' => $photo['is_active'] ?? true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, config('gallery.items', [])));
    }
}
