<?php

/*
|--------------------------------------------------------------------------
| DEMO DATA — replace from the dashboard before launch
|--------------------------------------------------------------------------
| Everything below (credentials, stats, phones, addresses, hours) is sample
| content so the doctor can review the design. None of it is verified.
|
| Text fields: a string, or ['ar' => '', 'en' => ''].
| HTML fields (doctor.bio): trusted editor HTML, printed unescaped.
| whatsapp: digits with the country code.
| booking_url: empty sends visitors to the contact page.
|
| clinics.*.days: working weekdays, 0 = Sunday … 6 = Saturday.
| clinics.*.opens / closes: 24h "HH:MM", used for the "next session" card.
| clinics.*.map: search query, "lat,lng", or a full https URL.
| clinics.*.photos: public paths or https URLs.
*/

return [

    'phone' => '01029305718',
    'phone_secondary' => '01507003099',
    'whatsapp' => '201029305718',
    'email' => 'Tahafayed40@gmail.com',
    'booking_url' => '',

    'facebook' => 'https://www.facebook.com/dr.taha.fayed',
    'instagram' => 'https://www.instagram.com/taha_fayed_clinic',
    'vezeeta' => 'https://www.vezeeta.com/ar/dr/%D8%AF%D9%83%D8%AA%D9%88%D8%B1-%D8%B7%D9%87-%D9%81%D8%A7%D9%8A%D8%AF-%D8%AC%D8%B1%D8%A7%D8%AD%D8%A9-%D8%B9%D8%A7%D9%85%D8%A9',
    'youtube' => 'http://0.0.0.0:8080/ar/contact',
    'tiktok' => 'http://0.0.0.0:8080/ar/contact',

    'doctor' => [
        'name' => ['ar' => 'د. طه فايد', 'en' => 'Dr. Taha Fayed'],
        'title' => [
            'ar' => 'استشاري الجراحة العامة وجراحات الأورام والغدد',
            'en' => 'Consultant in General, Oncologic and Gland Surgery',
        ],
        'summary' => [
            'ar' => 'رعاية جراحية دقيقة تبدأ بالاستماع، وتشرح كل خطوة بوضوح قبل أي قرار.',
            'en' => 'Precise surgical care that starts with listening and explains every step before any decision.',
        ],
        'bio' => [
            'ar' => '<p>د. طه فايد استشاري الجراحة العامة وجراحات الأورام والغدد، ويعمل في تشخيص وعلاج حالات الغدة الدرقية والجار درقية، وأورام الثدي والجهاز الهضمي، وجراحات البطن بالمنظار.</p><p>يؤمن بأن المريض شريك في القرار. لذلك تبدأ الزيارة بشرح هادئ للتشخيص، ثم عرض الخيارات المتاحة بمزاياها وحدودها، قبل الاتفاق على خطة العلاج.</p><p>يتابع المريض بعد العملية خطوة بخطوة حتى التعافي الكامل، بالتنسيق مع فريق متعدد التخصصات عند الحاجة.</p>',
            'en' => '<p>Dr. Taha Fayed is a consultant in general, oncologic and gland surgery. His work covers thyroid and parathyroid disease, breast and digestive tract tumours, and laparoscopic abdominal surgery.</p><p>He treats the patient as a partner in every decision. A visit starts with a calm explanation of the diagnosis and the available options, with their benefits and limits, before a treatment plan is agreed.</p><p>Follow-up continues step by step after surgery until full recovery, in coordination with a multidisciplinary team when needed.</p>',
        ],
        'credentials' => [
            ['ar' => 'استشاري الجراحة العامة وجراحات الأورام والغدد', 'en' => 'Consultant in General, Oncologic and Gland Surgery'],
            ['ar' => 'دكتوراة جراحات الأورام وعلاج وجراحات الغدد', 'en' => 'MD in Oncologic Surgery and Gland Treatment and Surgery'],
            ['ar' => 'ماجستير الجراحة العامة وجراحات المناظير', 'en' => 'MSc in General and Laparoscopic Surgery'],
            ['ar' => 'عضو الجمعية المصرية لجراحات الأورام', 'en' => 'Member of the Egyptian Society of Surgical Oncology'],
            ['ar' => 'زميل كلية الجراحين الملكية بلندن', 'en' => 'Fellow of the Royal College of Surgeons of England'],
            ['ar' => 'دبلومة علاج وجراحات الغدة الدرقية', 'en' => 'Diploma in Thyroid Treatment and Surgery'],
            ['ar' => 'عضو الجمعية الأمريكية لجراحات الثدي', 'en' => 'Member of the American Society of Breast Surgeons'],
        ],
        'stats' => [
            ['value' => 15, 'suffix' => '+', 'label' => ['ar' => 'سنة خبرة', 'en' => 'Years of experience']],
            ['value' => 4000, 'suffix' => '+', 'label' => ['ar' => 'عملية جراحية', 'en' => 'Operations performed']],
            ['value' => 5, 'suffix' => '', 'label' => ['ar' => 'فروع', 'en' => 'Clinics']],
            ['value' => 98, 'suffix' => '%', 'label' => ['ar' => 'رضا المرضى', 'en' => 'Patient satisfaction']],
        ],
        'hero_image' => 'assets/images/dr-1.jpeg',
        'portrait' => 'assets/images/dr-2.jpeg',
    ],

    'clinics' => [
        [
            'id' => 'heliopolis',
            'sort' => 1,
            'is_active' => true,
            'name' => ['ar' => 'عيادة مصر الجديدة', 'en' => 'Heliopolis clinic'],
            'address' => [
                'ar' => '160 شارع الحجاز، بجوار بي تك وبنك CIB',
                'en' => '160 Hegaz Street, next to B.TECH and CIB Bank',
            ],
            'hours' => ['ar' => '', 'en' => ''],
            'days' => [],
            'opens' => '',
            'closes' => '',
            'phone' => '',
            'map' => '160 Hegaz Street, Heliopolis, Cairo',
            'photos' => [
                'assets/images/clinic-1.jpeg',
                'assets/images/clinic-2.jpeg',
            ],
        ],
        [
            'id' => 'tagamoa',
            'sort' => 2,
            'is_active' => true,
            'name' => ['ar' => 'عيادة التجمع الخامس', 'en' => 'Fifth Settlement clinic'],
            'address' => [
                'ar' => 'مول CMC، التسعين الشمالي، بجوار مستشفى شفا',
                'en' => 'CMC Mall, North 90th Street, next to Shifa Hospital',
            ],
            'hours' => ['ar' => '', 'en' => ''],
            'days' => [],
            'opens' => '',
            'closes' => '',
            'phone' => '',
            'map' => 'CMC Cairo Medical Center, North 90th Street, Fifth Settlement, New Cairo',
            'photos' => [
                'assets/images/clinic-3.jpeg',
            ],
        ],
        [
            'id' => 'obour',
            'sort' => 3,
            'is_active' => true,
            'name' => ['ar' => 'عيادة العبور', 'en' => 'Obour clinic'],
            'address' => [
                'ar' => 'سنتر الشريف، الحي الأول، خلف سنتر العبور',
                'en' => 'Al Sherif Centre, First District, behind Obour Centre',
            ],
            'hours' => ['ar' => '', 'en' => ''],
            'days' => [],
            'opens' => '',
            'closes' => '',
            'phone' => '',
            'map' => 'Al Sherif Center, First District, Obour City',
            'photos' => [],
        ],
        [
            'id' => 'marg',
            'sort' => 4,
            'is_active' => true,
            'name' => ['ar' => 'عيادة المرج', 'en' => 'El Marg clinic'],
            'address' => [
                'ar' => 'أمام مستشفى اليوم الواحد، شارع مؤسسة الزكاة',
                'en' => 'Opposite the One Day Hospital, Moassaset Al Zakah Street',
            ],
            'hours' => ['ar' => '', 'en' => ''],
            'days' => [],
            'opens' => '',
            'closes' => '',
            'phone' => '',
            'map' => 'One Day Hospital, Moassaset Al Zakah Street, El Marg, Cairo',
            'photos' => [],
        ],
        [
            'id' => 'khosous',
            'sort' => 5,
            'is_active' => true,
            'name' => ['ar' => 'عيادة الخصوص', 'en' => 'El Khosous clinic'],
            'address' => [
                'ar' => 'أمام مدرسة الخلفاء، خلف قسم شرطة الخصوص',
                'en' => 'Opposite Al Khulafa School, behind El Khosous Police Station',
            ],
            'hours' => ['ar' => '', 'en' => ''],
            'days' => [],
            'opens' => '',
            'closes' => '',
            'phone' => '',
            'map' => 'Al Khulafa School, El Khosous, Qalyubia',
            'photos' => [],
        ],
    ],

];
