<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'image',
    'category',
    'caption',
    'sort',
    'is_active',
])]
class Photo extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'caption' => 'array',
            'sort' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Same shape the public views already read from Content::gallery().
     *
     * @return array<string, mixed>
     */
    public function toContentArray(): array
    {
        return [
            'sort' => $this->sort,
            'is_active' => $this->is_active,
            'image' => (string) $this->image,
            'category' => (string) $this->category,
            'caption' => $this->caption ?? [],
        ];
    }
}
