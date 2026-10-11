<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return view('backend.articles.index');
    }

    public function create()
    {
        return view('backend.articles.create');
    }

    public function edit(Article $article)
    {
        return view('backend.articles.edit', compact('article'));
    }
}
