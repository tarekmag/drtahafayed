<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Seed the doctor's biography.
     */
    public function run(): void
    {
        if (DB::table('doctors')->exists()) {
            return;
        }

        $now = now();

        DB::table('doctors')->insert([
            'name' => $this->json([
                'ar' => 'د. طه فايد',
                'en' => 'Dr. Taha Fayed',
            ]),
            'title' => $this->json([
                'ar' => 'استشاري الجراحة العامة وجراحات الأورام والغدد',
                'en' => 'Consultant in General, Oncologic and Gland Surgery',
            ]),
            'summary' => $this->json([
                'ar' => 'رعاية جراحية دقيقة تبدأ بالاستماع، وتشرح كل خطوة بوضوح قبل أي قرار.',
                'en' => 'Precise surgical care that starts with listening and explains every step before any decision.',
            ]),
            'bio' => $this->json([
                'ar' => '<p>د. طه فايد استشاري الجراحة العامة وجراحات الأورام والغدد، ويعمل في تشخيص وعلاج حالات الغدة الدرقية والجار درقية، وأورام الثدي والجهاز الهضمي، وجراحات البطن بالمنظار.</p><p>يؤمن بأن المريض شريك في القرار. لذلك تبدأ الزيارة بشرح هادئ للتشخيص، ثم عرض الخيارات المتاحة بمزاياها وحدودها، قبل الاتفاق على خطة العلاج.</p><p>يتابع المريض بعد العملية خطوة بخطوة حتى التعافي الكامل، بالتنسيق مع فريق متعدد التخصصات عند الحاجة.</p>',
                'en' => '<p>Dr. Taha Fayed is a consultant in general, oncologic and gland surgery. His work covers thyroid and parathyroid disease, breast and digestive tract tumours, and laparoscopic abdominal surgery.</p><p>He treats the patient as a partner in every decision. A visit starts with a calm explanation of the diagnosis and the available options, with their benefits and limits, before a treatment plan is agreed.</p><p>Follow-up continues step by step after surgery until full recovery, in coordination with a multidisciplinary team when needed.</p>',
            ]),
            'credentials' => $this->json([
                ['ar' => 'استشاري الجراحة العامة وجراحات الأورام والغدد', 'en' => 'Consultant in General, Oncologic and Gland Surgery'],
                ['ar' => 'دكتوراة جراحات الأورام وعلاج وجراحات الغدد', 'en' => 'MD in Oncologic Surgery and Gland Treatment and Surgery'],
                ['ar' => 'ماجستير الجراحة العامة وجراحات المناظير', 'en' => 'MSc in General and Laparoscopic Surgery'],
                ['ar' => 'عضو الجمعية المصرية لجراحات الأورام', 'en' => 'Member of the Egyptian Society of Surgical Oncology'],
                ['ar' => 'زميل كلية الجراحين الملكية بلندن', 'en' => 'Fellow of the Royal College of Surgeons of England'],
                ['ar' => 'دبلومة علاج وجراحات الغدة الدرقية', 'en' => 'Diploma in Thyroid Treatment and Surgery'],
                ['ar' => 'عضو الجمعية الأمريكية لجراحات الثدي', 'en' => 'Member of the American Society of Breast Surgeons'],
            ]),
            'stats' => $this->json([
                ['value' => 15, 'suffix' => '+', 'label' => ['ar' => 'سنة خبرة', 'en' => 'Years of experience']],
                ['value' => 4000, 'suffix' => '+', 'label' => ['ar' => 'عملية جراحية', 'en' => 'Operations performed']],
                ['value' => 5, 'suffix' => '', 'label' => ['ar' => 'فروع', 'en' => 'Clinics']],
                ['value' => 98, 'suffix' => '%', 'label' => ['ar' => 'رضا المرضى', 'en' => 'Patient satisfaction']],
            ]),
            'hero_image' => 'assets/images/dr-1.jpeg',
            'portrait' => 'assets/images/dr-2.jpeg',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    private function json(mixed $value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    }
}
