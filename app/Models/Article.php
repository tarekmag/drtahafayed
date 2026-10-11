<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'slug',
    'category',
    'title',
    'excerpt',
    'body',
    'published_at',
    'read_minutes',
    'cover',
    'sort',
    'is_active',
])]
class Article extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'category' => 'array',
            'title' => 'array',
            'excerpt' => 'array',
            'body' => 'array',
            'published_at' => 'date',
            'read_minutes' => 'integer',
            'sort' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Same shape the public views already read from Content::articles().
     *
     * @return array<string, mixed>
     */
    public function toContentArray(): array
    {
        return [
            'slug' => $this->slug,
            'sort' => $this->sort,
            'is_active' => $this->is_active,
            'published_at' => $this->published_at?->toDateString() ?? '',
            'read_minutes' => $this->read_minutes,
            'cover' => (string) $this->cover,
            'category' => $this->category ?? [],
            'title' => $this->title ?? [],
            'excerpt' => $this->excerpt ?? [],
            'body' => $this->body ?? [],
        ];
    }
}
