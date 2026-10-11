<?php

namespace App\Livewire\Backend;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ServiceForm extends Component
{
    use WithFileUploads;

    public ?int $serviceId = null;

    public string $slug = '';

    public string $specialty = 'general';

    public string $icon = 'general';

    /** @var array{ar: string, en: string} */
    public array $title = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $excerpt = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $body = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $metaTitle = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $metaDescription = ['ar' => '', 'en' => ''];

    public string $video = '';

    public ?string $image = null;

    public ?TemporaryUploadedFile $imageUpload = null;

    /** @var array<int, array{q: array{ar: string, en: string}, a: array{ar: string, en: string}}> */
    public array $faqs = [];

    /** @var array<int, array{ar: string, en: string}> */
    public array $conditions = [];

    /** @var array<int, string> */
    public array $related = [];

    public int $sort = 0;

    public bool $isActive = true;

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(?Service $service = null): void
    {
        if ($service) {
            $this->serviceId = $service->id;
            $this->slug = $service->slug;
            $this->specialty = $service->specialty;
            $this->icon = $service->icon;
            $this->title = $this->localePair($service->title);
            $this->excerpt = $this->localePair($service->excerpt);
            $this->body = $this->localePair($service->body);
            $this->metaTitle = $this->localePair($service->meta_title);
            $this->metaDescription = $this->localePair($service->meta_description);
            $this->video = (string) $service->video;
            $this->image = $service->image;
            $this->faqs = collect($service->faqs ?? [])
                ->map(fn (array $faq) => [
                    'q' => $this->localePair($faq['q'] ?? []),
                    'a' => $this->localePair($faq['a'] ?? []),
                ])
                ->all();
            $this->conditions = collect($service->conditions ?? [])
                ->map(fn (array $condition) => $this->localePair($condition))
                ->all();
            $this->related = array_values($service->related ?? []);
            $this->sort = $service->sort;
            $this->isActive = $service->is_active;
        } else {
            $this->sort = (int) Service::query()->max('sort') + 1;
        }

        if ($message = session('serviceNotice')) {
            $this->notify('success', $message);
        }
    }

    public function updatedTitle(string $value, string $key): void
    {
        if ($key === 'en' && $this->serviceId === null && trim($this->slug) === '') {
            $this->slug = Str::slug($value);
        }
    }

    public function updatedSpecialty(string $value): void
    {
        if ($this->serviceId === null && in_array($this->icon, ['', ...array_keys(Service::SPECIALTIES)], true)) {
            $this->icon = $value;
        }
    }

    public function addFaq(): void
    {
        $this->faqs[] = [
            'q' => ['ar' => '', 'en' => ''],
            'a' => ['ar' => '', 'en' => ''],
        ];
    }

    public function removeFaq(int $index): void
    {
        unset($this->faqs[$index]);
        $this->faqs = array_values($this->faqs);
    }

    public function addCondition(): void
    {
        $this->conditions[] = ['ar' => '', 'en' => ''];
    }

    public function removeCondition(int $index): void
    {
        unset($this->conditions[$index]);
        $this->conditions = array_values($this->conditions);
    }

    public function save(): void
    {
        $this->slug = Str::slug(trim($this->slug !== '' ? $this->slug : $this->title['en']));
        $this->title = $this->localePair($this->title);
        $this->excerpt = $this->localePair($this->excerpt);
        $this->body = $this->localePair($this->body);
        $this->metaTitle = $this->localePair($this->metaTitle);
        $this->metaDescription = $this->localePair($this->metaDescription);
        $this->video = trim($this->video);
        $this->faqs = $this->cleanFaqs();
        $this->conditions = $this->cleanConditions();
        $this->related = array_values(array_filter($this->related));

        try {
            $this->validate();
        } catch (ValidationException $exception) {
            $this->notify('danger', (string) $exception->validator->errors()->first());

            throw $exception;
        }

        $service = $this->serviceId
            ? Service::query()->findOrFail($this->serviceId)
            : new Service;

        if ($this->imageUpload) {
            $path = $this->imageUpload->store('services', 'public');
            $this->deleteManagedImage($service->image);
            $this->image = 'storage/'.$path;
            $this->imageUpload = null;
        }

        $service->fill([
            'slug' => $this->slug,
            'specialty' => $this->specialty,
            'icon' => $this->icon,
            'image' => $this->image,
            'video' => $this->video !== '' ? $this->video : null,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'faqs' => $this->faqs,
            'conditions' => $this->conditions,
            'related' => $this->related,
            'meta_title' => $this->filledPair($this->metaTitle),
            'meta_description' => $this->filledPair($this->metaDescription),
            'sort' => $this->sort,
            'is_active' => $this->isActive,
        ])->save();

        if ($this->serviceId === null) {
            session()->flash('serviceNotice', 'Service saved.');
            $this->redirect(route('backend.services.edit', $service));

            return;
        }

        $this->notify('success', 'Service saved.');
    }

    public function render()
    {
        return view('livewire.backend.service-form', [
            'specialties' => Service::SPECIALTIES,
            'icons' => Service::ICONS,
            'otherServices' => Service::query()
                ->when($this->serviceId, fn ($query) => $query->whereKeyNot($this->serviceId))
                ->orderBy('sort')
                ->get(['id', 'slug', 'title']),
        ]);
    }

    public function imageUrl(): ?string
    {
        if ($this->imageUpload) {
            return $this->imageUpload->temporaryUrl();
        }

        $image = trim((string) $this->image);

        return $image !== '' ? asset($image) : null;
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'slug' => ['required', 'alpha_dash', 'max:160', Rule::unique('services', 'slug')->ignore($this->serviceId)],
            'specialty' => ['required', Rule::in(array_keys(Service::SPECIALTIES))],
            'icon' => ['required', Rule::in(Service::ICONS)],
            'title.ar' => ['required', 'string', 'max:255'],
            'title.en' => ['required', 'string', 'max:255'],
            'excerpt.ar' => ['required', 'string', 'max:500'],
            'excerpt.en' => ['required', 'string', 'max:500'],
            'body.ar' => ['required', 'string'],
            'body.en' => ['required', 'string'],
            'metaTitle.ar' => ['nullable', 'string', 'max:180'],
            'metaTitle.en' => ['nullable', 'string', 'max:180'],
            'metaDescription.ar' => ['nullable', 'string', 'max:320'],
            'metaDescription.en' => ['nullable', 'string', 'max:320'],
            'video' => ['nullable', 'string', 'max:500'],
            'faqs.*.q.ar' => ['required', 'string', 'max:255'],
            'faqs.*.q.en' => ['required', 'string', 'max:255'],
            'faqs.*.a.ar' => ['required', 'string', 'max:1000'],
            'faqs.*.a.en' => ['required', 'string', 'max:1000'],
            'conditions.*.ar' => ['required', 'string', 'max:160'],
            'conditions.*.en' => ['required', 'string', 'max:160'],
            'related' => ['array'],
            'related.*' => ['string', Rule::exists('services', 'slug'), Rule::notIn([$this->slug])],
            'sort' => ['required', 'integer', 'min:0'],
            'isActive' => ['boolean'],
            'imageUpload' => ['nullable', 'image', 'max:4096'],
        ];
    }

    private function notify(string $type, string $message): void
    {
        $this->noticeType = $type;
        $this->noticeMessage = $message;
        $this->noticeKey++;
    }

    /**
     * @param  array{ar: string, en: string}  $value
     * @return array{ar: string, en: string}|null
     */
    private function filledPair(array $value): ?array
    {
        return ($value['ar'] === '' && $value['en'] === '') ? null : $value;
    }

    /**
     * @return array{ar: string, en: string}
     */
    private function localePair(mixed $value): array
    {
        return [
            'ar' => trim((string) (is_array($value) ? ($value['ar'] ?? '') : '')),
            'en' => trim((string) (is_array($value) ? ($value['en'] ?? '') : '')),
        ];
    }

    /**
     * @return array<int, array{q: array{ar: string, en: string}, a: array{ar: string, en: string}}>
     */
    private function cleanFaqs(): array
    {
        return collect($this->faqs)
            ->map(fn (array $faq) => [
                'q' => $this->localePair($faq['q'] ?? []),
                'a' => $this->localePair($faq['a'] ?? []),
            ])
            ->filter(fn (array $faq) => $faq['q']['ar'] !== '' || $faq['q']['en'] !== '' || $faq['a']['ar'] !== '' || $faq['a']['en'] !== '')
            ->values()
            ->all();
    }

    /**
     * @return array<int, array{ar: string, en: string}>
     */
    private function cleanConditions(): array
    {
        return collect($this->conditions)
            ->map(fn (array $condition) => $this->localePair($condition))
            ->filter(fn (array $condition) => $condition['ar'] !== '' || $condition['en'] !== '')
            ->values()
            ->all();
    }

    private function deleteManagedImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'storage/')) {
            Storage::disk('public')->delete(substr($path, strlen('storage/')));
        }
    }
}
