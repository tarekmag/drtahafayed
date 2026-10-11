<?php

namespace App\Livewire\Backend;

use App\Models\Clinic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ClinicForm extends Component
{
    use WithFileUploads;

    public ?int $clinicId = null;

    /** @var array{ar: string, en: string} */
    public array $name = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $address = ['ar' => '', 'en' => ''];

    /** @var list<int|string> */
    public array $days = [];

    public string $slug = '';

    public ?string $opens = null;

    public ?string $closes = null;

    public ?string $phone = null;

    public ?string $map = null;

    public int $sort = 0;

    public bool $isActive = true;

    /** @var list<string> */
    public array $photos = [];

    /** @var list<TemporaryUploadedFile> */
    public array $photoUploads = [];

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(?Clinic $clinic = null): void
    {
        if ($clinic) {
            $this->clinicId = $clinic->id;
            $this->slug = $clinic->slug;
            $this->name = $this->localePair($clinic->name);
            $this->address = $this->localePair($clinic->address);
            $this->days = array_map('strval', $clinic->days ?? []);
            $this->opens = $clinic->opens;
            $this->closes = $clinic->closes;
            $this->phone = $clinic->phone;
            $this->map = $clinic->map;
            $this->sort = $clinic->sort;
            $this->isActive = $clinic->is_active;
            $this->photos = array_values($clinic->photos ?? []);
        } else {
            $this->sort = (int) Clinic::query()->max('sort') + 1;
        }

        if ($message = session('clinicNotice')) {
            $this->notify('success', $message);
        }
    }

    public function updatedName(string $value, string $key): void
    {
        if ($key === 'en' && $this->clinicId === null && trim($this->slug) === '') {
            $this->slug = Str::slug($value);
        }
    }

    public function removePhoto(int $index): void
    {
        unset($this->photos[$index]);
        $this->photos = array_values($this->photos);
    }

    public function removeUpload(int $index): void
    {
        unset($this->photoUploads[$index]);
        $this->photoUploads = array_values($this->photoUploads);
    }

    public function save(): void
    {
        $this->slug = Str::slug(trim($this->slug !== '' ? $this->slug : $this->name['en']));
        $this->phone = trim((string) $this->phone) ?: null;
        $this->map = trim((string) $this->map) ?: null;
        $this->opens = $this->clock($this->opens);
        $this->closes = $this->clock($this->closes);
        $this->name = $this->localePair($this->name);
        $this->address = $this->localePair($this->address);

        try {
            $this->validate();
        } catch (ValidationException $exception) {
            $this->notify('danger', (string) $exception->validator->errors()->first());

            throw $exception;
        }

        $clinic = $this->clinicId
            ? Clinic::query()->findOrFail($this->clinicId)
            : new Clinic;

        $removed = array_diff($clinic->photos ?? [], $this->photos);
        foreach ($this->photoUploads as $upload) {
            $path = $upload->store('clinics', 'public');
            $this->photos[] = 'storage/'.$path;
        }
        $this->photoUploads = [];

        $clinic->fill([
            'slug' => $this->slug,
            'name' => $this->name,
            'address' => $this->address,
            'hours' => ['ar' => '', 'en' => ''],
            'days' => collect($this->days)->map(fn ($day) => (int) $day)->unique()->sort()->values()->all(),
            'opens' => $this->opens,
            'closes' => $this->closes,
            'phone' => $this->phone,
            'map' => $this->map,
            'photos' => array_values($this->photos),
            'sort' => $this->sort,
            'is_active' => $this->isActive,
        ])->save();

        foreach ($removed as $path) {
            $this->deleteManagedImage($path);
        }

        $this->days = array_map('strval', $clinic->days ?? []);

        if ($this->clinicId === null) {
            session()->flash('clinicNotice', 'Branch saved.');
            $this->redirect(route('backend.clinics.edit', $clinic));

            return;
        }

        $this->notify('success', 'Branch saved.');
    }

    public function render()
    {
        return view('livewire.backend.clinic-form', [
            'weekdays' => [
                0 => 'Sunday',
                1 => 'Monday',
                2 => 'Tuesday',
                3 => 'Wednesday',
                4 => 'Thursday',
                5 => 'Friday',
                6 => 'Saturday',
            ],
        ]);
    }

    public function imageUrl(string $path): string
    {
        return asset($path);
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'slug' => ['required', 'alpha_dash', 'max:100', Rule::unique('clinics', 'slug')->ignore($this->clinicId)],
            'name.ar' => ['required', 'string', 'max:255'],
            'name.en' => ['required', 'string', 'max:255'],
            'address.ar' => ['required', 'string', 'max:500'],
            'address.en' => ['required', 'string', 'max:500'],
            'days' => ['array'],
            'days.*' => ['integer', 'between:0,6'],
            'opens' => ['nullable', 'date_format:H:i'],
            'closes' => ['nullable', 'date_format:H:i'],
            'phone' => ['nullable', 'string', 'max:30'],
            'map' => ['nullable', 'string', 'max:500'],
            'sort' => ['required', 'integer', 'min:0'],
            'isActive' => ['boolean'],
            'photoUploads' => ['array'],
            'photoUploads.*' => ['image', 'max:4096'],
        ];
    }

    private function notify(string $type, string $message): void
    {
        $this->noticeType = $type;
        $this->noticeMessage = $message;
        $this->noticeKey++;
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

    private function clock(?string $value): ?string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        return strlen($value) >= 5 ? substr($value, 0, 5) : $value;
    }

    private function deleteManagedImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'storage/')) {
            Storage::disk('public')->delete(substr($path, strlen('storage/')));
        }
    }
}
