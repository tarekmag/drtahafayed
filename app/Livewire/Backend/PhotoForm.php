<?php

namespace App\Livewire\Backend;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class PhotoForm extends Component
{
    use WithFileUploads;

    public ?int $photoId = null;

    public ?string $image = null;

    public ?TemporaryUploadedFile $imageUpload = null;

    public string $category = 'doctor';

    /** @var array{ar: string, en: string} */
    public array $caption = ['ar' => '', 'en' => ''];

    public int $sort = 0;

    public bool $isActive = true;

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(?Photo $photo = null): void
    {
        if ($photo) {
            $this->photoId = $photo->id;
            $this->image = $photo->image;
            $this->category = $photo->category;
            $this->caption = $this->localePair($photo->caption);
            $this->sort = $photo->sort;
            $this->isActive = $photo->is_active;
        } else {
            $this->sort = (int) Photo::query()->max('sort') + 1;
        }

        if ($message = session('photoNotice')) {
            $this->notify('success', $message);
        }
    }

    public function save(): void
    {
        $this->caption = $this->localePair($this->caption);

        try {
            $this->validate();
        } catch (ValidationException $exception) {
            $this->notify('danger', (string) $exception->validator->errors()->first());

            throw $exception;
        }

        $photo = $this->photoId
            ? Photo::query()->findOrFail($this->photoId)
            : new Photo;

        if ($this->imageUpload) {
            $path = $this->imageUpload->store('photos', 'public');
            $this->deleteManagedImage($photo->image);
            $this->image = 'storage/'.$path;
            $this->imageUpload = null;
        }

        $photo->fill([
            'image' => $this->image,
            'category' => $this->category,
            'caption' => $this->caption,
            'sort' => $this->sort,
            'is_active' => $this->isActive,
        ])->save();

        if ($this->photoId === null) {
            session()->flash('photoNotice', 'Photo saved.');
            $this->redirect(route('backend.photos.edit', $photo));

            return;
        }

        $this->notify('success', 'Photo saved.');
    }

    public function render()
    {
        return view('livewire.backend.photo-form', [
            'categories' => [
                'doctor' => 'The doctor',
                'clinic' => 'Clinics',
                'events' => 'Events',
            ],
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
            'imageUpload' => [$this->image ? 'nullable' : 'required', 'image', 'max:4096'],
            'category' => ['required', Rule::in(['doctor', 'clinic', 'events'])],
            'caption.ar' => ['required', 'string', 'max:255'],
            'caption.en' => ['required', 'string', 'max:255'],
            'sort' => ['required', 'integer', 'min:0'],
            'isActive' => ['boolean'],
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

    private function deleteManagedImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'storage/')) {
            Storage::disk('public')->delete(substr($path, strlen('storage/')));
        }
    }
}
