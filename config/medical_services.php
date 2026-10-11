<?php

/*
|--------------------------------------------------------------------------
| DEMO DATA — medical services, to be managed from the dashboard
|--------------------------------------------------------------------------
| slug: URL segment, lowercase letters, digits and dashes.
| specialty: general | oncology | endocrine (groups the services page).
| icon: key in components/icon.blade.php.
| image: public path or https URL.
| video: YouTube/Vimeo URL, mp4/webm path, https embed URL, or empty.
| excerpt: plain text for cards.
| body: trusted editor HTML, printed unescaped. Use <h2> for sections.
| faqs: list of ['q' => [ar, en], 'a' => [ar, en]].
| related: slugs shown first under "related services".
| The demo videos are public educational videos from other channels.
*/

return [
    'items' => [
        [
            'slug' => 'general',
            'sort' => 1,
            'is_active' => true,
            'specialty' => 'general',
            'icon' => 'general',
            'image' => 'frontend/images/services/general.svg',
            'video' => 'https://www.youtube.com/watch?v=USoQMLuo1P8',
            'title' => ['ar' => 'الجراحة العامة', 'en' => 'General surgery'],
            'excerpt' => [
                'ar' => 'تشخيص وعلاج حالات البطن والفتق والمرارة والأنسجة الرخوة، بخطة واضحة تناسب كل حالة.',
                'en' => 'Diagnosis and treatment of abdominal, hernia, gallbladder and soft-tissue conditions with a clear plan for each case.',
            ],
            'body' => [
                'ar' => '<h2>ما الذي تشمله الجراحة العامة؟</h2><p>تغطي الجراحة العامة طيفًا واسعًا من الحالات، من الفتق بأنواعه وحصوات المرارة، إلى الزائدة الدودية والأكياس الدهنية وخراريج الجلد.</p><ul><li>فتق السرة والفتق الإربي والفتق الجراحي.</li><li>حصوات المرارة والتهاباتها.</li><li>الزائدة الدودية الحادة والمزمنة.</li><li>الأورام الحميدة تحت الجلد.</li></ul><h2>كيف يتم التقييم؟</h2><p>يبدأ التقييم بسماع الشكوى والفحص السريري، ثم التحاليل والأشعة اللازمة فقط. بعدها تُشرح الخيارات المتاحة، ومنها المتابعة أو العلاج الدوائي أو الجراحة.</p><h2>بعد العملية</h2><p>تُسلَّم تعليمات مكتوبة للتعافي، ويُحدد موعد متابعة لمراجعة الجرح والاطمئنان على الحالة.</p>',
                'en' => '<h2>What does general surgery cover?</h2><p>General surgery covers a wide range of conditions, from hernias and gallstones to appendicitis, lipomas and skin abscesses.</p><ul><li>Umbilical, inguinal and incisional hernias.</li><li>Gallstones and gallbladder inflammation.</li><li>Acute and chronic appendicitis.</li><li>Benign lumps under the skin.</li></ul><h2>How is a case assessed?</h2><p>Assessment starts with the history and an examination, followed only by the tests and scans that are needed. The options are then explained, including observation, medication or surgery.</p><h2>After the operation</h2><p>Written recovery instructions are provided, and a follow-up visit is booked to check the wound and progress.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'هل كل فتق يحتاج إلى عملية؟', 'en' => 'Does every hernia need surgery?'],
                    'a' => ['ar' => 'ليس دائمًا. بعض الحالات الصغيرة تُتابع، لكن الفتق الذي يسبب ألمًا أو يكبر حجمه يُفضّل إصلاحه قبل حدوث مضاعفات.', 'en' => 'Not always. Some small hernias are observed, but a hernia that is painful or growing is usually repaired before complications develop.'],
                ],
                [
                    'q' => ['ar' => 'كم يومًا أحتاج للراحة بعد العملية؟', 'en' => 'How long is recovery after surgery?'],
                    'a' => ['ar' => 'يختلف حسب نوع العملية. أغلب العمليات البسيطة يعود بعدها المريض لنشاطه الخفيف خلال أيام قليلة.', 'en' => 'It depends on the procedure. After most minor operations patients return to light activity within a few days.'],
                ],
                [
                    'q' => ['ar' => 'هل العملية بالمنظار أفضل دائمًا؟', 'en' => 'Is keyhole surgery always better?'],
                    'a' => ['ar' => 'المنظار مناسب لكثير من الحالات، لكن الاختيار يعتمد على التشخيص وتاريخ العمليات السابقة وما هو أكثر أمانًا للمريض.', 'en' => 'Keyhole surgery suits many cases, but the choice depends on the diagnosis, previous operations and what is safest for the patient.'],
                ],
            ],
            'related' => ['laparoscopy', 'oncology'],
            'conditions' => [
                ['ar' => 'انسداد معوي', 'en' => 'Intestinal obstruction'],
                ['ar' => 'ناسور', 'en' => 'Fistula'],
                ['ar' => 'كتلة مؤلمة', 'en' => 'Painful lump'],
                ['ar' => 'الفتق', 'en' => 'Hernia'],
                ['ar' => 'خراج تحت الإبط', 'en' => 'Abscess under the arm'],
                ['ar' => 'الفتق السري', 'en' => 'Umbilical hernia'],
                ['ar' => 'الفتق الأربي', 'en' => 'Inguinal hernia'],
                ['ar' => 'صديد البول', 'en' => 'Pus in the urine'],
                ['ar' => 'ألم الشرج', 'en' => 'Anal pain'],
                ['ar' => 'تضخم البروستاتا', 'en' => 'Enlarged prostate'],
                ['ar' => 'صعوبة الإخراج', 'en' => 'Difficulty passing stool'],
                ['ar' => 'شرخ في الشرج', 'en' => 'Anal fissure'],
                ['ar' => 'الناسور النسائي', 'en' => 'Female fistula'],
                ['ar' => 'ظفر غائر', 'en' => 'Ingrown nail'],
                ['ar' => 'كيس دهني', 'en' => 'Fatty lump'],
                ['ar' => 'خصية معلقة', 'en' => 'Undescended testis'],
                ['ar' => 'البواسير', 'en' => 'Haemorrhoids'],
                ['ar' => 'التهاب البربخ', 'en' => 'Epididymitis'],
                ['ar' => 'خراج', 'en' => 'Abscess'],
                ['ar' => 'زوائد جلدية', 'en' => 'Skin tags'],
            ],
        ],
        [
            'slug' => 'oncology',
            'sort' => 2,
            'is_active' => true,
            'specialty' => 'oncology',
            'icon' => 'oncology',
            'image' => 'frontend/images/services/oncology.svg',
            'video' => 'https://www.youtube.com/watch?v=USoQMLuo1P8',
            'title' => ['ar' => 'جراحة الأورام', 'en' => 'Surgical oncology'],
            'excerpt' => [
                'ar' => 'استئصال الأورام بدقة ضمن خطة علاج متكاملة تُناقش مع المريض والفريق الطبي.',
                'en' => 'Precise tumour removal within an integrated treatment plan discussed with the patient and the medical team.',
            ],
            'body' => [
                'ar' => '<h2>الجراحة جزء من خطة متكاملة</h2><p>علاج الأورام لا يبدأ من غرفة العمليات. يبدأ بتشخيص دقيق لنوع الورم ومرحلته، ثم مناقشة الحالة مع أطباء الأورام والأشعة لتحديد ترتيب العلاج الأنسب.</p><h2>الحالات التي نتعامل معها</h2><ul><li>أورام الثدي الحميدة والخبيثة.</li><li>أورام الجهاز الهضمي.</li><li>أورام الغدة الدرقية.</li><li>أورام الأنسجة الرخوة.</li></ul><h2>الحفاظ على جودة الحياة</h2><p>الهدف استئصال الورم بالكامل مع الحفاظ قدر الإمكان على شكل ووظيفة العضو، وشرح ما يمكن أن تحققه الجراحة وما لا يمكن قبل أي قرار.</p>',
                'en' => '<h2>Surgery within an integrated plan</h2><p>Cancer treatment does not start in the operating room. It starts with an accurate diagnosis of the tumour type and stage, then a discussion with oncologists and radiologists to set the best treatment sequence.</p><h2>Conditions we manage</h2><ul><li>Benign and malignant breast tumours.</li><li>Digestive tract tumours.</li><li>Thyroid tumours.</li><li>Soft-tissue tumours.</li></ul><h2>Protecting quality of life</h2><p>The goal is complete removal of the tumour while preserving the shape and function of the organ as much as possible, with a clear explanation of what surgery can and cannot achieve.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'هل أحتاج علاجًا كيميائيًا قبل العملية؟', 'en' => 'Will I need chemotherapy before surgery?'],
                    'a' => ['ar' => 'يعتمد ذلك على نوع الورم ومرحلته. في بعض الحالات يسبق العلاج الكيميائي الجراحة لتصغير الورم.', 'en' => 'It depends on the tumour type and stage. In some cases chemotherapy is given first to shrink the tumour.'],
                ],
                [
                    'q' => ['ar' => 'هل يمكن الحفاظ على الثدي؟', 'en' => 'Can the breast be preserved?'],
                    'a' => ['ar' => 'في كثير من الحالات نعم، حسب حجم الورم ومكانه. يُشرح ذلك بالتفصيل بعد اكتمال الفحوصات.', 'en' => 'In many cases yes, depending on tumour size and position. This is explained in detail once tests are complete.'],
                ],
                [
                    'q' => ['ar' => 'متى تظهر نتيجة العينة بعد العملية؟', 'en' => 'When is the pathology result ready?'],
                    'a' => ['ar' => 'عادة خلال أسبوع إلى أسبوعين، وتُناقش النتيجة في زيارة المتابعة.', 'en' => 'Usually within one to two weeks, and the result is discussed at the follow-up visit.'],
                ],
            ],
            'related' => ['thyroid', 'general'],
            'conditions' => [
                ['ar' => 'ورم القولون', 'en' => 'Colon tumour'],
                ['ar' => 'ورم الثدي', 'en' => 'Breast lump'],
                ['ar' => 'إفرازات الثدي', 'en' => 'Breast discharge'],
                ['ar' => 'ورم مخاطي', 'en' => 'Mucinous tumour'],
            ],
        ],
        [
            'slug' => 'endocrine',
            'sort' => 3,
            'is_active' => true,
            'specialty' => 'endocrine',
            'icon' => 'endocrine',
            'image' => 'frontend/images/services/endocrine.svg',
            'video' => 'https://www.youtube.com/watch?v=USoQMLuo1P8',
            'title' => ['ar' => 'جراحات الغدد الصماء', 'en' => 'Endocrine surgery'],
            'excerpt' => [
                'ar' => 'جراحات الغدة الدرقية والجار درقية والكظرية بعد تقييم هرموني وتصويري دقيق.',
                'en' => 'Thyroid, parathyroid and adrenal surgery after careful hormonal and imaging assessment.',
            ],
            'body' => [
                'ar' => '<h2>متى تكون الجراحة هي الحل؟</h2><p>ليس كل اضطراب هرموني حالة جراحية. تُطرح الجراحة عندما يشير التقييم إلى غدة يمكن لاستئصالها، أو لجزء منها، أن يعالج المشكلة بشكل نهائي.</p><h2>أشهر الحالات</h2><ul><li>عقد وتضخم الغدة الدرقية.</li><li>فرط نشاط الغدد الجار درقية.</li><li>أورام الغدة الكظرية.</li></ul><h2>العمل مع طبيب الغدد</h2><p>يتم التنسيق مع طبيب الغدد الصماء قبل العملية وبعدها لضبط الهرمونات ومتابعة التحاليل حتى استقرار الحالة.</p>',
                'en' => '<h2>When is surgery the answer?</h2><p>Not every hormone problem is a surgical one. Surgery is considered when assessment points to a gland whose removal, in whole or in part, can treat the problem definitively.</p><h2>Common conditions</h2><ul><li>Thyroid nodules and goitre.</li><li>Overactive parathyroid glands.</li><li>Adrenal tumours.</li></ul><h2>Working with the endocrinologist</h2><p>Care is coordinated with the endocrinologist before and after surgery to balance hormones and follow blood tests until the condition is stable.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'هل سأحتاج دواءً مدى الحياة بعد العملية؟', 'en' => 'Will I need lifelong medication after surgery?'],
                    'a' => ['ar' => 'يعتمد على الغدة ومدى الاستئصال. بعد استئصال الغدة الدرقية كاملة يحتاج المريض هرمونًا تعويضيًا يوميًا.', 'en' => 'It depends on the gland and the extent of removal. After total thyroidectomy a daily replacement hormone is needed.'],
                ],
                [
                    'q' => ['ar' => 'ما الفحوصات المطلوبة قبل الزيارة؟', 'en' => 'Which tests should I bring?'],
                    'a' => ['ar' => 'أحضر أي تحاليل هرمونات وأشعة سابقة. وإن لم تتوفر، تُطلب الفحوصات اللازمة بعد الكشف.', 'en' => 'Bring any previous hormone tests and scans. If none are available, the necessary tests are requested after the visit.'],
                ],
                [
                    'q' => ['ar' => 'هل الجراحة آمنة على الصوت؟', 'en' => 'Is the voice at risk?'],
                    'a' => ['ar' => 'يُراعى الحفاظ على أعصاب الصوت أثناء العملية، ويُشرح احتمال المضاعفات بوضوح قبل الجراحة.', 'en' => 'The voice nerves are carefully protected during surgery, and the risk of complications is clearly explained beforehand.'],
                ],
            ],
            'related' => ['thyroid', 'parathyroid'],
        ],
        [
            'slug' => 'thyroid',
            'sort' => 4,
            'is_active' => true,
            'specialty' => 'endocrine',
            'icon' => 'thyroid',
            'image' => 'frontend/images/services/thyroid.svg',
            'video' => 'https://www.youtube.com/watch?v=WvQRdl4H_DA',
            'title' => ['ar' => 'جراحة الغدة الدرقية', 'en' => 'Thyroid surgery'],
            'excerpt' => [
                'ar' => 'تقييم وعلاج العقد والتضخم وأورام الغدة الدرقية، مع الحفاظ على الصوت والغدد الجار درقية.',
                'en' => 'Assessment and treatment of thyroid nodules, goitre and tumours while protecting the voice and parathyroid glands.',
            ],
            'body' => [
                'ar' => '<h2>عن الغدة الدرقية</h2><p>تقع الغدة الدرقية في أسفل مقدمة الرقبة، وتفرز هرمونات تنظم الطاقة والوزن وضربات القلب. ظهور عقدة أو زيادة في الحجم لا يعني بالضرورة ورمًا خبيثًا.</p><h2>رحلة التقييم</h2><ul><li>فحص سريري وتحاليل وظائف الغدة.</li><li>أشعة موجات صوتية على الرقبة.</li><li>عينة بالإبرة الدقيقة عند الحاجة.</li></ul><h2>أنواع العمليات</h2><p>قد يكون الاستئصال لنصف الغدة أو للغدة كاملة، حسب التشخيص. يُشرح أثر كل خيار على الهرمونات والمتابعة قبل اتخاذ القرار.</p><h2>التعافي</h2><p>يغادر أغلب المرضى المستشفى خلال يوم، ويعودون لأعمالهم المكتبية خلال أسبوع تقريبًا.</p>',
                'en' => '<h2>About the thyroid</h2><p>The thyroid sits low in the front of the neck and releases hormones that regulate energy, weight and heart rate. A nodule or an enlarged gland is not automatically cancer.</p><h2>The assessment journey</h2><ul><li>Examination and thyroid function tests.</li><li>Neck ultrasound.</li><li>Fine-needle biopsy when needed.</li></ul><h2>Types of operation</h2><p>Surgery may remove half of the gland or all of it, depending on the diagnosis. The effect of each option on hormones and follow-up is explained before deciding.</p><h2>Recovery</h2><p>Most patients leave hospital within a day and return to desk work in about a week.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'هل يظهر أثر الجرح في الرقبة؟', 'en' => 'Will the neck scar be visible?'],
                    'a' => ['ar' => 'يُوضع الجرح عادة في أحد ثنايا الجلد الطبيعية، ويصبح غير ملحوظ تقريبًا بعد شهور قليلة.', 'en' => 'The incision is usually placed in a natural skin crease and becomes barely noticeable after a few months.'],
                ],
                [
                    'q' => ['ar' => 'هل كل عقدة في الغدة تحتاج استئصالًا؟', 'en' => 'Does every nodule need removal?'],
                    'a' => ['ar' => 'لا. أغلب العقد حميدة وتُتابع بالأشعة. الاستئصال يكون للعقد المشتبه فيها أو الكبيرة المسببة لأعراض.', 'en' => 'No. Most nodules are benign and followed with ultrasound. Surgery is for suspicious nodules or large ones causing symptoms.'],
                ],
                [
                    'q' => ['ar' => 'متى أعود للأكل الطبيعي؟', 'en' => 'When can I eat normally?'],
                    'a' => ['ar' => 'غالبًا في نفس يوم العملية أو اليوم التالي، مع البدء بالسوائل والأطعمة اللينة.', 'en' => 'Usually on the day of surgery or the next day, starting with fluids and soft food.'],
                ],
            ],
            'related' => ['parathyroid', 'endocrine'],
        ],
        [
            'slug' => 'parathyroid',
            'sort' => 5,
            'is_active' => true,
            'specialty' => 'endocrine',
            'icon' => 'parathyroid',
            'image' => 'frontend/images/services/parathyroid.svg',
            'video' => 'https://www.youtube.com/watch?v=sD9st1ZPFrQ',
            'title' => ['ar' => 'الغدد الجار درقية', 'en' => 'Parathyroid surgery'],
            'excerpt' => [
                'ar' => 'علاج فرط نشاط الغدد الجار درقية وارتفاع الكالسيوم بجراحة دقيقة بعد تحديد الغدة المسببة.',
                'en' => 'Treating overactive parathyroid glands and high calcium with precise surgery after locating the affected gland.',
            ],
            'body' => [
                'ar' => '<h2>ما هي الغدد الجار درقية؟</h2><p>أربع غدد صغيرة خلف الغدة الدرقية تنظم مستوى الكالسيوم في الدم. عندما تنشط إحداها أكثر من اللازم قد يرتفع الكالسيوم ويؤثر على العظام والكلى.</p><h2>أعراض قد تلاحظها</h2><ul><li>إرهاق مستمر وضعف في التركيز.</li><li>آلام العظام أو هشاشتها.</li><li>حصوات متكررة في الكلى.</li></ul><h2>جراحة محدودة ودقيقة</h2><p>بعد تحديد مكان الغدة المسببة بالأشعة، يمكن في كثير من الحالات استئصالها من جرح صغير، مع عودة الكالسيوم لمستواه الطبيعي سريعًا.</p>',
                'en' => '<h2>What are the parathyroid glands?</h2><p>Four small glands behind the thyroid that regulate blood calcium. When one becomes overactive, calcium can rise and affect the bones and kidneys.</p><h2>Symptoms you may notice</h2><ul><li>Persistent fatigue and poor concentration.</li><li>Bone pain or osteoporosis.</li><li>Recurrent kidney stones.</li></ul><h2>Focused, precise surgery</h2><p>Once imaging locates the affected gland, it can often be removed through a small incision, and calcium returns to normal quickly.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'كيف يتم تحديد الغدة المسببة؟', 'en' => 'How is the affected gland located?'],
                    'a' => ['ar' => 'بالموجات الصوتية ومسح الغدد بالنظائر المشعة، وأحيانًا أشعة مقطعية متخصصة.', 'en' => 'With ultrasound and a nuclear parathyroid scan, and sometimes a specialised CT scan.'],
                ],
                [
                    'q' => ['ar' => 'هل يعود الكالسيوم طبيعيًا بعد العملية؟', 'en' => 'Does calcium return to normal after surgery?'],
                    'a' => ['ar' => 'في أغلب الحالات خلال ساعات إلى أيام، وتُتابع التحاليل للاطمئنان.', 'en' => 'In most cases within hours to days, with blood tests to confirm.'],
                ],
                [
                    'q' => ['ar' => 'هل أحتاج مكملات بعد العملية؟', 'en' => 'Will I need supplements afterwards?'],
                    'a' => ['ar' => 'أحيانًا لفترة مؤقتة حتى تستعيد باقي الغدد نشاطها الطبيعي.', 'en' => 'Sometimes, for a short period while the remaining glands recover.'],
                ],
            ],
            'related' => ['thyroid', 'endocrine'],
        ],
        [
            'slug' => 'laparoscopy',
            'sort' => 6,
            'is_active' => true,
            'specialty' => 'general',
            'icon' => 'laparoscopy',
            'image' => 'frontend/images/services/laparoscopy.svg',
            'video' => 'https://www.youtube.com/watch?v=USoQMLuo1P8',
            'title' => ['ar' => 'جراحة المناظير', 'en' => 'Laparoscopic surgery'],
            'excerpt' => [
                'ar' => 'عمليات من فتحات صغيرة بالكاميرا، لألم أقل وتعافٍ أسرع في الحالات المناسبة.',
                'en' => 'Keyhole operations through small incisions for less pain and faster recovery in suitable cases.',
            ],
            'body' => [
                'ar' => '<h2>ما هي جراحة المناظير؟</h2><p>إجراء العملية عبر فتحات صغيرة بمساعدة كاميرا عالية الدقة، بدل جرح طويل. يتيح ذلك رؤية مكبرة وألمًا أقل بعد العملية.</p><h2>عمليات تُجرى بالمنظار</h2><ul><li>استئصال المرارة.</li><li>إصلاح الفتق الإربي والسري.</li><li>استئصال الزائدة الدودية.</li><li>المنظار التشخيصي للبطن.</li></ul><h2>هل يناسب كل الحالات؟</h2><p>المنظار مناسب لكثير من الحالات وغير مناسب لأخرى. ويمكن تحويل العملية إلى جراحة مفتوحة أثناءها إذا كان ذلك أكثر أمانًا للمريض.</p>',
                'en' => '<h2>What is laparoscopic surgery?</h2><p>An operation through small incisions using a high-definition camera instead of one long incision. It gives a magnified view and less pain after surgery.</p><h2>Procedures done laparoscopically</h2><ul><li>Gallbladder removal.</li><li>Inguinal and umbilical hernia repair.</li><li>Appendectomy.</li><li>Diagnostic laparoscopy.</li></ul><h2>Does it suit every case?</h2><p>Laparoscopy suits many cases but not all. An operation may be converted to open surgery if that is safer for the patient.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'كم فتحة يحتاجها المنظار؟', 'en' => 'How many incisions are needed?'],
                    'a' => ['ar' => 'عادة من ثلاث إلى أربع فتحات صغيرة لا يتجاوز أكبرها سنتيمترًا واحدًا.', 'en' => 'Usually three to four small incisions, the largest about one centimetre.'],
                ],
                [
                    'q' => ['ar' => 'متى أغادر المستشفى؟', 'en' => 'When can I go home?'],
                    'a' => ['ar' => 'في أغلب عمليات المنظار البسيطة يغادر المريض في نفس اليوم أو اليوم التالي.', 'en' => 'After most simple laparoscopic operations patients go home the same or next day.'],
                ],
                [
                    'q' => ['ar' => 'متى أعود للرياضة؟', 'en' => 'When can I exercise again?'],
                    'a' => ['ar' => 'المشي من اليوم الأول، والتمارين الخفيفة بعد أسبوعين تقريبًا، ورفع الأثقال حسب تعليمات الطبيب.', 'en' => 'Walking from day one, light exercise after about two weeks, and lifting as advised by the surgeon.'],
                ],
            ],
            'related' => ['general', 'oncology'],
            'conditions' => [
                ['ar' => 'التهاب المرارة', 'en' => 'Gallbladder inflammation'],
                ['ar' => 'حصوة المرارة', 'en' => 'Gallstones'],
                ['ar' => 'أعراض المرارة', 'en' => 'Gallbladder symptoms'],
                ['ar' => 'استئصال المرارة', 'en' => 'Gallbladder removal'],
                ['ar' => 'التهاب الزائدة', 'en' => 'Appendicitis'],
            ],
        ],
    ],
];
