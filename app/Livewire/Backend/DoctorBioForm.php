<?php

namespace App\Livewire\Backend;

use App\Models\Doctor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class DoctorBioForm extends Component
{
    use WithFileUploads;

    /** @var array{ar: string, en: string} */
    public array $name = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $title = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $summary = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $bio = ['ar' => '', 'en' => ''];

    /** @var list<array{ar: string, en: string}> */
    public array $credentials = [];

    /** @var list<array{value: int|string, suffix: string, label: array{ar: string, en: string}}> */
    public array $stats = [];

    public ?string $heroImage = null;

    public ?string $portrait = null;

    public ?TemporaryUploadedFile $heroUpload = null;

    public ?TemporaryUploadedFile $portraitUpload = null;

    public ?string $noticeType = null;

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(): void
    {
        $doctor = Doctor::query()->firstOrFail();

        $this->name = $this->localePair($doctor->name);
        $this->title = $this->localePair($doctor->title);
        $this->summary = $this->localePair($doctor->summary);
        $this->bio = $this->localePair($doctor->bio);
        $this->credentials = collect($doctor->credentials ?? [])
            ->map(fn (mixed $item) => $this->localePair($item))
            ->values()
            ->all();
        $this->stats = collect($doctor->stats ?? [])
            ->map(fn (mixed $item) => [
                'value' => $item['value'] ?? '',
                'suffix' => (string) ($item['suffix'] ?? ''),
                'label' => $this->localePair($item['label'] ?? []),
            ])
            ->values()
            ->all();
        $this->heroImage = $doctor->hero_image;
        $this->portrait = $doctor->portrait;
    }

    public function rules(): array
    {
        return [
            'name.ar' => ['required', 'string', 'max:255'],
            'name.en' => ['required', 'string', 'max:255'],
            'title.ar' => ['required', 'string', 'max:255'],
            'title.en' => ['required', 'string', 'max:255'],
            'summary.ar' => ['required', 'string', 'max:1000'],
            'summary.en' => ['required', 'string', 'max:1000'],
            'bio.ar' => ['required', 'string'],
            'bio.en' => ['required', 'string'],
            'credentials' => ['array'],
            'credentials.*.ar' => ['required', 'string', 'max:500'],
            'credentials.*.en' => ['required', 'string', 'max:500'],
            'stats' => ['array'],
            'stats.*.value' => ['required', 'numeric', 'min:0'],
            'stats.*.suffix' => ['nullable', 'string', 'max:8'],
            'stats.*.label.ar' => ['required', 'string', 'max:120'],
            'stats.*.label.en' => ['required', 'string', 'max:120'],
            'heroUpload' => ['nullable', 'image', 'max:4096'],
            'portraitUpload' => ['nullable', 'image', 'max:4096'],
        ];
    }

    public function addCredential(): void
    {
        $this->credentials[] = ['ar' => '', 'en' => ''];
    }

    public function removeCredential(int $index): void
    {
        unset($this->credentials[$index]);
        $this->credentials = array_values($this->credentials);
    }

    public function addStat(): void
    {
        $this->stats[] = [
            'value' => '',
            'suffix' => '',
            'label' => ['ar' => '', 'en' => ''],
        ];
    }

    public function removeStat(int $index): void
    {
        unset($this->stats[$index]);
        $this->stats = array_values($this->stats);
    }

    public function save(): void
    {
        try {
            $this->validate();
        } catch (ValidationException $exception) {
            $this->notify('danger', (string) $exception->validator->errors()->first());

            throw $exception;
        }

        $doctor = Doctor::query()->firstOrFail();

        if ($this->heroUpload) {
            $doctor->hero_image = $this->storeImage($this->heroUpload, $doctor->hero_image);
            $this->heroUpload = null;
        }

        if ($this->portraitUpload) {
            $doctor->portrait = $this->storeImage($this->portraitUpload, $doctor->portrait);
            $this->portraitUpload = null;
        }

        $doctor->fill([
            'name' => $this->name,
            'title' => $this->title,
            'summary' => $this->summary,
            'bio' => $this->bio,
            'credentials' => array_values($this->credentials),
            'stats' => collect($this->stats)->map(fn (array $stat) => [
                'value' => (int) $stat['value'],
                'suffix' => (string) ($stat['suffix'] ?? ''),
                'label' => $this->localePair($stat['label'] ?? []),
            ])->values()->all(),
        ])->save();

        $this->heroImage = $doctor->hero_image;
        $this->portrait = $doctor->portrait;
        $this->notify('success', 'Biography saved.');
    }

    public function render()
    {
        return view('livewire.backend.doctor-bio-form');
    }

    public function imageUrl(?string $path, ?TemporaryUploadedFile $upload): ?string
    {
        if ($upload) {
            return $upload->temporaryUrl();
        }

        $path = trim((string) $path);

        return $path !== '' ? asset($path) : null;
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

    private function storeImage(TemporaryUploadedFile $upload, ?string $current): string
    {
        $path = $upload->store('doctor', 'public');
        $this->deleteManagedImage($current);

        return 'storage/'.$path;
    }

    private function deleteManagedImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'storage/')) {
            Storage::disk('public')->delete(substr($path, strlen('storage/')));
        }
    }
}
