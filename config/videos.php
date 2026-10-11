<?php

/*
|--------------------------------------------------------------------------
| DEMO DATA — videos, to be managed from the dashboard
|--------------------------------------------------------------------------
| url: YouTube/Vimeo URL, mp4/webm path, or https embed URL.
| cover: public path or https URL. Empty uses the YouTube thumbnail.
| duration: display text such as "4:12". service: optional slug.
| The demo links are public educational videos from other channels.
*/

return [
    'items' => [
        [
            'sort' => 1,
            'is_active' => true,
            'url' => 'https://www.youtube.com/watch?v=WvQRdl4H_DA',
            'cover' => 'assets/images/dr-1.jpeg',
            'duration' => '3:05',
            'service' => 'thyroid',
            'title' => ['ar' => 'كيف تتم عملية الغدة الدرقية؟', 'en' => 'How is thyroid surgery performed?'],
        ],
        [
            'sort' => 2,
            'is_active' => true,
            'url' => 'https://www.youtube.com/watch?v=sD9st1ZPFrQ',
            'cover' => 'assets/images/dr-3.jpeg',
            'duration' => '4:20',
            'service' => 'parathyroid',
            'title' => ['ar' => 'الغدد الجار درقية وارتفاع الكالسيوم', 'en' => 'Parathyroid glands and high calcium'],
        ],
        [
            'sort' => 3,
            'is_active' => true,
            'url' => 'https://www.youtube.com/watch?v=USoQMLuo1P8',
            'cover' => 'assets/images/dr-2.jpeg',
            'duration' => '5:48',
            'service' => 'endocrine',
            'title' => ['ar' => 'ماذا تتوقع بعد جراحة الغدد؟', 'en' => 'What to expect after endocrine surgery'],
        ],
        [
            'sort' => 4,
            'is_active' => true,
            'url' => 'https://www.youtube.com/watch?v=WvQRdl4H_DA',
            'cover' => 'assets/images/dr-4.jpeg',
            'duration' => '2:40',
            'service' => 'thyroid',
            'title' => ['ar' => 'هل كل عقدة في الغدة خطيرة؟', 'en' => 'Is every thyroid nodule dangerous?'],
        ],
        [
            'sort' => 5,
            'is_active' => true,
            'url' => 'https://www.youtube.com/watch?v=USoQMLuo1P8',
            'cover' => 'assets/images/dr-3.jpeg',
            'duration' => '3:30',
            'service' => 'general',
            'title' => ['ar' => 'نصائح للأسبوع الأول بعد العملية', 'en' => 'Tips for the first week after surgery'],
        ],
        [
            'sort' => 6,
            'is_active' => true,
            'url' => 'https://www.youtube.com/watch?v=sD9st1ZPFrQ',
            'cover' => 'assets/images/dr-1.jpeg',
            'duration' => '4:05',
            'service' => 'parathyroid',
            'title' => ['ar' => 'متى تحتاج الغدة الجار درقية لجراحة؟', 'en' => 'When does a parathyroid gland need surgery?'],
        ],
    ],
];
