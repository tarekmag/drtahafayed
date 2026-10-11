<?php

namespace App\Livewire\Backend;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ArticlesTable extends Component
{
    public string $search = '';

    public string $category = 'all';

    public string $status = 'all';

    public string $sort = 'newest';

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function delete(int $articleId): void
    {
        $article = Article::query()->findOrFail($articleId);
        $this->deleteManagedImage($article->cover);
        $article->delete();
        $this->notify('success', 'Article deleted.');
    }

    public function render()
    {
        $articles = Article::query()
            ->when($this->search !== '', function ($query) {
                $term = '%'.trim($this->search).'%';

                $query->where(function ($query) use ($term) {
                    $query->where('title->ar', 'like', $term)
                        ->orWhere('title->en', 'like', $term);
                });
            })
            ->when($this->category !== 'all', fn ($query) => $query->where('category->en', $this->category))
            ->when($this->status === 'active', fn ($query) => $query->where('is_active', true))
            ->when($this->status === 'hidden', fn ($query) => $query->where('is_active', false))
            ->orderBy('published_at', $this->sort === 'oldest' ? 'asc' : 'desc')
            ->orderBy('sort')
            ->get();

        $categories = Article::query()
            ->get(['category'])
            ->map(fn (Article $article) => [
                'en' => (string) ($article->category['en'] ?? ''),
                'ar' => (string) ($article->category['ar'] ?? ''),
            ])
            ->filter(fn (array $category) => $category['en'] !== '')
            ->unique('en')
            ->sortBy('en')
            ->values();

        return view('livewire.backend.articles-table', [
            'articles' => $articles,
            'categories' => $categories,
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
