<?php

namespace App\Livewire\Backend;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ArticleForm extends Component
{
    use WithFileUploads;

    public ?int $articleId = null;

    public string $slug = '';

    /** @var array{ar: string, en: string} */
    public array $category = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $title = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $excerpt = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $body = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $metaTitle = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $metaDescription = ['ar' => '', 'en' => ''];

    public ?string $publishedAt = null;

    public int $readMinutes = 5;

    public ?string $cover = null;

    public ?TemporaryUploadedFile $coverUpload = null;

    public int $sort = 0;

    public bool $isActive = true;

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(?Article $article = null): void
    {
        if ($article) {
            $this->articleId = $article->id;
            $this->slug = $article->slug;
            $this->category = $this->localePair($article->category);
            $this->title = $this->localePair($article->title);
            $this->excerpt = $this->localePair($article->excerpt);
            $this->body = $this->localePair($article->body);
            $this->metaTitle = $this->localePair($article->meta_title);
            $this->metaDescription = $this->localePair($article->meta_description);
            $this->publishedAt = $article->published_at?->toDateString();
            $this->readMinutes = $article->read_minutes;
            $this->cover = $article->cover;
            $this->sort = $article->sort;
            $this->isActive = $article->is_active;
        } else {
            $this->sort = (int) Article::query()->max('sort') + 1;
            $this->publishedAt = now()->toDateString();
        }

        if ($message = session('articleNotice')) {
            $this->notify('success', $message);
        }
    }

    public function updatedTitle(string $value, string $key): void
    {
        if ($key === 'en' && $this->articleId === null && trim($this->slug) === '') {
            $this->slug = Str::slug($value);
        }
    }

    public function save(): void
    {
        $this->slug = Str::slug(trim($this->slug !== '' ? $this->slug : $this->title['en']));
        $this->category = $this->localePair($this->category);
        $this->title = $this->localePair($this->title);
        $this->excerpt = $this->localePair($this->excerpt);
        $this->body = $this->localePair($this->body);
        $this->metaTitle = $this->localePair($this->metaTitle);
        $this->metaDescription = $this->localePair($this->metaDescription);
        $this->publishedAt = trim((string) $this->publishedAt) ?: null;

        try {
            $this->validate();
        } catch (ValidationException $exception) {
            $this->notify('danger', (string) $exception->validator->errors()->first());

            throw $exception;
        }

        $article = $this->articleId
            ? Article::query()->findOrFail($this->articleId)
            : new Article;

        if ($this->coverUpload) {
            $path = $this->coverUpload->store('articles', 'public');
            $this->deleteManagedImage($article->cover);
            $this->cover = 'storage/'.$path;
            $this->coverUpload = null;
        }

        $article->fill([
            'slug' => $this->slug,
            'category' => $this->category,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'meta_title' => $this->filledPair($this->metaTitle),
            'meta_description' => $this->filledPair($this->metaDescription),
            'published_at' => $this->publishedAt,
            'read_minutes' => $this->readMinutes,
            'cover' => $this->cover,
            'sort' => $this->sort,
            'is_active' => $this->isActive,
        ])->save();

        if ($this->articleId === null) {
            session()->flash('articleNotice', 'Article saved.');
            $this->redirect(route('backend.articles.edit', $article));

            return;
        }

        $this->notify('success', 'Article saved.');
    }

    public function render()
    {
        return view('livewire.backend.article-form');
    }

    public function coverUrl(): ?string
    {
        if ($this->coverUpload) {
            return $this->coverUpload->temporaryUrl();
        }

        $cover = trim((string) $this->cover);

        return $cover !== '' ? asset($cover) : null;
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'slug' => ['required', 'alpha_dash', 'max:160', Rule::unique('articles', 'slug')->ignore($this->articleId)],
            'category.ar' => ['required', 'string', 'max:120'],
            'category.en' => ['required', 'string', 'max:120'],
            'title.ar' => ['required', 'string', 'max:255'],
            'title.en' => ['required', 'string', 'max:255'],
            'excerpt.ar' => ['required', 'string', 'max:500'],
            'excerpt.en' => ['required', 'string', 'max:500'],
            'body.ar' => ['required', 'string'],
            'body.en' => ['required', 'string'],
            'metaTitle.ar' => ['nullable', 'string', 'max:180'],
            'metaTitle.en' => ['nullable', 'string', 'max:180'],
            'metaDescription.ar' => ['nullable', 'string', 'max:320'],
            'metaDescription.en' => ['nullable', 'string', 'max:320'],
            'publishedAt' => ['required', 'date'],
            'readMinutes' => ['required', 'integer', 'min:1', 'max:120'],
            'sort' => ['required', 'integer', 'min:0'],
            'isActive' => ['boolean'],
            'coverUpload' => ['nullable', 'image', 'max:4096'],
        ];
    }

    private function notify(string $type, string $message): void
    {
        $this->noticeType = $type;
        $this->noticeMessage = $message;
        $this->noticeKey++;
    }

    /**
     * @param  array{ar: string, en: string}  $value
     * @return array{ar: string, en: string}|null
     */
    private function filledPair(array $value): ?array
    {
        return ($value['ar'] === '' && $value['en'] === '') ? null : $value;
    }

    /**
     * @return array{ar: string, en: string}
     */
    private function localePair(mixed $value): array
    {
        return [
            'ar' => trim((string) (is_array($value) ? ($value['ar'] ?? '') : '')),
            'en' => trim((string) (is_array($value) ? ($value['en'] ?? '') : '')),
        ];
    }

    private function deleteManagedImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'storage/')) {
            Storage::disk('public')->delete(substr($path, strlen('storage/')));
        }
    }
}
