<?php

/*
|--------------------------------------------------------------------------
| DEMO DATA — photo gallery, to be managed from the dashboard
|--------------------------------------------------------------------------
| image: public path or https URL.
| category: doctor | clinic | events (labels live in lang/ar and lang/en).
| caption: string or ['ar' => '', 'en' => ''], also used as alt text.
| Clinic photos are the real interiors and the CMC branch exterior.
*/

return [
    'items' => [
        [
            'sort' => 1,
            'is_active' => true,
            'image' => 'assets/images/dr-1.jpeg',
            'category' => 'doctor',
            'caption' => ['ar' => 'د. طه فايد في العيادة', 'en' => 'Dr. Taha Fayed at the clinic'],
        ],
        [
            'sort' => 2,
            'is_active' => true,
            'image' => 'assets/images/dr-2.jpeg',
            'category' => 'doctor',
            'caption' => ['ar' => 'بورتريه رسمي للدكتور طه فايد', 'en' => 'Official portrait of Dr. Taha Fayed'],
        ],
        [
            'sort' => 3,
            'is_active' => true,
            'image' => 'assets/images/clinic-1.jpeg',
            'category' => 'clinic',
            'caption' => ['ar' => 'استقبال العيادة', 'en' => 'Clinic reception'],
        ],
        [
            'sort' => 4,
            'is_active' => true,
            'image' => 'assets/images/clinic-3.jpeg',
            'category' => 'clinic',
            'caption' => ['ar' => 'عيادة التجمع الخامس، مول CMC', 'en' => 'Fifth Settlement clinic, CMC Mall'],
        ],
        [
            'sort' => 5,
            'is_active' => true,
            'image' => 'assets/images/clinic-2.jpeg',
            'category' => 'clinic',
            'caption' => ['ar' => 'غرفة الكشف', 'en' => 'Consultation room'],
        ],
        [
            'sort' => 6,
            'is_active' => true,
            'image' => 'assets/images/dr-3.jpeg',
            'category' => 'doctor',
            'caption' => ['ar' => 'د. طه فايد أثناء الاستشارة', 'en' => 'Dr. Taha Fayed during a consultation'],
        ],
        [
            'sort' => 7,
            'is_active' => true,
            'image' => 'assets/images/dr-1.jpeg',
            'category' => 'events',
            'caption' => ['ar' => 'محاضرة عن جراحات الغدة الدرقية', 'en' => 'Lecture on thyroid surgery'],
        ],
        [
            'sort' => 8,
            'is_active' => true,
            'image' => 'assets/images/dr-4.jpeg',
            'category' => 'events',
            'caption' => ['ar' => 'المؤتمر السنوي للجراحين', 'en' => 'Annual surgeons conference'],
        ],
    ],
];
