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
            'title' => ['ar' => 'جراحات الغدد', 'en' => 'Gland surgery'],
            'excerpt' => [
                'ar' => 'جراحات الغدة الدرقية والجار درقية واللعابية والكظرية بعد تقييم هرموني وتصويري دقيق.',
                'en' => 'Thyroid, parathyroid, salivary and adrenal surgery after careful hormonal and imaging assessment.',
            ],
            'body' => [
                'ar' => '<h2>متى تكون الجراحة هي الحل؟</h2><p>ليس كل اضطراب هرموني حالة جراحية. تُطرح الجراحة عندما يشير التقييم إلى غدة يمكن لاستئصالها، أو لجزء منها، أن يعالج المشكلة بشكل نهائي.</p><h2>أشهر الحالات</h2><ul><li>عقد وتضخم الغدة الدرقية.</li><li>فرط نشاط الغدد الجار درقية.</li><li>الغدد اللعابية والنكافية.</li><li>أورام الغدة الكظرية.</li></ul><h2>العمل مع طبيب الغدد</h2><p>يتم التنسيق مع طبيب الغدد قبل العملية وبعدها لضبط الهرمونات ومتابعة التحاليل حتى استقرار الحالة.</p>',
                'en' => '<h2>When is surgery the answer?</h2><p>Not every hormone problem is a surgical one. Surgery is considered when assessment points to a gland whose removal, in whole or in part, can treat the problem definitively.</p><h2>Common conditions</h2><ul><li>Thyroid nodules and goitre.</li><li>Overactive parathyroid glands.</li><li>Salivary and parotid glands.</li><li>Adrenal tumours.</li></ul><h2>Working with the glands specialist</h2><p>Care is coordinated with the glands specialist before and after surgery to balance hormones and follow blood tests until the condition is stable.</p>',
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
        [
            'slug' => 'breast-tumours',
            'sort' => 7,
            'is_active' => true,
            'specialty' => 'oncology',
            'icon' => 'oncology',
            'image' => 'frontend/images/services/oncology.svg',
            'video' => '',
            'title' => ['ar' => 'جراحات أورام الثدي', 'en' => 'Breast tumour surgery'],
            'excerpt' => [
                'ar' => 'تقييم أورام الثدي الحميدة والخبيثة، واختيار الاستئصال المناسب مع شرح إمكانية الحفاظ على الثدي.',
                'en' => 'Assessment of benign and malignant breast tumours, and the operation that best fits the case, including breast-conserving surgery when suitable.',
            ],
            'body' => [
                'ar' => '<h2>التقييم قبل أي قرار</h2><p>يبدأ التعامل مع ورم الثدي بالفحص والأشعة والعينة عند الحاجة، لتحديد طبيعة الورم وحجمه ومكانه قبل الحديث عن الجراحة.</p><h2>الخيارات الجراحية</h2><ul><li>استئصال الورم مع الحفاظ على الثدي عندما يسمح الحجم والمكان.</li><li>استئصال الثدي عندما يكون ذلك أكثر أمانًا.</li><li>تقييم الغدد الليمفاوية تحت الإبط عند الحاجة.</li></ul><h2>الخطة مع فريق العلاج</h2><p>تُناقش الجراحة ضمن خطة قد تشمل علاجًا قبل العملية أو بعدها، ويُشرح ما تحققه العملية وما تحتاج إليه المتابعة.</p>',
                'en' => '<h2>Assessment before any decision</h2><p>Care starts with examination, imaging and a biopsy when needed, so the nature, size and position of the tumour are clear before surgery is discussed.</p><h2>Surgical options</h2><ul><li>Removing the tumour while conserving the breast when size and position allow.</li><li>Mastectomy when that is the safer choice.</li><li>Assessment of the underarm lymph nodes when needed.</li></ul><h2>A plan with the treatment team</h2><p>Surgery is discussed as part of a plan that may include treatment before or after the operation, with a clear explanation of what surgery achieves and what follow-up is required.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'هل كل ورم في الثدي خبيث؟', 'en' => 'Is every breast lump cancer?'],
                    'a' => ['ar' => 'لا. كثير من الأورام حميدة، والفحوصات هي التي تحدد الطبيعة وخطة العلاج.', 'en' => 'No. Many lumps are benign, and tests determine the nature of the lump and the treatment plan.'],
                ],
                [
                    'q' => ['ar' => 'هل يمكن الحفاظ على الثدي؟', 'en' => 'Can the breast be preserved?'],
                    'a' => ['ar' => 'في حالات كثيرة نعم، حسب حجم الورم ومكانه ومرحلة المرض. يُشرح ذلك بعد اكتمال الفحوصات.', 'en' => 'In many cases yes, depending on tumour size, position and stage. This is explained once tests are complete.'],
                ],
                [
                    'q' => ['ar' => 'هل أحتاج علاجًا بعد العملية؟', 'en' => 'Will I need treatment after surgery?'],
                    'a' => ['ar' => 'يعتمد على نتيجة العينة والمرحلة. تُناقش الخطوة التالية في زيارة المتابعة.', 'en' => 'It depends on the pathology result and the stage. The next step is discussed at follow-up.'],
                ],
            ],
            'related' => ['oncology', 'lymph-nodes', 'reconstructive-tumours'],
        ],
        [
            'slug' => 'reconstructive-tumours',
            'sort' => 8,
            'is_active' => true,
            'specialty' => 'oncology',
            'icon' => 'oncology',
            'image' => 'frontend/images/services/oncology.svg',
            'video' => '',
            'title' => ['ar' => 'جراحات الأورام التجميلية', 'en' => 'Reconstructive tumour surgery'],
            'excerpt' => [
                'ar' => 'استئصال الورم مع ترميم الشكل والوظيفة قدر الإمكان، بخطة تُشرح قبل العملية.',
                'en' => 'Tumour removal with reconstruction of form and function as far as possible, planned and explained before surgery.',
            ],
            'body' => [
                'ar' => '<h2>الاستئصال والترميم معًا</h2><p>الهدف إزالة الورم بالكامل، ثم ترميم المكان بطريقة تناسب حجم الاستئصال ومكانه، سواء في الثدي أو الجلد أو الوجه.</p><h2>متى تُطرح؟</h2><ul><li>عندما يؤثر الاستئصال على شكل العضو أو وظيفته.</li><li>عندما يمكن إغلاق الجرح أو ترميمه في نفس العملية.</li><li>عندما تحتاج الحالة تنسيقًا مع تخصص آخر.</li></ul><h2>ما يُشرح قبل القرار</h2><p>يُوضح شكل الترميم المتوقع، وعدد المراحل إن وُجدت، وما الذي يعود طبيعيًا وما الذي يحتاج وقتًا.</p>',
                'en' => '<h2>Removal and reconstruction together</h2><p>The aim is complete tumour removal, then reconstruction suited to the size and site of the excision, whether in the breast, skin or face.</p><h2>When is it considered?</h2><ul><li>When removal would affect the shape or function of the area.</li><li>When the wound can be closed or reconstructed in the same operation.</li><li>When another specialty needs to be involved.</li></ul><h2>What is explained beforehand</h2><p>The expected reconstruction, the number of stages if any, and what returns to normal and what needs time are all explained before a decision.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'هل الترميم يتم في نفس العملية؟', 'en' => 'Is reconstruction done in the same operation?'],
                    'a' => ['ar' => 'في كثير من الحالات نعم. وأحيانًا يُؤجَّل لمرحلة ثانية حسب حجم الاستئصال والعلاج المصاحب.', 'en' => 'Often yes. Sometimes it is deferred to a second stage, depending on the excision and any other treatment.'],
                ],
                [
                    'q' => ['ar' => 'هل الترميم يؤخر علاج الورم؟', 'en' => 'Does reconstruction delay cancer treatment?'],
                    'a' => ['ar' => 'الخطة تُرتَّب بحيث لا يؤخر الترميم العلاج اللازم. يُشرح ذلك قبل العملية.', 'en' => 'The plan is arranged so reconstruction does not delay necessary treatment. This is explained before surgery.'],
                ],
                [
                    'q' => ['ar' => 'هل النتيجة تظهر فورًا؟', 'en' => 'Is the result immediate?'],
                    'a' => ['ar' => 'الشكل يتحسن تدريجيًا مع التئام الجرح وهدوء التورم، وتُراجع النتيجة في المتابعة.', 'en' => 'The shape settles gradually as the wound heals and swelling eases, and it is reviewed at follow-up.'],
                ],
            ],
            'related' => ['breast-tumours', 'skin-tumours', 'oncology'],
        ],
        [
            'slug' => 'uterine-ovarian-tumours',
            'sort' => 9,
            'is_active' => true,
            'specialty' => 'oncology',
            'icon' => 'oncology',
            'image' => 'frontend/images/services/oncology.svg',
            'video' => '',
            'title' => ['ar' => 'جراحات أورام الرحم والمبيض', 'en' => 'Uterine and ovarian tumour surgery'],
            'excerpt' => [
                'ar' => 'تقييم أورام الرحم والمبيض جراحيًا ضمن خطة تُحدد مدى الاستئصال حسب نوع الورم ومرحلته.',
                'en' => 'Surgical assessment of uterine and ovarian tumours, with the extent of removal set by tumour type and stage.',
            ],
            'body' => [
                'ar' => '<h2>قبل العملية</h2><p>تُراجع الأشعة والتحاليل ونتائج العينات لمعرفة نوع الورم ومدى انتشاره، ثم تُشرح حدود الجراحة المتوقعة.</p><h2>ما قد تشمل العملية</h2><ul><li>استئصال الورم أو العضو المصاب حسب التشخيص.</li><li>تقييم الغدد الليمفاوية عند الحاجة.</li><li>إمكانية إجراء جزء من الجراحة بالمنظار في الحالات المناسبة.</li></ul><h2>بعد العملية</h2><p>تُناقش نتيجة العينة وخطة المتابعة أو العلاج المكمل في زيارة محددة، مع تعليمات واضحة للتعافي.</p>',
                'en' => '<h2>Before the operation</h2><p>Scans, blood tests and biopsy results are reviewed to understand the tumour type and extent, and the expected limits of surgery are explained.</p><h2>What the operation may include</h2><ul><li>Removal of the tumour or the affected organ, depending on the diagnosis.</li><li>Assessment of lymph nodes when needed.</li><li>A laparoscopic approach for part of the operation in suitable cases.</li></ul><h2>After the operation</h2><p>The pathology result and the follow-up or further treatment plan are discussed at a set visit, with clear recovery instructions.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'هل كل ورم في المبيض يحتاج استئصالًا كاملًا؟', 'en' => 'Does every ovarian tumour need complete removal?'],
                    'a' => ['ar' => 'لا. مدى الاستئصال يعتمد على نوع الورم وعمر المريضة ومرحلة المرض.', 'en' => 'No. The extent of removal depends on the tumour type, the patient’s age and the stage.'],
                ],
                [
                    'q' => ['ar' => 'هل العملية دائمًا مفتوحة؟', 'en' => 'Is the operation always open?'],
                    'a' => ['ar' => 'ليست دائمًا. بعض الحالات تناسب المنظار، ويُحسم ذلك بعد التقييم.', 'en' => 'Not always. Some cases suit laparoscopy, and that is decided after assessment.'],
                ],
                [
                    'q' => ['ar' => 'متى أعرف نتيجة العينة؟', 'en' => 'When is the pathology result ready?'],
                    'a' => ['ar' => 'عادة خلال أسبوع إلى أسبوعين، وتُناقش في المتابعة.', 'en' => 'Usually within one to two weeks, and it is discussed at follow-up.'],
                ],
            ],
            'related' => ['oncology', 'lymph-nodes', 'laparoscopy'],
        ],
        [
            'slug' => 'salivary-glands',
            'sort' => 10,
            'is_active' => true,
            'specialty' => 'endocrine',
            'icon' => 'endocrine',
            'image' => 'frontend/images/services/endocrine.svg',
            'video' => '',
            'title' => ['ar' => 'جراحات الغدد اللعابية', 'en' => 'Salivary gland surgery'],
            'excerpt' => [
                'ar' => 'تقييم أورام وتضخمات الغدد اللعابية، واستئصال الغدة المسببة مع الحفاظ على أعصاب الوجه ما أمكن.',
                'en' => 'Assessment of salivary gland tumours and enlargement, and removal of the affected gland while protecting the facial nerves when possible.',
            ],
            'body' => [
                'ar' => '<h2>أين تقع هذه الغدد؟</h2><p>تشمل الغدة النكافية تحت الأذن، والغدد تحت الفك وتحت اللسان. ظهور كتلة أو تورم لا يعني بالضرورة ورمًا خبيثًا.</p><h2>خطوات التقييم</h2><ul><li>فحص السريري للكتلة وحركة الوجه.</li><li>أشعة موجات صوتية أو مقطعية.</li><li>عينة بالإبرة عند الحاجة.</li></ul><h2>أثناء الجراحة</h2><p>يُستأصل الجزء المصاب أو الغدة، مع متابعة مسار عصب الوجه في جراحات النكافية، ويُشرح احتمال التأثير على الحركة أو جفاف الفم قبل العملية.</p>',
                'en' => '<h2>Where are these glands?</h2><p>They include the parotid gland in front of the ear, and the glands under the jaw and tongue. A lump or swelling is not automatically cancer.</p><h2>How a case is assessed</h2><ul><li>Examination of the lump and facial movement.</li><li>Ultrasound or CT.</li><li>Needle biopsy when needed.</li></ul><h2>During surgery</h2><p>The affected part or the gland is removed. In parotid surgery the facial nerve is traced and protected, and any effect on movement or mouth dryness is explained beforehand.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'هل تورم الغدة اللعابية ورم دائمًا؟', 'en' => 'Is a salivary swelling always a tumour?'],
                    'a' => ['ar' => 'لا. قد يكون التهابًا أو حصوة أو ورمًا حميدًا. الفحص والأشعة يحددان السبب.', 'en' => 'No. It may be inflammation, a stone or a benign tumour. Examination and scans identify the cause.'],
                ],
                [
                    'q' => ['ar' => 'هل تتأثر حركة الوجه؟', 'en' => 'Can facial movement be affected?'],
                    'a' => ['ar' => 'عصب الوجه يمر داخل الغدة النكافية، ويُحافَظ عليه أثناء الجراحة. يُشرح احتمال التأثر المؤقت أو الدائم قبل العملية.', 'en' => 'The facial nerve runs through the parotid gland and is protected during surgery. The chance of a temporary or lasting effect is explained beforehand.'],
                ],
                [
                    'q' => ['ar' => 'كم تستغرق العودة للأكل؟', 'en' => 'When can I eat again?'],
                    'a' => ['ar' => 'يبدأ أغلب المرضى بالسوائل والأطعمة اللينة في نفس اليوم أو اليوم التالي.', 'en' => 'Most patients start with fluids and soft food the same day or the next day.'],
                ],
            ],
            'related' => ['parotid', 'oral-tumours', 'endocrine'],
        ],
        [
            'slug' => 'parotid',
            'sort' => 11,
            'is_active' => true,
            'specialty' => 'endocrine',
            'icon' => 'endocrine',
            'image' => 'frontend/images/services/endocrine.svg',
            'video' => '',
            'title' => ['ar' => 'جراحات الغدة النكافية', 'en' => 'Parotid gland surgery'],
            'excerpt' => [
                'ar' => 'استئصال أورام الغدة النكافية أمام الأذن، مع تتبع عصب الوجه والحفاظ عليه.',
                'en' => 'Removal of parotid tumours in front of the ear, while tracing and protecting the facial nerve.',
            ],
            'body' => [
                'ar' => '<h2>عن الغدة النكافية</h2><p>أكبر الغدد اللعابية، وتقع أمام الأذن وأسفلها. أغلب أورامها حميدة، لكن بعضها يحتاج استئصالًا كاملًا للفص أو للغدة.</p><h2>أنواع الاستئصال</h2><ul><li>استئصال الفص السطحي للغدة.</li><li>استئصال الغدة كاملة عندما يمتد الورم أعمق.</li><li>عينة قبل العملية عندما تساعد في التخطيط.</li></ul><h2>عصب الوجه</h2><p>يمر العصب داخل الغدة، لذلك تُجرى الجراحة بتتبع فروعه. قد يحدث ضعف مؤقت في حركة الوجه يتحسن عند أغلب المرضى، ويُشرح ذلك بوضوح قبل الموعد.</p>',
                'en' => '<h2>About the parotid</h2><p>The largest salivary gland, sitting in front of and below the ear. Most of its tumours are benign, but some need removal of a lobe or of the whole gland.</p><h2>Types of operation</h2><ul><li>Removal of the superficial lobe.</li><li>Removal of the whole gland when the tumour extends deeper.</li><li>A biopsy beforehand when it helps planning.</li></ul><h2>The facial nerve</h2><p>The nerve runs through the gland, so surgery follows its branches. Temporary facial weakness can occur and improves in most patients. This is explained clearly before the operation.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'هل الجرح يظهر أمام الأذن؟', 'en' => 'Will the scar show in front of the ear?'],
                    'a' => ['ar' => 'يُوضع الجرح عادة في ثنية أمام الأذن ويمتد إلى الرقبة، ويبهت مع الوقت.', 'en' => 'The incision is usually placed in the crease in front of the ear and down into the neck, and it fades with time.'],
                ],
                [
                    'q' => ['ar' => 'هل كل أورام النكافية خبيثة؟', 'en' => 'Are all parotid tumours malignant?'],
                    'a' => ['ar' => 'لا. النسبة الأكبر حميدة، والنوع يتحدد بالأشعة والعينة ونتيجة التحليل بعد الاستئصال.', 'en' => 'No. Most are benign. The type is confirmed by scans, biopsy and the pathology result after removal.'],
                ],
                [
                    'q' => ['ar' => 'هل ضعف الوجه دائم؟', 'en' => 'Is facial weakness permanent?'],
                    'a' => ['ar' => 'الضعف المؤقت شائع ويتحسن خلال أسابيع إلى أشهر. الضعف الدائم أقل حدوثًا ويُشرح احتماله قبل الجراحة.', 'en' => 'Temporary weakness is common and improves over weeks to months. Lasting weakness is less common, and its risk is explained before surgery.'],
                ],
            ],
            'related' => ['salivary-glands', 'oral-tumours', 'endocrine'],
        ],
        [
            'slug' => 'lymph-nodes',
            'sort' => 12,
            'is_active' => true,
            'specialty' => 'oncology',
            'icon' => 'oncology',
            'image' => 'frontend/images/services/oncology.svg',
            'video' => '',
            'title' => ['ar' => 'جراحات الغدد الليمفاوية', 'en' => 'Lymph node surgery'],
            'excerpt' => [
                'ar' => 'أخذ عينة من غدة ليمفاوية متضخمة أو استئصال الغدد المصاحبة للورم لتحديد المرحلة وخطة العلاج.',
                'en' => 'Biopsy of an enlarged lymph node, or removal of nodes related to a tumour, to set the stage and the treatment plan.',
            ],
            'body' => [
                'ar' => '<h2>لماذا تُجرى؟</h2><p>قد تكون الغدة المتضخمة التهابًا، أو تحتاج عينة لمعرفة السبب. وفي جراحات الأورام تُقيَّم الغدد القريبة لمعرفة إن كان الورم وصل إليها.</p><h2>أشكال الجراحة</h2><ul><li>عينة من غدة واحدة للتشخيص.</li><li>استئصال الغدة الحارسة في بعض أورام الثدي والجلد.</li><li>تفريغ مجموعة من الغدد عندما يثبت إصابتها.</li></ul><h2>بعد العملية</h2><p>تُشرح العناية بالجرح، وعلامات التورم في الطرف، وموعد نتيجة العينة التي تحدد الخطوة التالية.</p>',
                'en' => '<h2>Why is it done?</h2><p>An enlarged node may be inflammation, or it may need a biopsy to find the cause. In cancer surgery the nearby nodes are assessed to see whether the tumour has reached them.</p><h2>Forms of surgery</h2><ul><li>Biopsy of a single node for diagnosis.</li><li>Sentinel-node removal in some breast and skin tumours.</li><li>Clearance of a group of nodes when they are involved.</li></ul><h2>After the operation</h2><p>Wound care, signs of limb swelling, and the date of the pathology result that sets the next step are all explained.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'هل تضخم الغدة يعني ورمًا؟', 'en' => 'Does an enlarged node mean cancer?'],
                    'a' => ['ar' => 'ليس دائمًا. الالتهابات سبب شائع، والعينة تُطلب عندما لا يتراجع التضخم أو يكون الشك قائمًا.', 'en' => 'Not always. Infection is a common cause. A biopsy is requested when the node does not settle or concern remains.'],
                ],
                [
                    'q' => ['ar' => 'هل استئصال الغدد يسبب تورم الذراع؟', 'en' => 'Can node removal cause arm swelling?'],
                    'a' => ['ar' => 'ممكن بعد تفريغ غدد الإبط، ويقل الاحتمال عند الاكتفاء بالغدة الحارسة. تُعطى تعليمات للوقاية والمتابعة.', 'en' => 'It can after an axillary clearance, and the risk is lower when only the sentinel node is removed. Prevention and follow-up advice is given.'],
                ],
                [
                    'q' => ['ar' => 'هل العينة تكفي أم يلزم استئصال أوسع؟', 'en' => 'Is a biopsy enough, or is a wider removal needed?'],
                    'a' => ['ar' => 'العينة للتشخيص. الاستئصال الأوسع يُقرر حسب النتيجة ومكان الغدد وارتباطها بورم معروف.', 'en' => 'A biopsy is for diagnosis. A wider removal is decided from the result, the site of the nodes and any known tumour.'],
                ],
            ],
            'related' => ['breast-tumours', 'skin-tumours', 'oncology'],
        ],
        [
            'slug' => 'adrenal',
            'sort' => 13,
            'is_active' => true,
            'specialty' => 'endocrine',
            'icon' => 'endocrine',
            'image' => 'frontend/images/services/endocrine.svg',
            'video' => '',
            'title' => ['ar' => 'جراحات الغدة الكظرية', 'en' => 'Adrenal gland surgery'],
            'excerpt' => [
                'ar' => 'استئصال أورام الغدة الكظرية بعد ضبط الهرمونات، وغالبًا بالمنظار في الحالات المناسبة.',
                'en' => 'Removal of adrenal tumours after hormones are controlled, often laparoscopically in suitable cases.',
            ],
            'body' => [
                'ar' => '<h2>متى تُستأصل الغدة الكظرية؟</h2><p>عندما يفرز الورم هرمونات زائدة، أو يكبر حجمه، أو تثير صورته شكًا يحتاج إلى استئصال. ليست كل عقدة صغيرة حالة جراحية.</p><h2>التحضير</h2><ul><li>تحاليل هرمونات يحددها التقييم.</li><li>أشعة مقطعية أو رنين لتحديد جهة الورم وحجمه.</li><li>ضبط ضغط الدم والهرمونات قبل الدخول للعملية عند الحاجة.</li></ul><h2>طريقة الجراحة</h2><p>يُجرى الاستئصال بالمنظار في كثير من الحالات، ويُحوَّل إلى جراحة مفتوحة إذا كان ذلك أكثر أمانًا. تُتابع الهرمونات بعد العملية حتى استقرارها.</p>',
                'en' => '<h2>When is the adrenal gland removed?</h2><p>When a tumour releases excess hormones, grows, or has an appearance that needs removal. Not every small nodule is a surgical case.</p><h2>Preparation</h2><ul><li>Hormone tests chosen for the case.</li><li>CT or MRI to locate the tumour and measure it.</li><li>Blood pressure and hormone control before surgery when needed.</li></ul><h2>How the operation is done</h2><p>Removal is laparoscopic in many cases, and converted to open surgery if that is safer. Hormones are followed after the operation until they are stable.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'هل أحتاج أدوية قبل العملية؟', 'en' => 'Will I need medication before surgery?'],
                    'a' => ['ar' => 'في الأورام المفرزة للهرمونات نعم، لضبط الضغط والهرمونات قبل التخدير.', 'en' => 'Yes for hormone-producing tumours, to control blood pressure and hormones before anaesthesia.'],
                ],
                [
                    'q' => ['ar' => 'هل يمكن إجراء العملية بالمنظار؟', 'en' => 'Can the operation be laparoscopic?'],
                    'a' => ['ar' => 'في أغلب الأورام محدودة الحجم نعم. الحجم والشك في الطبيعة يحددان الأسلوب.', 'en' => 'For most limited-size tumours, yes. Size and any concern about the nature of the tumour decide the approach.'],
                ],
                [
                    'q' => ['ar' => 'هل أحتاج كورتيزون بعد الاستئصال؟', 'en' => 'Will I need cortisone afterwards?'],
                    'a' => ['ar' => 'أحيانًا لفترة مؤقتة إذا كان الورم يفرز الكورتيزول، حتى تستعيد الغدة الأخرى نشاطها.', 'en' => 'Sometimes for a short period if the tumour was producing cortisol, until the other gland recovers.'],
                ],
            ],
            'related' => ['endocrine', 'laparoscopy', 'thyroid'],
        ],
        [
            'slug' => 'skin-tumours',
            'sort' => 14,
            'is_active' => true,
            'specialty' => 'oncology',
            'icon' => 'oncology',
            'image' => 'frontend/images/services/oncology.svg',
            'video' => '',
            'title' => ['ar' => 'جراحات أورام الجلد', 'en' => 'Skin tumour surgery'],
            'excerpt' => [
                'ar' => 'استئصال أورام الجلد الحميدة والخبيثة بهامش آمن، مع إغلاق الجرح أو ترميمه حسب المكان.',
                'en' => 'Removal of benign and malignant skin tumours with a safe margin, and closure or reconstruction according to the site.',
            ],
            'body' => [
                'ar' => '<h2>ما الذي يُفحص؟</h2><p>أي شامة أو قرحة أو كتلة جلدية يتغير لونها أو حجمها أو تنزف تُقيَّم سريريًا، وقد تُستأصل كاملة للتحليل.</p><h2>أسلوب الاستئصال</h2><ul><li>استئصال بهامش من الجلد السليم حول الورم.</li><li>إغلاق مباشر أو ترقيع أو شريحة عندما يكون الجرح واسعًا.</li><li>تقييم الغدد الليمفاوية القريبة في بعض الأورام.</li></ul><h2>النتيجة</h2><p>تحليل الأنسجة يؤكد نوع الورم وكفاية الهامش، ويحدد إن كانت هناك حاجة لتوسيع الاستئصال أو لعلاج إضافي.</p>',
                'en' => '<h2>What is assessed?</h2><p>A mole, ulcer or skin lump that changes colour or size, or that bleeds, is examined and may be removed completely for pathology.</p><h2>How it is removed</h2><ul><li>Excision with a margin of healthy skin around the tumour.</li><li>Direct closure, a graft or a flap when the wound is wide.</li><li>Assessment of nearby lymph nodes in some tumours.</li></ul><h2>The result</h2><p>Pathology confirms the tumour type and whether the margin is clear, and whether a wider excision or further treatment is needed.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'هل كل شامة تحتاج استئصالًا؟', 'en' => 'Does every mole need removal?'],
                    'a' => ['ar' => 'لا. الاستئصال للشامة التي تتغير أو تنزف أو يثير شكلها الشك.', 'en' => 'No. Removal is for a mole that is changing, bleeding or looks concerning.'],
                ],
                [
                    'q' => ['ar' => 'هل يبقى أثر للجرح؟', 'en' => 'Will there be a scar?'],
                    'a' => ['ar' => 'نعم، ويُخطط مكانه واتجاهه ليكون أقل وضوحًا. الأثر يبهت خلال شهور.', 'en' => 'Yes. Its position and direction are planned to be less noticeable, and it fades over months.'],
                ],
                [
                    'q' => ['ar' => 'متى تظهر نتيجة التحليل؟', 'en' => 'When is the pathology result ready?'],
                    'a' => ['ar' => 'غالبًا خلال أسبوع إلى أسبوعين، ومنها يُقرر إن كان الهامش كافيًا.', 'en' => 'Usually within one to two weeks, and that decides whether the margin is enough.'],
                ],
            ],
            'related' => ['reconstructive-tumours', 'lymph-nodes', 'oncology'],
        ],
        [
            'slug' => 'oral-tumours',
            'sort' => 15,
            'is_active' => true,
            'specialty' => 'oncology',
            'icon' => 'oncology',
            'image' => 'frontend/images/services/oncology.svg',
            'video' => '',
            'title' => ['ar' => 'جراحات أورام الفم', 'en' => 'Oral tumour surgery'],
            'excerpt' => [
                'ar' => 'تقييم واستئصال أورام الفم واللسان وباطن الخد، مع التخطيط للحفاظ على الكلام والبلع.',
                'en' => 'Assessment and removal of tumours of the mouth, tongue and inner cheek, planned to protect speech and swallowing.',
            ],
            'body' => [
                'ar' => '<h2>متى تُراجع؟</h2><p>قرحة في الفم لا تلتئم، أو كتلة في اللسان أو باطن الخد، أو بقعة بيضاء أو حمراء مستمرة، تحتاج فحصًا ولا يُكتفى بعلاج موضعي متكرر.</p><h2>التقييم والجراحة</h2><ul><li>فحص الفم والرقبة وأخذ عينة.</li><li>أشعة لتحديد عمق الورم.</li><li>استئصال الورم بهامش آمن، وتقييم الغدد الليمفاوية في الرقبة عند الحاجة.</li></ul><h2>الكلام والبلع</h2><p>يُشرح أثر الجراحة على الكلام والأكل قبل القرار، ويُرتب الترميم والمتابعة عندما يكون الاستئصال واسعًا.</p>',
                'en' => '<h2>When to be assessed</h2><p>A mouth ulcer that does not heal, a lump in the tongue or inner cheek, or a persistent white or red patch needs examination rather than repeated local treatment alone.</p><h2>Assessment and surgery</h2><ul><li>Examination of the mouth and neck, and a biopsy.</li><li>Scans to judge the depth of the tumour.</li><li>Removal with a safe margin, and assessment of neck lymph nodes when needed.</li></ul><h2>Speech and swallowing</h2><p>The effect of surgery on speech and eating is explained before a decision, and reconstruction and follow-up are arranged when the excision is wide.</p>',
            ],
            'faqs' => [
                [
                    'q' => ['ar' => 'هل قرحة الفم الطويلة تستدعي عينة؟', 'en' => 'Does a long-lasting mouth ulcer need a biopsy?'],
                    'a' => ['ar' => 'القرحة التي لا تلتئم خلال أسبوعين تحتاج فحصًا، وقد تُؤخذ منها عينة.', 'en' => 'An ulcer that has not healed within two weeks needs examination, and a biopsy may be taken.'],
                ],
                [
                    'q' => ['ar' => 'هل سأقدر أتكلم وآكل بعد العملية؟', 'en' => 'Will I be able to speak and eat afterwards?'],
                    'a' => ['ar' => 'في الاستئصال المحدود غالبًا نعم بعد أيام. الاستئصال الأوسع يحتاج خطة ترميم وتأهيل تُشرح مسبقًا.', 'en' => 'After a limited excision, usually yes within days. A wider excision needs a reconstruction and rehabilitation plan explained in advance.'],
                ],
                [
                    'q' => ['ar' => 'هل تُستأصل غدد الرقبة دائمًا؟', 'en' => 'Are the neck nodes always removed?'],
                    'a' => ['ar' => 'لا. ذلك يعتمد على نوع الورم وعمقه ومكانه، ويُحسم بعد الفحوصات.', 'en' => 'No. It depends on the tumour type, depth and site, and is decided after the tests.'],
                ],
            ],
            'related' => ['salivary-glands', 'lymph-nodes', 'oncology'],
        ],
    ],
];
