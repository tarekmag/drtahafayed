<?php

/*
| Medical services shown on the public site.
| The dashboard editor will replace this file later.
|
| image: path under public/, or a full https URL. Shown on the card and the detail page.
| video: empty until a file or link is stored. Accepts an mp4/webm path, a YouTube or Vimeo URL, or an https embed URL.
| excerpt: plain text for the card.
| body: HTML from the editor. The detail page prints it unescaped.
*/

return [
    'items' => [
        [
            'id' => 'general',
            'image' => 'frontend/images/services/general.svg',
            'video' => '',
            'title' => [
                'ar' => 'الجراحة العامة',
                'en' => 'General surgery',
            ],
            'excerpt' => [
                'ar' => 'تقييم حالات جراحية شائعة في البطن والأنسجة الرخوة، ثم تحديد إن كان التدخل الجراحي مناسبًا.',
                'en' => 'Assessment of common surgical conditions of the abdomen and soft tissues, and a decision about whether an operation is appropriate.',
            ],
            'body' => [
                'ar' => '<p>الجراحة العامة تغطي طيفًا واسعًا من الحالات، من مشكلات جدار البطن إلى بعض جراحات الجهاز الهضمي.</p><p>الخطوة الأولى تكون بفهم الشكوى والفحص، ثم التحاليل أو الأشعة إذا لزم الأمر. قرار العملية، ونوعها، وتوقيتها تختلف من شخص لآخر.</p>',
                'en' => '<p>General surgery covers a wide range of problems, from the abdominal wall to selected operations on the digestive tract.</p><p>The first step is to understand the complaint and examine the person, then to arrange tests or scans if they are needed. Whether to operate, and how, differs from one person to the next.</p>',
            ],
        ],
        [
            'id' => 'oncology',
            'image' => 'frontend/images/services/oncology.svg',
            'video' => '',
            'title' => [
                'ar' => 'جراحة الأورام',
                'en' => 'Oncosurgery',
            ],
            'excerpt' => [
                'ar' => 'الجراحة قد تكون جزءًا من علاج بعض الأورام، بعد تشخيص واضح وخطة تُناقش مع المريض.',
                'en' => 'Surgery can be one part of treating some tumors, after a clear diagnosis and a plan discussed with the patient.',
            ],
            'body' => [
                'ar' => '<p>جراحة الأورام لا تبدأ من العملية. تبدأ من فهم طبيعة الورم، ومرحلته، والخيارات المتاحة، ومنها الجراحة أو العلاج الدوائي أو الإشعاعي بحسب الحالة.</p><p>دور الجراح يُشرح للمريض قبل أي قرار، بما في ذلك ما الذي ستغيّره العملية وما الذي لن تغيّره.</p>',
                'en' => '<p>Cancer surgery does not start in the operating room. It starts with the nature of the tumor, its stage, and the options, which may include surgery, medication, or radiotherapy depending on the case.</p><p>The surgeon’s role is explained before any decision, including what an operation can change and what it cannot.</p>',
            ],
        ],
        [
            'id' => 'endocrine',
            'image' => 'frontend/images/services/endocrine.svg',
            'video' => '',
            'title' => [
                'ar' => 'جراحات الغدد الصماء',
                'en' => 'Endocrine surgery',
            ],
            'excerpt' => [
                'ar' => 'غدد تفرز الهرمونات، وقد تحتاج بعضها إلى جراحة بعد اكتمال الفحص المعملي والأشعة.',
                'en' => 'Glands that release hormones. Some of them need an operation only after blood tests and scans are complete.',
            ],
            'body' => [
                'ar' => '<p>الغدد الصماء تنظم وظائف كثيرة في الجسم. ليست كل اضطراب هرموني حالة جراحية.</p><p>الجراحة تُناقش عندما يشير التقييم إلى غدة يمكن لاستئصالها، أو لجزء منها، أن يعالج المشكلة. من أشهر ما يُعرض في هذا المجال الغدة الدرقية والغدد الجار درقية.</p>',
                'en' => '<p>Endocrine glands regulate many functions. Not every hormone problem is a surgical one.</p><p>Surgery is discussed when the work-up points to a gland that can be removed, in whole or in part, to treat the condition. The thyroid and parathyroid glands are among the most often considered.</p>',
            ],
        ],
        [
            'id' => 'thyroid',
            'image' => 'frontend/images/services/thyroid.svg',
            'video' => '',
            'title' => [
                'ar' => 'الغدة الدرقية',
                'en' => 'Thyroid',
            ],
            'excerpt' => [
                'ar' => 'تضخم الغدة أو العقد قد يحتاج تقييمًا. الجراحة أحد الخيارات، وليست الخطوة الأولى دائمًا.',
                'en' => 'An enlarged gland or a nodule may need assessment. Surgery is one possible step, not always the first one.',
            ],
            'body' => [
                'ar' => '<p>تقع الغدة الدرقية في أسفل مقدمة الرقبة. ظهور عقدة أو زيادة في الحجم لا يعني بالضرورة ورمًا خبيثًا.</p><p>التقييم قد يشمل فحصًا، وتحاليل هرمونات، وأشعة، وأحيانًا عينة. إذا طُرحت الجراحة، يُشرح مداها: نصف الغدة أو الغدة كاملة، وما يترتب على ذلك من متابعة.</p>',
                'en' => '<p>The thyroid sits low in the front of the neck. A nodule or an increase in size is not automatically a cancer.</p><p>Assessment may include an examination, hormone tests, ultrasound, and sometimes a needle sample. If surgery is proposed, its extent is explained: part of the gland or all of it, and what follow-up that implies.</p>',
            ],
        ],
        [
            'id' => 'parathyroid',
            'image' => 'frontend/images/services/parathyroid.svg',
            'video' => '',
            'title' => [
                'ar' => 'الغدد الجار درقية',
                'en' => 'Parathyroid glands',
            ],
            'excerpt' => [
                'ar' => 'غدد صغيرة تنظم الكالسيوم. بعض حالات زيادة النشاط تُناقش فيها الجراحة بعد تأكيد التشخيص.',
                'en' => 'Small glands that regulate calcium. Surgery is discussed for some cases of overactivity, after the diagnosis is confirmed.',
            ],
            'body' => [
                'ar' => '<p>الغدد الجار درقية تقع خلف الغدة الدرقية، وعددها غالبًا أربع. عندما يفرز أحدها هرمونًا أكثر من اللازم قد يرتفع الكالسيوم في الدم.</p><p>قبل الحديث عن الجراحة يلزم تأكيد أن المشكلة من هذه الغدد، وتحديد موضع الغدة المسببة كلما أمكن ذلك.</p>',
                'en' => '<p>The parathyroid glands lie behind the thyroid, usually as a set of four. When one of them releases too much hormone, calcium in the blood may rise.</p><p>Before surgery is discussed, the problem has to be traced to these glands, and the gland responsible located whenever that is possible.</p>',
            ],
        ],
        [
            'id' => 'laparoscopy',
            'image' => 'frontend/images/services/laparoscopy.svg',
            'video' => '',
            'title' => [
                'ar' => 'جراحة المناظير',
                'en' => 'Laparoscopic surgery',
            ],
            'excerpt' => [
                'ar' => 'في حالات مختارة تُجرى الجراحة من فتحات صغيرة، إذا كان ذلك مناسبًا للحالة وليس كقاعدة ثابتة.',
                'en' => 'In selected cases an operation is done through small incisions, when that approach fits the condition rather than as a fixed rule.',
            ],
            'body' => [
                'ar' => '<p>المنظار يعني إجراء العملية عبر فتحات صغيرة بمساعدة كاميرا، بدل جرح أطول. هذا الخيار مناسب لبعض الحالات وغير مناسب لأخرى، بحسب التشخيص وسابقة العمليات وهدف الجراحة.</p><p>يُشرح الفرق بين الطريقتين قبل الاختيار، ومن الممكن تحويل مسار العملية أثناء الجراحة إذا تطلّب الأمان ذلك.</p>',
                'en' => '<p>A laparoscopic operation uses small incisions and a camera instead of a longer incision. It suits some conditions and not others, depending on the diagnosis, previous surgery, and the goal of the operation.</p><p>The difference between the two approaches is explained beforehand. A procedure may still be converted during surgery if that is the safer course.</p>',
            ],
        ],
    ],
];
