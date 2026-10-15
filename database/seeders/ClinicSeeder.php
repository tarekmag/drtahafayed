<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicSeeder extends Seeder
{
    /**
     * Seed the clinic branches.
     */
    public function run(): void
    {
        if (DB::table('clinics')->exists()) {
            return;
        }

        $now = now();

        DB::table('clinics')->insert(array_map(fn (array $clinic) => [
            ...$clinic,
            'created_at' => $now,
            'updated_at' => $now,
        ], [
            $this->row('heliopolis', 1, ['ar' => 'عيادة مصر الجديدة', 'en' => 'Heliopolis clinic'], [
                'ar' => '160 شارع الحجاز، بجوار بي تك وبنك CIB',
                'en' => '160 Hegaz Street, next to B.TECH and CIB Bank',
            ], '160 Hegaz Street, Heliopolis, Cairo', [
                'assets/images/clinic-1.jpeg',
                'assets/images/clinic-2.jpeg',
            ]),
            $this->row('tagamoa', 2, ['ar' => 'عيادة التجمع الخامس', 'en' => 'Fifth Settlement clinic'], [
                'ar' => 'مول CMC، التسعين الشمالي، بجوار مستشفى شفا',
                'en' => 'CMC Mall, North 90th Street, next to Shifa Hospital',
            ], 'CMC Cairo Medical Center, North 90th Street, Fifth Settlement, New Cairo', [
                'assets/images/clinic-3.jpeg',
            ]),
            $this->row('obour', 3, ['ar' => 'عيادة العبور', 'en' => 'Obour clinic'], [
                'ar' => 'سنتر الشريف، الحي الأول، خلف سنتر العبور',
                'en' => 'Al Sherif Centre, First District, behind Obour Centre',
            ], 'Al Sherif Center, First District, Obour City'),
            $this->row('marg', 4, ['ar' => 'عيادة المرج', 'en' => 'El Marg clinic'], [
                'ar' => 'أمام مستشفى اليوم الواحد، شارع مؤسسة الزكاة',
                'en' => 'Opposite the One Day Hospital, Moassaset Al Zakah Street',
            ], 'One Day Hospital, Moassaset Al Zakah Street, El Marg, Cairo'),
            $this->row('khosous', 5, ['ar' => 'عيادة الخصوص', 'en' => 'El Khosous clinic'], [
                'ar' => 'أمام مدرسة الخلفاء، خلف قسم شرطة الخصوص',
                'en' => 'Opposite Al Khulafa School, behind El Khosous Police Station',
            ], 'Al Khulafa School, El Khosous, Qalyubia'),
        ]));
    }

    /**
     * @param  array{ar: string, en: string}  $name
     * @param  array{ar: string, en: string}  $address
     * @param  list<string>  $photos
     * @return array<string, mixed>
     */
    private function row(string $slug, int $sort, array $name, array $address, string $map, array $photos = []): array
    {
        return [
            'slug' => $slug,
            'name' => $this->json($name),
            'address' => $this->json($address),
            'days' => $this->json([]),
            'opens' => null,
            'closes' => null,
            'phone' => null,
            'map' => $map,
            'photos' => $this->json($photos),
            'sort' => $sort,
            'is_active' => true,
        ];
    }

    private function json(mixed $value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    }
}
