<?php

return [

    /*
    | Public contact details for the clinic website.
    | Leave a value empty until it is confirmed. Empty phone, email,
    | and WhatsApp are hidden on the site.
    | WhatsApp, when added, should be digits with the country code.
    |
    | Clinics are added from the dashboard later. Each clinic is independent:
    | name, address, and hours as a string, or ['ar' => '', 'en' => ''].
    | phone is that clinic's number, not the general site phone.
    | map is a search query (address or "latitude,longitude")
    | or a full https URL. It becomes the Google Maps link.
    | photos is a list of public paths or https URLs for that branch.
    */

    'phone' => '',
    'email' => '',
    'whatsapp' => '',
    'facebook' => 'https://www.facebook.com/dr.taha.fayed',
    'youtube' => 'http://0.0.0.0:8080/ar/contact',
    'tiktok' => 'http://0.0.0.0:8080/ar/contact',
    'clinics' => [
        [
            'id' => 'maadi',
            'name' => ['ar' => 'عيادة المعادي', 'en' => 'Maadi clinic'],
            'address' => ['ar' => '١٢ شارع النيل، المعادي، الدور الثاني', 'en' => '12 Nile Street, Maadi, 2nd floor'],
            'hours' => ['ar' => 'الأحد والأربعاء: من 7 إلى 10 مساءً', 'en' => 'Sunday and Wednesday, 7 to 10 pm'],
            'phone' => '01000000001',
            'map' => 'Nile Street, Maadi, Cairo',
            'photos' => [
                'assets/images/dr-1.jpeg',
                'assets/images/dr-2.jpeg',
                'assets/images/dr-3.jpeg',
            ],
        ],
        [
            'id' => 'mohandessin',
            'name' => ['ar' => 'عيادة المهندسين', 'en' => 'Mohandessin clinic'],
            'address' => ['ar' => '٨ شارع جامعة الدول العربية، المهندسين، الدور الثالث', 'en' => '8 Gamet El Dewal Street, Mohandessin, 3rd floor'],
            'hours' => ['ar' => 'الاثنين والخميس: من 7 إلى 10 مساءً', 'en' => 'Monday and Thursday, 7 to 10 pm'],
            'phone' => '01000000002',
            'map' => 'Gamet El Dewal Al Arabeya, Mohandessin, Giza',
            'photos' => [
                'assets/images/dr-2.jpeg',
                'assets/images/dr-4.jpeg',
            ],
        ],
        [
            'id' => 'tagamoa',
            'name' => ['ar' => 'عيادة التجمع', 'en' => 'New Cairo clinic'],
            'address' => ['ar' => 'التجمع الخامس، شارع التسعين الشمالي، عمارة ١٢، الدور الثالث', 'en' => 'Fifth Settlement, North 90th Street, building 12, 3rd floor'],
            'hours' => ['ar' => 'السبت: من 5 إلى 7 مساءً', 'en' => 'Saturday, 5 to 7 pm'],
            'phone' => '01000000003',
            'map' => 'North 90th Street, Fifth Settlement, New Cairo',
            'photos' => [
                'assets/images/dr-3.jpeg',
                'assets/images/dr-1.jpeg',
            ],
        ],
    ],

];
