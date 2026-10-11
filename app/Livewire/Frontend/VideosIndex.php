<?php

namespace App\Livewire\Frontend;

use App\Enums\Pagination;
use App\Support\Content;
use Livewire\Component;

class VideosIndex extends Component
{
    use PaginatesContent;

    public function render()
    {
        return view('livewire.frontend.videos-index', [
            'videos' => $this->paginateItems(Content::videos(), Pagination::PER_PAGE),
        ]);
    }
}
