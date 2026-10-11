<?php

namespace App\Livewire\Frontend;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;

trait PaginatesContent
{
    use WithPagination;

    protected function paginateItems(Collection $items, int $perPage): LengthAwarePaginator
    {
        $page = $this->getPage();

        return new LengthAwarePaginator(
            $items->forPage($page, $perPage)->values(),
            $items->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'pageName' => 'page',
            ]
        );
    }

    public function paginationView(): string
    {
        return 'frontend.pagination';
    }
}
