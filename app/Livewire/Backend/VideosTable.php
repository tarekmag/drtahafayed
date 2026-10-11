<?php

namespace App\Livewire\Backend;

use App\Models\Video;
use App\Support\Content;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class VideosTable extends Component
{
    use WithPagination;

    private const PER_PAGE = 10;

    public string $search = '';

    public string $service = 'all';

    public string $status = 'all';

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingService(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function delete(int $videoId): void
    {
        $video = Video::query()->findOrFail($videoId);
        $this->deleteManagedImage($video->cover);
        $video->delete();
        $this->notify('success', 'Video deleted.');
    }

    public function render()
    {
        $videos = Video::query()
            ->when($this->search !== '', function ($query) {
                $term = '%'.trim($this->search).'%';

                $query->where(function ($query) use ($term) {
                    $query->where('title->ar', 'like', $term)
                        ->orWhere('title->en', 'like', $term);
                });
            })
            ->when($this->service !== 'all', fn ($query) => $query->where('service', $this->service))
            ->when($this->status === 'active', fn ($query) => $query->where('is_active', true))
            ->when($this->status === 'hidden', fn ($query) => $query->where('is_active', false))
            ->orderBy('sort')
            ->orderBy('id')
            ->paginate(self::PER_PAGE);

        return view('livewire.backend.videos-table', [
            'videos' => $videos,
            'services' => $this->services(),
        ]);
    }

    public function paginationView(): string
    {
        return 'livewire::bootstrap';
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

    private function deleteManagedImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'storage/')) {
            Storage::disk('public')->delete(substr($path, strlen('storage/')));
        }
    }
}
