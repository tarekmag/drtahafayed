<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Seed the demo articles.
     */
    public function run(): void
    {
        $now = now();

        foreach (array_merge(config('articles.items', []), $this->extra()) as $article) {
            if (DB::table('articles')->where('slug', $article['slug'])->exists()) {
                continue;
            }

            DB::table('articles')->insert([
                'slug' => $article['slug'],
                'category' => $this->json($article['category']),
                'title' => $this->json($article['title']),
                'excerpt' => $this->json($article['excerpt']),
                'body' => $this->json($article['body']),
                'published_at' => $article['published_at'],
                'read_minutes' => $article['read_minutes'],
                'cover' => $article['cover'] ?? null,
                'sort' => $article['sort'] ?? 0,
                'is_active' => $article['is_active'] ?? true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    /**
     * Extra patient-education articles for the clinic specialties.
     *
     * @return list<array<string, mixed>>
     */
    private function extra(): array
    {
        return [
            [
                'slug' => 'inguinal-hernia',
                'sort' => 7,
                'is_active' => true,
                'published_at' => '2026-10-05',
                'read_minutes' => 5,
                'cover' => 'frontend/images/services/general.svg',
                'category' => ['ar' => 'الجراحة العامة', 'en' => 'General surgery'],
                'title' => ['ar' => 'الفتق الإربي: انتفاخ في الأربية لا يُتجاهل', 'en' => 'Inguinal hernia: a groin bulge that should not be ignored'],
                'excerpt' => [
                    'ar' => 'انتفاخ يظهر عند الوقوف أو الكحة قد يكون فتقًا إربيًا. متى تكفي المتابعة، ومتى يُفضّل الإصلاح قبل حدوث اختناق؟',
                    'en' => 'A bulge that appears on standing or coughing may be an inguinal hernia. When is observation enough, and when should it be repaired?',
                ],
                'body' => [
                    'ar' => '<h2>ما هو الفتق الإربي؟</h2><p>ضعف في جدار أسفل البطن يسمح لجزء من الأمعاء أو الدهون بالخروج تحت الجلد في منطقة الأربية. يظهر الانتفاخ غالبًا مع الوقوف أو الكحة أو رفع شيء ثقيل، وقد يختفي عند الاستلقاء.</p><h2>أعراض تستدعي الكشف</h2><ul><li>انتفاخ في الأربية أو كيس الصفن.</li><li>ثقل أو ألم يزداد مع المجهود.</li><li>انتفاخ لم يعد يرجع إلى الداخل.</li></ul><h2>لماذا لا يُؤجّل الفتق المؤلم؟</h2><p>الخطر الحقيقي هو الاختناق: انحباس جزء من الأمعاء مع انقطاع الدم عنه. يصاحبه ألم شديد وغثيان وانتفاخ صلب لا يرجع، وهذه حالة طارئة.</p><h2>كيف يتم الإصلاح؟</h2><p>الإصلاح الجراحي هو العلاج النهائي للفتق المسبب للأعراض. يُقوّى الجدار، وغالبًا بشبكة طبية تقلل عودة الفتق. يمكن إجراؤه مفتوحًا أو بالمنظار، والاختيار يعتمد على حجم الفتق والعمليات السابقة وحالة المريض.</p><blockquote>ليس كل فتق صغير بلا أعراض يحتاج عملية فورية، لكن الفتق الذي يكبر أو يؤلم يُفضّل إصلاحه قبل حدوث مضاعفة.</blockquote>',
                    'en' => '<h2>What is an inguinal hernia?</h2><p>A weakness in the lower abdominal wall lets bowel or fat push out under the skin in the groin. The bulge usually appears on standing, coughing or lifting, and may disappear when lying down.</p><h2>Symptoms worth a visit</h2><ul><li>A bulge in the groin or scrotum.</li><li>Aching or heaviness that worsens with effort.</li><li>A bulge that no longer goes back in.</li></ul><h2>Why a painful hernia should not wait</h2><p>The real risk is strangulation: a trapped piece of bowel loses its blood supply. Severe pain, nausea and a firm bulge that will not reduce make this an emergency.</p><h2>How is it repaired?</h2><p>Surgery is the definitive treatment for a symptomatic hernia. The wall is reinforced, usually with mesh that lowers the chance of recurrence. It can be open or laparoscopic; the choice depends on the size, previous operations and the patient.</p><blockquote>Not every small, painless hernia needs an immediate operation, but one that is growing or painful is better repaired before a complication.</blockquote>',
                ],
            ],
            [
                'slug' => 'appendicitis-warning-signs',
                'sort' => 8,
                'is_active' => true,
                'published_at' => '2026-09-20',
                'read_minutes' => 4,
                'cover' => 'frontend/images/services/general.svg',
                'category' => ['ar' => 'الجراحة العامة', 'en' => 'General surgery'],
                'title' => ['ar' => 'التهاب الزائدة: علامات لا تنتظر حتى الصباح', 'en' => 'Appendicitis: signs that should not wait until morning'],
                'excerpt' => [
                    'ar' => 'ألم يبدأ حول السرة ثم يستقر في أسفل يمين البطن، مع غثيان أو حرارة. متى نشك في الزائدة، وماذا يحدث في العملية؟',
                    'en' => 'Pain that starts around the navel then settles in the lower right abdomen, with nausea or fever. When to suspect appendicitis.',
                ],
                'body' => [
                    'ar' => '<h2>كيف يبدأ الألم؟</h2><p>يبدأ الألم غالبًا مبهمًا حول السرة، ثم خلال ساعات ينتقل إلى أسفل يمين البطن ويصبح أحدّ. قد يصاحبه غثيان، وقيء، وفقدان شهية، وحرارة خفيفة.</p><h2>لا تعتمد على المسكن فقط</h2><p>المسكن قد يخفف الألم ويؤخر التشخيص. إذا استمر الألم أو ازداد مع المشي أو الكحة، فالكشف في نفس اليوم أسلم من الانتظار.</p><h2>كيف يتأكد التشخيص؟</h2><ul><li>الفحص السريري.</li><li>تحليل دم يبحث عن علامات الالتهاب.</li><li>موجات صوتية، وأحيانًا أشعة مقطعية إذا لم تكن الصورة واضحة.</li></ul><h2>العلاج</h2><p>استئصال الزائدة هو العلاج المعتاد عند تأكد الالتهاب، ويُجرى في أغلب الحالات بالمنظار من فتحات صغيرة. التأخير بعد حدوث ثقب في الزائدة يطيل التعافي.</p><blockquote>ألم البطن الشديد مع قيء أو حرارة ليس «قولونًا» يُعالج في البيت حتى يستبعد الطبيب الأسباب الجراحية.</blockquote>',
                    'en' => '<h2>How the pain starts</h2><p>It often begins as a vague ache around the navel, then within hours moves to the lower right abdomen and becomes sharper. Nausea, vomiting, loss of appetite and a low fever may follow.</p><h2>Do not rely on painkillers alone</h2><p>Painkillers can mask the pain and delay diagnosis. If the pain continues or worsens with walking or coughing, same-day assessment is safer than waiting.</p><h2>How is it confirmed?</h2><ul><li>Clinical examination.</li><li>A blood test looking for inflammation.</li><li>Ultrasound, and sometimes a CT scan if the picture is unclear.</li></ul><h2>Treatment</h2><p>Removing the appendix is the usual treatment once inflammation is confirmed, most often by laparoscopy through small incisions. Delay after a perforation lengthens recovery.</p><blockquote>Severe abdominal pain with vomiting or fever is not a home remedy for colic until surgical causes have been ruled out.</blockquote>',
                ],
            ],
            [
                'slug' => 'laparoscopic-surgery',
                'sort' => 9,
                'is_active' => true,
                'published_at' => '2026-09-02',
                'read_minutes' => 5,
                'cover' => 'frontend/images/services/laparoscopy.svg',
                'category' => ['ar' => 'جراحة المنظار', 'en' => 'Laparoscopy'],
                'title' => ['ar' => 'جراحة المنظار: ماذا يحدث فعلًا داخل البطن؟', 'en' => 'Laparoscopic surgery: what actually happens inside the abdomen'],
                'excerpt' => [
                    'ar' => 'المنظار ليس جرحًا أصغر فقط. تعرّف على خطوات العملية، ولماذا لا يناسب كل حالة، وكيف يكون التعافي.',
                    'en' => 'Keyhole surgery is more than a smaller cut. Learn the steps, why it does not suit every case, and what recovery is like.',
                ],
                'body' => [
                    'ar' => '<h2>الفكرة ببساطة</h2><p>يُدخل منظار وكاميرا من فتحة صغيرة قرب السرة، وتُنفخ البطن بغاز آمن ليُخلق فراغ للعمل. الأدوات تدخل من فتحتين أو ثلاث، والجراح يرى الصورة مكبّرة على شاشة.</p><h2>متى يُستخدم؟</h2><ul><li>استئصال المرارة.</li><li>استئصال الزائدة.</li><li>إصلاح بعض أنواع الفتق.</li><li>استكشاف سبب ألم البطن غير الواضح.</li></ul><h2>ليس الخيار الوحيد دائمًا</h2><p>عمليات سابقة كثيرة في البطن، أو التهاب شديد، أو حالة طارئة غير مستقرة، قد تجعل الجراحة المفتوحة أأمن. التحويل من المنظار إلى جرح مفتوح أثناء العملية قرار حماية، لا فشلًا.</p><h2>التعافي</h2><p>الألم أقل والحركة أسرع في أغلب الحالات، ويخرج كثير من المرضى في نفس اليوم. ألم الكتف الخفيف بعد العملية شائع بسبب الغاز، ويزول خلال يوم أو يومين.</p>',
                    'en' => '<h2>The idea in brief</h2><p>A camera is passed through a small opening near the navel, and the abdomen is gently inflated with a safe gas to create working space. Instruments enter through two or three further openings, and the surgeon watches a magnified view on a screen.</p><h2>When is it used?</h2><ul><li>Gallbladder removal.</li><li>Appendix removal.</li><li>Repair of some hernias.</li><li>Looking for the cause of unclear abdominal pain.</li></ul><h2>It is not always the right choice</h2><p>Many previous abdominal operations, severe inflammation, or an unstable emergency may make open surgery safer. Converting from keyhole to an open incision during the operation is a safety decision, not a failure.</p><h2>Recovery</h2><p>Pain is usually less and movement returns sooner, and many patients go home the same day. Mild shoulder-tip pain afterwards is common because of the gas, and settles within a day or two.</p>',
                ],
            ],
            [
                'slug' => 'thyroid-nodules',
                'sort' => 10,
                'is_active' => true,
                'published_at' => '2026-08-22',
                'read_minutes' => 5,
                'cover' => 'frontend/images/services/thyroid.svg',
                'category' => ['ar' => 'الغدة الدرقية', 'en' => 'Thyroid'],
                'title' => ['ar' => 'عقدة في الغدة الدرقية: ماذا تقول الأشعة والعينة؟', 'en' => 'A thyroid nodule: what ultrasound and biopsy actually tell you'],
                'excerpt' => [
                    'ar' => 'اكتشاف عقدة في الغدة شائع، وأغلبها حميد. كيف تُقيَّم بالأشعة، ومتى تُسحب عينة، ومتى تكفي المتابعة؟',
                    'en' => 'Finding a thyroid nodule is common, and most are benign. How ultrasound grades it, when a biopsy is taken, and when follow-up is enough.',
                ],
                'body' => [
                    'ar' => '<h2>العقدة ليست تشخيصًا</h2><p>العقدة كتلة داخل الغدة. قد تُكتشف بالصدفة في أشعة للرقبة، أو يلاحظها المريض كنتوء. أكثر من تسع عقد من كل عشر حميدة.</p><h2>ماذا نبحث عنه في الموجات الصوتية؟</h2><ul><li>الحجم والعدد.</li><li>هل العقدة صلبة أم بها سائل.</li><li>حدودها، ووجود تكلسات.</li><li>شكلها مقارنة بعرضها.</li></ul><p>هذه الصفات تُجمع في درجة خطورة، لا في حكم نهائي. الدرجة تحدد: متابعة، أو عينة، أو رأي جراحي.</p><h2>عينة الإبرة</h2><p>تُسحب بخلايا رفيعة تحت توجيه الأشعة، من غير جرح ومن غير تخدير عام. النتيجة قد تكون حميدة، أو غير حاسمة وتحتاج إعادة، أو مشتبه فيها. العينة لا تُطلب لكل عقدة صغيرة ذات صفات مطمئنة.</p><h2>متى تُطرح الجراحة؟</h2><p>إذا كانت العينة مشتبه فيها، أو العقدة كبيرة وتضغط على البلع أو التنفس، أو ازداد حجمها رغم المتابعة. جزء من العمليات يكشف في التحليل النهائي نسيجًا حميدًا، وهذا متوقع عندما يكون الهدف استبعاد الورم.</p>',
                    'en' => '<h2>A nodule is not a diagnosis</h2><p>A nodule is a lump inside the gland. It may be found by chance on a neck scan, or noticed as a swelling. More than nine in ten are benign.</p><h2>What ultrasound looks for</h2><ul><li>Size and number.</li><li>Whether it is solid or fluid-filled.</li><li>Its margins, and any calcifications.</li><li>Its shape compared with its width.</li></ul><p>These features add up to a risk grade, not a final verdict. The grade decides follow-up, a biopsy, or a surgical opinion.</p><h2>Needle biopsy</h2><p>A fine needle takes cells under ultrasound guidance, without a cut and without general anaesthesia. The result may be benign, inconclusive and worth repeating, or suspicious. A biopsy is not required for every small nodule with reassuring features.</p><h2>When is surgery discussed?</h2><p>If the biopsy is suspicious, if the nodule is large enough to press on swallowing or breathing, or if it keeps growing. Some operations prove benign on the final pathology, which is expected when the aim was to rule a tumour out.</p>',
                ],
            ],
            [
                'slug' => 'after-thyroid-surgery',
                'sort' => 11,
                'is_active' => true,
                'published_at' => '2026-08-02',
                'read_minutes' => 5,
                'cover' => 'frontend/images/services/endocrine.svg',
                'category' => ['ar' => 'بعد الجراحة', 'en' => 'After surgery'],
                'title' => ['ar' => 'بعد استئصال الغدة الدرقية: الصوت والكالسيوم والهرمون', 'en' => 'After thyroid surgery: voice, calcium and hormone replacement'],
                'excerpt' => [
                    'ar' => 'بحة الصوت وتنميل الأطراف بعد العملية لهما تفسير واضح. ماذا تتوقع في الأيام الأولى، ومتى تتصل بالطبيب؟',
                    'en' => 'Hoarseness and tingling after the operation have a clear explanation. What to expect in the first days, and when to call.',
                ],
                'body' => [
                    'ar' => '<h2>الجرح والصوت</h2><p>الجرح يكون في أسفل الرقبة ضمن ثنية الجلد كلما أمكن. بحة الصوت أو سهولة التعب عند الكلام شائعة في الأيام الأولى بسبب ارتشاح حول عصب الصوت، وتتحسن عند أغلب المرضى خلال أسابيع.</p><h2>الكالسيوم</h2><p>الغدد الجار درقية ملاصقة للغدة الدرقية. قد يهدأ عملها مؤقتًا بعد العملية فينخفض الكالسيوم، ويظهر ذلك كتنميل حول الفم أو في أطراف الأصابع. لذلك يُقاس الكالسيوم قبل الخروج، وقد يُصرف كالسيوم وفيتامين د لفترة قصيرة.</p><h2>هرمون الغدة</h2><p>بعد الاستئصال الكامل تحتاج إلى حبة هرمون يومية لتعويض ما كانت الغدة تفرزه. الجرعة تُضبط بتحليل بعد أسابيع، لا من اليوم الأول. بعد الاستئصال النصفي قد لا تحتاج هرمونًا إذا كان النصف الباقي كافيًا.</p><h2>علامات تستدعي الاتصال</h2><ul><li>تنميل شديد أو شد في عضلات اليد.</li><li>صعوبة تنفس أو تورم سريع في الرقبة.</li><li>حرارة أو إفراز من الجرح.</li></ul>',
                    'en' => '<h2>The scar and the voice</h2><p>The incision sits low in the neck, in a skin crease when possible. Hoarseness or a voice that tires easily is common in the first days from swelling around the voice nerve, and improves for most people within weeks.</p><h2>Calcium</h2><p>The parathyroid glands sit against the thyroid. They may rest temporarily after surgery, so calcium falls, felt as tingling around the mouth or fingertips. Calcium is checked before discharge, and calcium with vitamin D may be prescribed for a short time.</p><h2>Thyroid hormone</h2><p>After a total thyroidectomy a daily hormone tablet replaces what the gland produced. The dose is adjusted with a blood test after a few weeks, not on day one. After removing only half, a tablet may be unnecessary if the remaining half is enough.</p><h2>When to call</h2><ul><li>Severe tingling or cramps in the hands.</li><li>Trouble breathing or rapid swelling in the neck.</li><li>Fever or discharge from the wound.</li></ul>',
                ],
            ],
            [
                'slug' => 'adrenal-incidentaloma',
                'sort' => 12,
                'is_active' => true,
                'published_at' => '2026-07-18',
                'read_minutes' => 5,
                'cover' => 'frontend/images/services/endocrine.svg',
                'category' => ['ar' => 'الغدد', 'en' => 'Glands'],
                'title' => ['ar' => 'ورم في الغدة الكظرية ظهر بالصدفة: ماذا بعد؟', 'en' => 'An adrenal mass found by chance: what happens next'],
                'excerpt' => [
                    'ar' => 'كثير من أورام الكظر تُكتشف في أشعة عُملت لسبب آخر. الحجم والهرمونات هما ما يحددان المتابعة أو الجراحة.',
                    'en' => 'Many adrenal masses are found on a scan done for another reason. Size and hormone tests decide between follow-up and surgery.',
                ],
                'body' => [
                    'ar' => '<h2>لماذا تظهر كثيرًا؟</h2><p>الغدتان الكظريتان فوق الكليتين. مع انتشار الأشعة المقطعية، تُكتشف كتل صغيرة فيهما عند أشخاص لا يشتكون من شيء. أغلب هذه الكتل حميدة وغير نشطة هرمونيًا.</p><h2>سؤالان قبل أي قرار</h2><ul><li>هل تفرز الهرمون زيادة؟ كورتيزول، أو ألدوستيرون، أو هرمونات ترفع الضغط وضربات القلب.</li><li>هل شكلها وحجمها مطمئنان في الأشعة؟</li></ul><p>تحاليل الهرمونات تُطلب حتى لو لم تكن هناك أعراض واضحة، لأن بعض الأورام تفرز بهدوء.</p><h2>متى تُناقش الجراحة؟</h2><p>إذا كان الورم يفرز هرمونًا تسبب في ضغط أو ضعف عظام أو نوبات خفقان وتعرق، أو إذا كان حجمه كبيرًا أو صفاته في الأشعة غير مطمئنة. الاستئصال بالمنظار مناسب لكثير من الأورام الحميدة النشطة.</p><blockquote>وجود كتلة في التقرير لا يعني عملية. جزء كبير من الحالات يُكتفى فيه بمتابعة الحجم والتحاليل.</blockquote>',
                    'en' => '<h2>Why they are found so often</h2><p>The two adrenal glands sit above the kidneys. With CT scans used widely, small masses are found in people who have no related symptoms. Most are benign and do not make extra hormone.</p><h2>Two questions before any decision</h2><ul><li>Is it overproducing hormone? Cortisol, aldosterone, or the hormones that raise blood pressure and heart rate.</li><li>Do its size and appearance on the scan look reassuring?</li></ul><p>Hormone tests are requested even without obvious symptoms, because some tumours secrete quietly.</p><h2>When is surgery discussed?</h2><p>If the mass is making a hormone that has caused high blood pressure, bone thinning, or spells of palpitations and sweating, or if it is large or looks worrying on the scan. Laparoscopic removal suits many benign, functioning tumours.</p><blockquote>A mass on the report does not mean an operation. A large share of cases are followed with repeat size and blood tests.</blockquote>',
                ],
            ],
            [
                'slug' => 'umbilical-hernia',
                'sort' => 13,
                'is_active' => true,
                'published_at' => '2026-06-28',
                'read_minutes' => 4,
                'cover' => 'frontend/images/services/general.svg',
                'category' => ['ar' => 'الجراحة العامة', 'en' => 'General surgery'],
                'title' => ['ar' => 'فتق السرة والفتق بعد عملية سابقة', 'en' => 'Umbilical hernia and hernia through an old scar'],
                'excerpt' => [
                    'ar' => 'انتفاخ عند السرة أو على جرح قديم قد يكبر مع الوقت. متى يُصلح، وهل الشبكة ضرورية؟',
                    'en' => 'A bulge at the navel or through an old scar can enlarge over time. When to repair it, and whether mesh is needed.',
                ],
                'body' => [
                    'ar' => '<h2>فتق السرة عند الكبار</h2><p>يظهر انتفاخًا حول السرة يزداد مع الوقوف والسعال. بخلاف فتق السرة عند الرضع، فتق الكبار نادرًا ما يُغلق وحده، ويميل إلى الاتساع.</p><h2>الفتق على جرح قديم</h2><p>يحدث عندما يضعف جدار البطن في مكان عملية سابقة. السمنة، والتهاب الجرح بعد العملية الأولى، والحمل المتكرر، والسعال المزمن، كلها تزيد الاحتمال.</p><h2>الإصلاح</h2><ul><li>الفتق الصغير جدًا قد يُغلق بخياطة فقط.</li><li>الأوسع يُقوّى بشبكة لتقليل الرجوع.</li><li>المنظار خيار جيد لكثير من الفتوق الجراحية.</li></ul><h2>قبل العملية</h2><p>إنقاص الوزن إن أمكن، وضبط السعال المزمن والإمساك، يقللان ضغط البطن بعد الإصلاح ويحسنان النتيجة. الفتق المحبوس الذي لا يرجع مع ألم وقيء يحتاج تقييمًا عاجلًا.</p>',
                    'en' => '<h2>Umbilical hernia in adults</h2><p>It shows as a bulge around the navel that increases on standing and coughing. Unlike an infant umbilical hernia, the adult kind rarely closes on its own and tends to widen.</p><h2>Hernia through an old scar</h2><p>This happens when the abdominal wall gives way at the site of a previous operation. Obesity, a wound infection after the first operation, repeated pregnancy and chronic cough all raise the chance.</p><h2>Repair</h2><ul><li>A very small hernia may be closed with stitches alone.</li><li>A wider one is reinforced with mesh to reduce recurrence.</li><li>Laparoscopy is a good option for many incisional hernias.</li></ul><h2>Before the operation</h2><p>Losing weight when possible, and controlling chronic cough and constipation, lower the pressure on the repair and improve the result. A trapped hernia that will not go back, with pain and vomiting, needs urgent assessment.</p>',
                ],
            ],
            [
                'slug' => 'soft-tissue-lump',
                'sort' => 14,
                'is_active' => true,
                'published_at' => '2026-06-08',
                'read_minutes' => 4,
                'cover' => 'frontend/images/services/oncology.svg',
                'category' => ['ar' => 'جراحة الأورام', 'en' => 'Surgical oncology'],
                'title' => ['ar' => 'كتلة تحت الجلد: متى تكون كيسًا دهنيًا ومتى نحتاج عينة؟', 'en' => 'A lump under the skin: when it is a lipoma, and when it needs a biopsy'],
                'excerpt' => [
                    'ar' => 'أغلب الكتل اللينة المتحركة حميدة. الحجم، والثبات، وسرعة النمو هي ما تغيّر الخطة.',
                    'en' => 'Most soft, mobile lumps are benign. Size, fixation and speed of growth are what change the plan.',
                ],
                'body' => [
                    'ar' => '<h2>الكيس الدهني</h2><p>الليبوما كتلة دهنية لينة، تتحرك تحت الجلد، وتنمو ببطء شديد وقد تبقى سنوات بلا ألم. استئصالها تجميلي أو لراحة المريض، ويُجرى غالبًا بتخدير موضعي إذا كانت صغيرة.</p><h2>علامات تستدعي تقييمًا أدق</h2><ul><li>حجم أكبر من 5 سم.</li><li>نمو واضح خلال أسابيع أو شهور.</li><li>كتلة ثابتة لا تتحرك، أو عميقة داخل العضلة.</li><li>ألم غير مفسر من غير التهاب.</li></ul><h2>الأشعة والعينة</h2><p>الكتلة العميقة أو سريعة النمو تُصوَّر بالرنين قبل أي استئصال، وقد تُؤخذ عينة بإبرة. الاستئصال غير المخطط لكتلة مشتبه فيها قد يصعّب العلاج اللاحق، لذلك التشخيص يسبق الجراحة حين تكون الصفات غير نمطية.</p><blockquote>كتلة صغيرة لينة وثابتة الحجم لسنوات تطمئن، لكن أي تغيّر جديد في الحجم يستحق الفحص لا التخمين.</blockquote>',
                    'en' => '<h2>A lipoma</h2><p>A lipoma is a soft fatty lump that moves under the skin, grows very slowly and may sit for years without pain. Removing it is for comfort or appearance, often under local anaesthetic if it is small.</p><h2>Features that need a closer look</h2><ul><li>Larger than 5 cm.</li><li>Obvious growth over weeks or months.</li><li>A fixed lump that does not move, or one deep in the muscle.</li><li>Unexplained pain without infection.</li></ul><h2>Imaging and biopsy</h2><p>A deep or fast-growing lump is imaged with MRI before any removal, and a needle biopsy may be taken. An unplanned excision of a suspicious mass can make later treatment harder, so diagnosis comes before surgery when the features are atypical.</p><blockquote>A small, soft lump unchanged for years is reassuring, but any new change in size deserves examination rather than a guess.</blockquote>',
                ],
            ],
        ];
    }

    private function json(mixed $value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    }
}
