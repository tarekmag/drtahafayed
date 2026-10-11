<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Seed the demo medical services.
     */
    public function run(): void
    {
        if (DB::table('services')->exists()) {
            return;
        }

        $now = now();

        DB::table('services')->insert(array_map(function (array $service) use ($now) {
            return [
                'slug' => $service['slug'],
                'specialty' => $service['specialty'],
                'icon' => $service['icon'],
                'image' => $service['image'] ?? null,
                'video' => $service['video'] ?? null,
                'title' => $this->json($service['title']),
                'excerpt' => $this->json($service['excerpt']),
                'body' => $this->json($service['body']),
                'faqs' => $this->json($service['faqs'] ?? []),
                'conditions' => $this->json($service['conditions'] ?? []),
                'related' => $this->json($service['related'] ?? []),
                'sort' => $service['sort'] ?? 0,
                'is_active' => $service['is_active'] ?? true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, config('medical_services.items', [])));
    }

    private function json(mixed $value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    }
}
