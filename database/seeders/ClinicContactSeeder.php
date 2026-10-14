<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicContactSeeder extends Seeder
{
    /**
     * Seed the clinic contact details.
     */
    public function run(): void
    {
        if (DB::table('clinic_contacts')->exists()) {
            return;
        }

        $now = now();

        DB::table('clinic_contacts')->insert([
            'phone' => '01507003099',
            'whatsapp' => '201507003099',
            'email' => 'clinic@drtahafayed.com',
            'booking_url' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
