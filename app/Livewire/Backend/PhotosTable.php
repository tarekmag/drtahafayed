<?php

namespace App\Livewire\Backend;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PhotosTable extends Component
{
    public string $search = '';

    public string $category = 'all';

    public string $status = 'all';

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function delete(int $photoId): void
    {
        $photo = Photo::query()->findOrFail($photoId);
        $this->deleteManagedImage($photo->image);
        $photo->delete();
        $this->notify('success', 'Photo deleted.');
    }

    public function render()
    {
        $photos = Photo::query()
            ->when($this->search !== '', function ($query) {
                $term = '%'.trim($this->search).'%';

                $query->where(function ($query) use ($term) {
                    $query->where('caption->ar', 'like', $term)
                        ->orWhere('caption->en', 'like', $term);
                });
            })
            ->when($this->category !== 'all', fn ($query) => $query->where('category', $this->category))
            ->when($this->status === 'active', fn ($query) => $query->where('is_active', true))
            ->when($this->status === 'hidden', fn ($query) => $query->where('is_active', false))
            ->orderBy('sort')
            ->orderBy('id')
            ->get();

        return view('livewire.backend.photos-table', [
            'photos' => $photos,
            'categories' => [
                'doctor' => 'The doctor',
                'clinic' => 'Clinics',
                'events' => 'Events',
            ],
        ]);
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
