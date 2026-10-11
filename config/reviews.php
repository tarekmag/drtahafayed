<?php

/*
|--------------------------------------------------------------------------
| DEMO DATA — patient reviews, to be managed from the dashboard
|--------------------------------------------------------------------------
| Names and texts below are invented samples for the design review.
| Publish real reviews only with the patient's consent.
| name / place / text: string or ['ar' => '', 'en' => ''].
| rating: 1-5. service: slug from medical_services (optional).
*/

return [
    'items' => [
        [
            'sort' => 1,
            'is_active' => true,
            'rating' => 5,
            'service' => 'thyroid',
            'name' => ['ar' => 'منى أ.', 'en' => 'Mona A.'],
            'place' => ['ar' => 'القاهرة', 'en' => 'Cairo'],
            'text' => [
                'ar' => 'كنت خايفة جدًا من عملية الغدة، لكن الدكتور شرح لي كل حاجة بهدوء ورد على كل أسئلتي. العملية عدت بسلام والجرح تقريبًا مش باين.',
                'en' => 'I was very anxious about thyroid surgery, but the doctor explained everything calmly and answered all my questions. It went smoothly and the scar is barely visible.',
            ],
        ],
        [
            'sort' => 2,
            'is_active' => true,
            'rating' => 5,
            'service' => 'laparoscopy',
            'name' => ['ar' => 'أحمد س.', 'en' => 'Ahmed S.'],
            'place' => ['ar' => 'الجيزة', 'en' => 'Giza'],
            'text' => [
                'ar' => 'عملت استئصال مرارة بالمنظار وخرجت تاني يوم. المتابعة بعد العملية كانت ممتازة والعيادة منظمة جدًا.',
                'en' => 'I had my gallbladder removed laparoscopically and went home the next day. Follow-up was excellent and the clinic is very organised.',
            ],
        ],
        [
            'sort' => 3,
            'is_active' => true,
            'rating' => 5,
            'service' => 'oncology',
            'name' => ['ar' => 'هالة م.', 'en' => 'Hala M.'],
            'place' => ['ar' => 'المعادي', 'en' => 'Maadi'],
            'text' => [
                'ar' => 'دكتور محترم وإنسان قبل ما يكون جراح. وقف جنب والدتي في كل خطوة من التشخيص لحد ما خلصت العلاج.',
                'en' => 'A respectful doctor and a kind person before being a surgeon. He stood by my mother at every step from diagnosis to the end of treatment.',
            ],
        ],
        [
            'sort' => 4,
            'is_active' => true,
            'rating' => 5,
            'service' => 'general',
            'name' => ['ar' => 'كريم ع.', 'en' => 'Karim E.'],
            'place' => ['ar' => 'مدينة نصر', 'en' => 'Nasr City'],
            'text' => [
                'ar' => 'عملية فتق سري، والحمد لله رجعت شغلي بعد أسبوع. أكتر حاجة عجبتني إن الدكتور ما استعجلش في قرار العملية.',
                'en' => 'An umbilical hernia repair, and I was back at work in a week. What I liked most is that the doctor did not rush the decision to operate.',
            ],
        ],
        [
            'sort' => 5,
            'is_active' => true,
            'rating' => 5,
            'service' => 'parathyroid',
            'name' => ['ar' => 'سامية ف.', 'en' => 'Samia F.'],
            'place' => ['ar' => 'التجمع الخامس', 'en' => 'New Cairo'],
            'text' => [
                'ar' => 'سنين وأنا تعبانة من غير ما أعرف السبب. الدكتور اكتشف إن المشكلة في الغدة الجار درقية، وبعد العملية حسيت بفرق كبير.',
                'en' => 'For years I felt unwell without knowing why. The doctor traced it to a parathyroid gland, and after surgery I felt a huge difference.',
            ],
        ],
        [
            'sort' => 6,
            'is_active' => true,
            'rating' => 5,
            'service' => 'thyroid',
            'name' => ['ar' => 'يوسف ح.', 'en' => 'Youssef H.'],
            'place' => ['ar' => 'الإسكندرية', 'en' => 'Alexandria'],
            'text' => [
                'ar' => 'سافرت من إسكندرية مخصوص، وكان يستاهل. شرح واضح، ومواعيد مظبوطة، ومتابعة على الواتساب بعد العملية.',
                'en' => 'I travelled from Alexandria specially, and it was worth it. Clear explanations, punctual appointments and WhatsApp follow-up after surgery.',
            ],
        ],
        [
            'sort' => 7,
            'is_active' => true,
            'rating' => 4,
            'service' => 'endocrine',
            'name' => ['ar' => 'دينا ر.', 'en' => 'Dina R.'],
            'place' => ['ar' => 'المهندسين', 'en' => 'Mohandessin'],
            'text' => [
                'ar' => 'الدكتور خد وقته كامل في الكشف ووضح لي الفرق بين الخيارات. حسيت إني شريكة في القرار مش مجرد مريضة.',
                'en' => 'The doctor took his time and explained the difference between the options. I felt like a partner in the decision, not just a patient.',
            ],
        ],
        [
            'sort' => 8,
            'is_active' => true,
            'rating' => 5,
            'service' => 'oncology',
            'name' => ['ar' => 'محمد ن.', 'en' => 'Mohamed N.'],
            'place' => ['ar' => 'شبرا', 'en' => 'Shubra'],
            'text' => [
                'ar' => 'ربنا يبارك في علمه. العملية كانت صعبة لكن الدكتور وفريقه كانوا على قدر الثقة، والنتيجة الحمد لله ممتازة.',
                'en' => 'May God bless his knowledge. The operation was difficult, but the doctor and his team were worthy of our trust, and the result is excellent.',
            ],
        ],
    ],
];
