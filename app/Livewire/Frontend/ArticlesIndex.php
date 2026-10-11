<?php

namespace App\Livewire\Frontend;

use App\Enums\Pagination;
use App\Support\Content;
use App\View\Presenters\ArticlePresenter;
use Livewire\Attributes\Url;
use Livewire\Component;

class ArticlesIndex extends Component
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
        $articles = Content::articles();
        $categories = $articles
            ->map(fn (array $article) => ArticlePresenter::make($article))
            ->unique('categoryKey')
            ->mapWithKeys(fn (ArticlePresenter $article) => [$article->categoryKey => $article->category])
            ->all();

        $active = isset($categories[$this->category]) ? $this->category : '';

        if ($active !== '') {
            $articles = $articles->filter(
                fn (array $article) => ArticlePresenter::make($article)->categoryKey === $active
            )->values();
        }

        return view('livewire.frontend.articles-index', [
            'articles' => $this->paginateItems($articles, Pagination::PER_PAGE),
            'categories' => $categories,
            'active' => $active,
        ]);
    }
}
