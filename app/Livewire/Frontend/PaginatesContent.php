<?php

namespace App\Livewire\Frontend;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Livewire;
use Livewire\WithPagination;

trait PaginatesContent
{
    use WithPagination;

    /**
     * @param  array<string, string>  $query  Active filters kept in the crawlable page links.
     */
    protected function paginateItems(Collection $items, int $perPage, array $query = []): LengthAwarePaginator
    {
        $page = $this->getPage();

        return new LengthAwarePaginator(
            $items->forPage($page, $perPage)->values(),
            $items->count(),
            $perPage,
            $page,
            [
                'path' => Livewire::originalUrl(),
                'pageName' => 'page',
                'query' => array_filter($query),
            ]
        );
    }

    public function paginationView(): string
    {
        return 'frontend.pagination';
    }
}
