<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialProfileSeeder extends Seeder
{
    /**
     * Seed the social profile links.
     */
    public function run(): void
    {
        if (DB::table('social_profiles')->exists()) {
            return;
        }

        $now = now();

        DB::table('social_profiles')->insert([
            'facebook' => 'https://www.facebook.com/dr.taha.fayed',
            'instagram' => 'https://www.instagram.com/taha_fayed_clinic',
            'vezeeta' => 'https://www.vezeeta.com/ar/dr/%D8%AF%D9%83%D8%AA%D9%88%D8%B1-%D8%B7%D9%87-%D9%81%D8%A7%D9%8A%D8%AF-%D8%AC%D8%B1%D8%A7%D8%AD%D8%A9-%D8%B9%D8%A7%D9%85%D8%A9',
            'clinido' => 'https://clinido.com/ar/drprofile/91818/7120',
            'youtube' => null,
            'tiktok' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
