<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'title',
    'summary',
    'bio',
    'credentials',
    'stats',
    'hero_image',
    'portrait',
])]
class Doctor extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'array',
            'title' => 'array',
            'summary' => 'array',
            'bio' => 'array',
            'credentials' => 'array',
            'stats' => 'array',
        ];
    }

    /**
     * Same shape the public views already read from Content::doctor().
     *
     * @return array<string, mixed>
     */
    public function toContentArray(): array
    {
        return [
            'name' => $this->name ?? [],
            'title' => $this->title ?? [],
            'summary' => $this->summary ?? [],
            'bio' => $this->bio ?? [],
            'credentials' => $this->credentials ?? [],
            'stats' => $this->stats ?? [],
            'hero_image' => $this->hero_image,
            'portrait' => $this->portrait,
        ];
    }
}
