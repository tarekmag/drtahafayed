<?php

/*
|--------------------------------------------------------------------------
| DEMO DATA — medical articles, to be managed from the dashboard
|--------------------------------------------------------------------------
| slug: URL segment. published_at: Y-m-d. read_minutes: integer.
| category / title / excerpt: plain text, string or ['ar' => '', 'en' => ''].
| body: trusted editor HTML, printed unescaped. <h2> headings build the
| table of contents on the article page.
| cover: public path or https URL.
*/

return [
    'items' => [
        [
            'slug' => 'thyroid-overview',
            'sort' => 1,
            'is_active' => true,
            'published_at' => '2026-09-28',
            'read_minutes' => 5,
            'cover' => 'frontend/images/services/thyroid.svg',
            'category' => ['ar' => 'الغدة الدرقية', 'en' => 'Thyroid'],
            'title' => ['ar' => 'الغدة الدرقية: متى يُطلب رأي جراحي؟', 'en' => 'The thyroid: when is a surgical opinion needed?'],
            'excerpt' => [
                'ar' => 'العقدة أو التضخم في الرقبة بداية تقييم، لا حكمًا نهائيًا. تعرّف على خطوات التشخيص ومتى تُطرح الجراحة.',
                'en' => 'A neck lump or nodule is the start of an assessment, not a verdict. Learn the diagnostic steps and when surgery is considered.',
            ],
            'body' => [
                'ar' => '<h2>أين تقع الغدة وما وظيفتها؟</h2><p>الغدة الدرقية غدة صغيرة على شكل فراشة في أسفل مقدمة الرقبة. تفرز هرمونات تؤثر في الطاقة والوزن وضربات القلب وحرارة الجسم.</p><p>زيادة الحجم أو ظهور عقدة داخل الغدة أمر شائع، ونسبة كبيرة منها حميدة.</p><h2>متى يُطلب رأي جراحي؟</h2><p>يأتي الرأي الجراحي عادة بعد فحص سريري وتحاليل وأشعة، وأحيانًا عينة خلايا. من أسبابه:</p><ul><li>تضخم يسبب ضغطًا على التنفس أو البلع.</li><li>عقدة مشتبه فيها في الأشعة أو العينة.</li><li>فرط نشاط لا يستجيب للعلاج الدوائي.</li></ul><h2>ماذا يُشرح قبل القرار؟</h2><p>يجب أن يفهم المريض سبب الجراحة، ومدى الاستئصال، وأثر ذلك على الهرمونات والمتابعة، والمضاعفات المحتملة بشكل عام.</p><blockquote>طلب الرأي الجراحي لا يعني أن العملية مقررة؛ قد تكون النتيجة متابعة دورية فقط.</blockquote><h2>الخلاصة</h2><p>أي تورم في الرقبة أو تغيّر مستمر في الصوت أو البلع يستحق التقييم، والقرار يُبنى على الفحص لا على القلق.</p>',
                'en' => '<h2>Where is the gland and what does it do?</h2><p>The thyroid is a small butterfly-shaped gland low in the front of the neck. Its hormones affect energy, weight, heart rate and body temperature.</p><p>An enlarged gland or a nodule is common, and most are benign.</p><h2>When is a surgical opinion needed?</h2><p>A surgical opinion usually follows an examination, blood tests and imaging, and sometimes a needle biopsy. Reasons include:</p><ul><li>A goitre pressing on breathing or swallowing.</li><li>A suspicious nodule on ultrasound or biopsy.</li><li>Overactivity that does not respond to medication.</li></ul><h2>What should be explained before deciding?</h2><p>The patient should understand why surgery is advised, how much of the gland will be removed, the effect on hormones and follow-up, and the possible complications.</p><blockquote>Asking for a surgical opinion does not mean an operation is decided; the outcome may simply be regular follow-up.</blockquote><h2>In short</h2><p>Any neck swelling or lasting change in voice or swallowing deserves assessment, and decisions should rest on examination rather than worry.</p>',
            ],
        ],
        [
            'slug' => 'before-surgery-questions',
            'sort' => 2,
            'is_active' => true,
            'published_at' => '2026-09-14',
            'read_minutes' => 4,
            'cover' => 'assets/images/dr-3.jpeg',
            'category' => ['ar' => 'قبل الجراحة', 'en' => 'Before surgery'],
            'title' => ['ar' => '7 أسئلة اسألها لجراحك قبل أي عملية', 'en' => '7 questions to ask your surgeon before any operation'],
            'excerpt' => [
                'ar' => 'لماذا هذه العملية؟ وما البدائل؟ وكيف سيكون التعافي؟ أسئلة بسيطة تجعل قرارك أوضح وأكثر طمأنينة.',
                'en' => 'Why this operation? What are the alternatives? What will recovery look like? Simple questions that make your decision clearer.',
            ],
            'body' => [
                'ar' => '<h2>لماذا أحتاج هذه العملية؟</h2><p>اطلب شرحًا واضحًا للتشخيص، وما الذي ستعالجه الجراحة تحديدًا.</p><h2>ما البدائل المتاحة؟</h2><p>اسأل عن العلاج الدوائي أو المتابعة، وماذا يحدث لو أُجّلت العملية.</p><h2>ما نوع العملية ومدتها؟</h2><p>هل هي بالمنظار أم مفتوحة؟ وكم تستغرق؟ وما نوع التخدير؟</p><h2>ما المضاعفات المحتملة؟</h2><p>كل عملية لها مخاطر عامة وخاصة. معرفتها مسبقًا جزء من الموافقة الواعية.</p><h2>كيف سيكون التعافي؟</h2><ul><li>كم يومًا في المستشفى؟</li><li>متى أعود للعمل والرياضة؟</li><li>ما العلامات التي تستدعي الاتصال فورًا؟</li></ul><h2>ما الفحوصات المطلوبة قبلها؟</h2><p>تحاليل الدم ورسم القلب وأي أشعة إضافية، وتعليمات الصيام والأدوية.</p><h2>من سيتابعني بعد العملية؟</h2><p>اعرف موعد المتابعة الأولى، وكيف تتواصل مع العيادة إذا احتجت.</p>',
                'en' => '<h2>Why do I need this operation?</h2><p>Ask for a clear explanation of the diagnosis and exactly what surgery will treat.</p><h2>What are the alternatives?</h2><p>Ask about medication or observation, and what happens if surgery is postponed.</p><h2>What kind of operation is it?</h2><p>Is it keyhole or open? How long does it take? What type of anaesthesia?</p><h2>What are the possible complications?</h2><p>Every operation carries general and specific risks. Knowing them is part of informed consent.</p><h2>What will recovery look like?</h2><ul><li>How many days in hospital?</li><li>When can I return to work and exercise?</li><li>Which warning signs need an urgent call?</li></ul><h2>Which tests are needed beforehand?</h2><p>Blood tests, an ECG and any extra imaging, plus fasting and medication instructions.</p><h2>Who will follow me up?</h2><p>Know the date of the first follow-up and how to reach the clinic if needed.</p>',
            ],
        ],
        [
            'slug' => 'gallstones-guide',
            'sort' => 3,
            'is_active' => true,
            'published_at' => '2026-08-30',
            'read_minutes' => 6,
            'cover' => 'frontend/images/services/laparoscopy.svg',
            'category' => ['ar' => 'الجراحة العامة', 'en' => 'General surgery'],
            'title' => ['ar' => 'حصوات المرارة: متى تحتاج إلى استئصال بالمنظار؟', 'en' => 'Gallstones: when is laparoscopic removal needed?'],
            'excerpt' => [
                'ar' => 'ليست كل حصوة في المرارة تحتاج جراحة. تعرّف على الأعراض التي تستدعي التدخل وما يحدث في عملية المنظار.',
                'en' => 'Not every gallstone needs surgery. Learn which symptoms call for treatment and what happens in a keyhole operation.',
            ],
            'body' => [
                'ar' => '<h2>ما هي حصوات المرارة؟</h2><p>ترسبات صلبة تتكون داخل المرارة، وقد لا تسبب أي أعراض لسنوات.</p><h2>متى تصبح مشكلة؟</h2><ul><li>ألم متكرر في أعلى يمين البطن بعد الأكل.</li><li>التهاب المرارة الحاد.</li><li>انسداد القناة المرارية أو الصفراء.</li><li>التهاب البنكرياس الناتج عن الحصوات.</li></ul><h2>استئصال المرارة بالمنظار</h2><p>هو العلاج الأكثر شيوعًا للحصوات المسببة للأعراض، ويُجرى من فتحات صغيرة، ويغادر أغلب المرضى في نفس اليوم أو اليوم التالي.</p><h2>هل يمكن العيش بدون مرارة؟</h2><p>نعم. تستمر الكبد في إفراز العصارة الصفراوية، ويتأقلم الجسم خلال أسابيع قليلة.</p>',
                'en' => '<h2>What are gallstones?</h2><p>Hard deposits that form inside the gallbladder and may cause no symptoms for years.</p><h2>When do they become a problem?</h2><ul><li>Recurrent upper-right abdominal pain after meals.</li><li>Acute gallbladder inflammation.</li><li>Blocked bile ducts or jaundice.</li><li>Gallstone pancreatitis.</li></ul><h2>Laparoscopic gallbladder removal</h2><p>The most common treatment for symptomatic gallstones, done through small incisions; most patients go home the same or next day.</p><h2>Can you live without a gallbladder?</h2><p>Yes. The liver keeps producing bile, and the body adapts within a few weeks.</p>',
            ],
        ],
        [
            'slug' => 'parathyroid-calcium',
            'sort' => 4,
            'is_active' => true,
            'published_at' => '2026-08-12',
            'read_minutes' => 4,
            'cover' => 'frontend/images/services/parathyroid.svg',
            'category' => ['ar' => 'الغدد', 'en' => 'Glands'],
            'title' => ['ar' => 'ارتفاع الكالسيوم: هل السبب الغدد الجار درقية؟', 'en' => 'High calcium: are the parathyroid glands to blame?'],
            'excerpt' => [
                'ar' => 'تحليل روتيني قد يكشف ارتفاع الكالسيوم. متى نشك في الغدد الجار درقية، وكيف يتم التشخيص والعلاج؟',
                'en' => 'A routine blood test may reveal high calcium. When do we suspect the parathyroids, and how are they diagnosed and treated?',
            ],
            'body' => [
                'ar' => '<h2>علاقة الغدد بالكالسيوم</h2><p>تتحكم الغدد الجار درقية في مستوى الكالسيوم بالدم. نشاط إحداها الزائد يرفع الكالسيوم بشكل مستمر.</p><h2>أعراض غير واضحة</h2><p>كثير من المرضى يشعرون بإرهاق عام أو ضعف تركيز أو آلام عظام، دون أن يربطوا ذلك بالكالسيوم.</p><h2>التشخيص</h2><ul><li>تحليل الكالسيوم وهرمون الغدة الجار درقية معًا.</li><li>فحص كثافة العظام ووظائف الكلى.</li><li>أشعة لتحديد الغدة المسببة.</li></ul><h2>العلاج</h2><p>الجراحة هي العلاج النهائي في أغلب الحالات، وغالبًا تُجرى من جرح صغير بعد تحديد الغدة بدقة.</p>',
                'en' => '<h2>The glands and calcium</h2><p>The parathyroid glands control blood calcium. When one is overactive, calcium stays high.</p><h2>Vague symptoms</h2><p>Many patients feel general fatigue, poor concentration or bone aches without linking them to calcium.</p><h2>Diagnosis</h2><ul><li>Calcium and parathyroid hormone measured together.</li><li>Bone density and kidney function.</li><li>Imaging to locate the affected gland.</li></ul><h2>Treatment</h2><p>Surgery is the definitive treatment in most cases, often through a small incision once the gland is located.</p>',
            ],
        ],
        [
            'slug' => 'breast-lump',
            'sort' => 5,
            'is_active' => true,
            'published_at' => '2026-07-26',
            'read_minutes' => 5,
            'cover' => 'frontend/images/services/oncology.svg',
            'category' => ['ar' => 'جراحة الأورام', 'en' => 'Surgical oncology'],
            'title' => ['ar' => 'كتلة في الثدي: خطوات التشخيص بهدوء', 'en' => 'A breast lump: calm steps to a diagnosis'],
            'excerpt' => [
                'ar' => 'أغلب كتل الثدي حميدة، لكن التقييم المبكر مهم. ما الفحوصات المطلوبة، وكيف تُتخذ القرارات؟',
                'en' => 'Most breast lumps are benign, but early assessment matters. Which tests are needed, and how are decisions made?',
            ],
            'body' => [
                'ar' => '<h2>لا داعي للذعر</h2><p>نسبة كبيرة من كتل الثدي حميدة، مثل الأكياس والأورام الليفية. لكن أي كتلة جديدة تستحق الفحص.</p><h2>التقييم الثلاثي</h2><ul><li>الفحص السريري.</li><li>الأشعة: موجات صوتية و/أو ماموجرام.</li><li>عينة بالإبرة عند الحاجة.</li></ul><h2>إذا كانت النتيجة ورمًا خبيثًا</h2><p>تُناقش الحالة مع فريق متعدد التخصصات لتحديد ترتيب العلاج، مع الحرص على الحفاظ على الثدي كلما أمكن.</p><h2>الفحص الذاتي</h2><p>الفحص الذاتي الشهري يساعد على ملاحظة أي تغيّر مبكرًا، لكنه لا يغني عن الفحص الدوري.</p>',
                'en' => '<h2>No need to panic</h2><p>Many breast lumps are benign, such as cysts and fibroadenomas. Still, any new lump deserves assessment.</p><h2>Triple assessment</h2><ul><li>Clinical examination.</li><li>Imaging: ultrasound and/or mammography.</li><li>Needle biopsy when needed.</li></ul><h2>If the result is cancer</h2><p>The case is discussed with a multidisciplinary team to plan treatment, preserving the breast whenever possible.</p><h2>Self-examination</h2><p>Monthly self-examination helps notice changes early, but does not replace regular screening.</p>',
            ],
        ],
        [
            'slug' => 'recovery-after-surgery',
            'sort' => 6,
            'is_active' => true,
            'published_at' => '2026-07-10',
            'read_minutes' => 4,
            'cover' => 'assets/images/dr-4.jpeg',
            'category' => ['ar' => 'بعد الجراحة', 'en' => 'After surgery'],
            'title' => ['ar' => 'أسبوعك الأول بعد العملية: دليل عملي', 'en' => 'Your first week after surgery: a practical guide'],
            'excerpt' => [
                'ar' => 'العناية بالجرح، والأكل، والحركة، والعلامات التي تستدعي الاتصال بالطبيب. نصائح بسيطة لتعافٍ أسرع.',
                'en' => 'Wound care, food, movement and the warning signs that need a call. Simple tips for a faster recovery.',
            ],
            'body' => [
                'ar' => '<h2>العناية بالجرح</h2><p>حافظ على الجرح نظيفًا وجافًا، واتبع تعليمات تغيير الغيار. الاستحمام عادة مسموح بعد 48 ساعة ما لم يُذكر غير ذلك.</p><h2>الحركة المبكرة</h2><p>المشي الخفيف من اليوم الأول يقلل خطر الجلطات ويسرّع التعافي.</p><h2>الأكل والشرب</h2><p>ابدأ بالسوائل ثم الأطعمة الخفيفة، وأكثر من الماء والألياف لتجنب الإمساك.</p><h2>متى تتصل بالطبيب فورًا؟</h2><ul><li>حرارة أعلى من 38 درجة.</li><li>احمرار أو إفرازات من الجرح.</li><li>ألم شديد لا يستجيب للمسكنات.</li><li>ضيق في التنفس أو تورم في الساق.</li></ul>',
                'en' => '<h2>Wound care</h2><p>Keep the wound clean and dry and follow the dressing instructions. Showering is usually allowed after 48 hours unless told otherwise.</p><h2>Early movement</h2><p>Light walking from day one lowers the risk of clots and speeds recovery.</p><h2>Food and drink</h2><p>Start with fluids, then light meals, with plenty of water and fibre to avoid constipation.</p><h2>When to call the doctor straight away</h2><ul><li>Temperature above 38°C.</li><li>Redness or discharge from the wound.</li><li>Severe pain not relieved by painkillers.</li><li>Shortness of breath or a swollen leg.</li></ul>',
            ],
        ],
    ],
];
