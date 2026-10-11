@use('App\Support\Content')
@use('App\Support\LocaleText')
@use('App\Support\MediaEmbed')

@php
    $doctor = Content::doctor();
    $contact = Content::contact();
    $clinics = Content::clinics()->map(function (array $clinic) {
        $map = \App\Support\MediaEmbed::map($clinic['map'] ?? '');
        $dayCodes = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
        $days = collect($clinic['days'] ?? [])
            ->map(fn ($day) => $dayCodes[(int) $day] ?? null)
            ->filter()
            ->implode(',');
        $opens = substr(trim((string) ($clinic['opens'] ?? '')), 0, 5);
        $closes = substr(trim((string) ($clinic['closes'] ?? '')), 0, 5);

        return array_filter([
            '@type' => 'MedicalClinic',
            'name' => LocaleText::get($clinic['name'] ?? ''),
            'telephone' => $clinic['phone'] ?? null,
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => LocaleText::get($clinic['address'] ?? ''),
                'addressCountry' => 'EG',
            ],
            'openingHours' => $days !== '' && $opens !== '' && $closes !== '' ? $days.' '.$opens.'-'.$closes : null,
            'hasMap' => $map['link'] ?? null,
        ]);
    })->values()->all();

    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Physician',
                'name' => LocaleText::get($doctor['name'] ?? __('site.brand.name')),
                'jobTitle' => LocaleText::get($doctor['title'] ?? __('site.brand.specialty')),
                'description' => LocaleText::get($doctor['summary'] ?? __('site.brand.description')),
                'image' => MediaEmbed::image($doctor['portrait'] ?? 'assets/images/dr-2.jpeg'),
                'url' => route('site.home'),
                'telephone' => $contact['phone'] ?: null,
                'email' => $contact['email'] ?: null,
                'sameAs' => array_values(Content::socials()),
                'medicalSpecialty' => ['General Surgery', 'Surgical Oncology', 'Endocrine Surgery'],
            ],
            [
                '@type' => 'MedicalOrganization',
                'name' => __('site.brand.name'),
                'url' => route('site.home'),
                'logo' => asset('assets/images/logo.png'),
                'department' => $clinics,
            ],
        ],
    ];
@endphp

<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
