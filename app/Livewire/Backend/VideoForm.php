<?php

namespace App\Livewire\Backend;

use App\Models\Video;
use App\Support\Content;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class VideoForm extends Component
{
    use WithFileUploads;

    public ?int $videoId = null;

    public string $url = '';

    public ?string $cover = null;

    public ?TemporaryUploadedFile $coverUpload = null;

    public string $duration = '';

    public string $service = '';

    /** @var array{ar: string, en: string} */
    public array $title = ['ar' => '', 'en' => ''];

    public int $sort = 0;

    public bool $isActive = true;

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(?Video $video = null): void
    {
        if ($video) {
            $this->videoId = $video->id;
            $this->url = $video->url;
            $this->cover = $video->cover;
            $this->duration = (string) $video->duration;
            $this->service = (string) $video->service;
            $this->title = $this->localePair($video->title);
            $this->sort = $video->sort;
            $this->isActive = $video->is_active;
        } else {
            $this->sort = (int) Video::query()->max('sort') + 1;
        }

        if ($message = session('videoNotice')) {
            $this->notify('success', $message);
        }
    }

    public function save(): void
    {
        $this->title = $this->localePair($this->title);
        $this->url = trim($this->url);
        $this->duration = trim($this->duration);
        $this->service = trim($this->service);

        try {
            $this->validate();
        } catch (ValidationException $exception) {
            $this->notify('danger', (string) $exception->validator->errors()->first());

            throw $exception;
        }

        $video = $this->videoId
            ? Video::query()->findOrFail($this->videoId)
            : new Video;

        if ($this->coverUpload) {
            $path = $this->coverUpload->store('videos', 'public');
            $this->deleteManagedImage($video->cover);
            $this->cover = 'storage/'.$path;
            $this->coverUpload = null;
        }

        $video->fill([
            'url' => $this->url,
            'cover' => $this->cover,
            'duration' => $this->duration !== '' ? $this->duration : null,
            'service' => $this->service !== '' ? $this->service : null,
            'title' => $this->title,
            'sort' => $this->sort,
            'is_active' => $this->isActive,
        ])->save();

        if ($this->videoId === null) {
            session()->flash('videoNotice', 'Video saved.');
            $this->redirect(route('backend.videos.edit', $video));

            return;
        }

        $this->notify('success', 'Video saved.');
    }

    public function render()
    {
        return view('livewire.backend.video-form', [
            'services' => $this->services(),
        ]);
    }

    public function coverUrl(): ?string
    {
        if ($this->coverUpload) {
            return $this->coverUpload->temporaryUrl();
        }

        $cover = trim((string) $this->cover);

        return $cover !== '' ? asset($cover) : null;
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'url' => ['required', 'string', 'max:500'],
            'coverUpload' => ['nullable', 'image', 'max:4096'],
            'duration' => ['nullable', 'string', 'max:12'],
            'service' => ['nullable', Rule::in(array_keys($this->services()))],
            'title.ar' => ['required', 'string', 'max:255'],
            'title.en' => ['required', 'string', 'max:255'],
            'sort' => ['required', 'integer', 'min:0'],
            'isActive' => ['boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    private function services(): array
    {
        return Content::services()
            ->mapWithKeys(fn (array $service) => [
                $service['slug'] => (string) ($service['title']['en'] ?? $service['slug']),
            ])
            ->all();
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
