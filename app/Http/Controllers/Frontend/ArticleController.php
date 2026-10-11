<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Support\Content;
use Illuminate\Contracts\View\View;

class ArticleController extends Controller
{
    public function show(string $locale, string $article): View
    {
        $item = Content::article($article);

        abort_unless($item, 404);

        return view('frontend.article', [
            'article' => $item,
            'related' => Content::relatedArticles($item),
        ]);
    }
}
