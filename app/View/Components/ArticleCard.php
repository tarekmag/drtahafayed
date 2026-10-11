<?php

namespace App\View\Components;

use App\View\Presenters\ArticlePresenter;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleCard extends Component
{
    public ArticlePresenter $article;

    public function __construct(
        array $article,
        public bool $featured = false,
        public int $index = 0,
    ) {
        $this->article = ArticlePresenter::make($article);
    }

    public function render(): View
    {
        return view('components.article-card');
    }
}
