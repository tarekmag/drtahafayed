<?php

/*
|--------------------------------------------------------------------------
| Seed source for the homepage FAQs. Edit them from the dashboard.
|--------------------------------------------------------------------------
| q / a: string or ['ar' => '', 'en' => '']. Answers are plain text.
*/

return [
    'items' => [
        [
            'sort' => 1,
            'is_active' => true,
            'q' => ['ar' => 'كيف أحجز موعدًا؟', 'en' => 'How do I book an appointment?'],
            'a' => [
                'ar' => 'يمكنك الحجز بالاتصال برقم الفرع مباشرة، أو بإرسال رسالة على واتساب، أو من خلال نموذج التواصل في الموقع.',
                'en' => 'Call the branch directly, send a WhatsApp message, or use the contact form on this website.',
            ],
        ],
        [
            'sort' => 2,
            'is_active' => true,
            'q' => ['ar' => 'ما مواعيد العيادات؟', 'en' => 'What are the clinic hours?'],
            'a' => [
                'ar' => 'لكل فرع أيام ومواعيد محددة تجدها في صفحة الفروع والمواعيد، ويُفضّل الحجز المسبق.',
                'en' => 'Each branch has set days and hours listed on the branches page. Booking ahead is recommended.',
            ],
        ],
        [
            'sort' => 3,
            'is_active' => true,
            'q' => ['ar' => 'ماذا أحضر معي في الزيارة الأولى؟', 'en' => 'What should I bring to the first visit?'],
            'a' => [
                'ar' => 'أحضر أي تحاليل أو أشعة أو تقارير طبية سابقة، وقائمة بالأدوية التي تتناولها حاليًا.',
                'en' => 'Bring any previous tests, scans or medical reports, and a list of your current medications.',
            ],
        ],
        [
            'sort' => 4,
            'is_active' => true,
            'q' => ['ar' => 'هل تتعاملون مع شركات التأمين؟', 'en' => 'Do you accept insurance?'],
            'a' => [
                'ar' => 'نتعامل مع عدد من شركات التأمين الطبي. تواصل مع الفرع لتأكيد التغطية قبل موعدك.',
                'en' => 'We work with several medical insurance providers. Contact the branch to confirm coverage before your visit.',
            ],
        ],
        [
            'sort' => 5,
            'is_active' => true,
            'q' => ['ar' => 'كيف تتم المتابعة بعد العملية؟', 'en' => 'How is follow-up handled after surgery?'],
            'a' => [
                'ar' => 'يُحدد موعد متابعة قبل خروجك من المستشفى، ويمكنك التواصل مع العيادة على واتساب لأي استفسار عاجل.',
                'en' => 'A follow-up visit is booked before you leave hospital, and you can reach the clinic on WhatsApp for urgent questions.',
            ],
        ],
        [
            'sort' => 6,
            'is_active' => true,
            'q' => ['ar' => 'هل يمكن الاستشارة أونلاين؟', 'en' => 'Are online consultations available?'],
            'a' => [
                'ar' => 'يمكن مراجعة التقارير والأشعة مبدئيًا عبر واتساب، لكن القرار الجراحي يحتاج دائمًا إلى كشف مباشر.',
                'en' => 'Reports and scans can be reviewed initially over WhatsApp, but a surgical decision always requires an in-person visit.',
            ],
        ],
    ],
];
