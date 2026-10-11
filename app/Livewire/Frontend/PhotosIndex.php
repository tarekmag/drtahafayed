<?php

namespace App\Livewire\Frontend;

use App\Enums\Pagination;
use App\Support\Content;
use Livewire\Attributes\Url;
use Livewire\Component;

class PhotosIndex extends Component
{
    use PaginatesContent;

    #[Url(except: '')]
    public string $category = '';

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = __('site.photos.categories');
        $photos = Content::gallery();

        $active = isset($categories[$this->category]) ? $this->category : '';

        if ($active !== '') {
            $photos = $photos->filter(
                fn (array $photo) => ($photo['category'] ?? '') === $active
            )->values();
        }

        return view('livewire.frontend.photos-index', [
            'photos' => $this->paginateItems($photos, Pagination::PER_PAGE),
            'categories' => $categories,
            'active' => $active,
        ]);
    }
}
