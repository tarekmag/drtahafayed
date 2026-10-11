<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'url',
    'cover',
    'duration',
    'service',
    'title',
    'sort',
    'is_active',
])]
class Video extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'title' => 'array',
            'sort' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Same shape the public views already read from Content::videos().
     *
     * @return array<string, mixed>
     */
    public function toContentArray(): array
    {
        return [
            'sort' => $this->sort,
            'is_active' => $this->is_active,
            'url' => (string) $this->url,
            'cover' => (string) $this->cover,
            'duration' => (string) $this->duration,
            'service' => (string) $this->service,
            'title' => $this->title ?? [],
        ];
    }
}
