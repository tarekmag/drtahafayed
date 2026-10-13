<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'slug',
    'specialty',
    'icon',
    'image',
    'video',
    'title',
    'excerpt',
    'body',
    'faqs',
    'conditions',
    'related',
    'meta_title',
    'meta_description',
    'sort',
    'is_active',
])]
class Service extends Model
{
    public const SPECIALTIES = [
        'general' => 'General surgery',
        'oncology' => 'Surgical oncology',
        'endocrine' => 'Gland surgery',
    ];

    public const ICONS = [
        'general',
        'oncology',
        'endocrine',
        'thyroid',
        'parathyroid',
        'laparoscopy',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'title' => 'array',
            'excerpt' => 'array',
            'body' => 'array',
            'faqs' => 'array',
            'conditions' => 'array',
            'related' => 'array',
            'meta_title' => 'array',
            'meta_description' => 'array',
            'sort' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Same shape the public views already read from Content::services().
     *
     * @return array<string, mixed>
     */
    public function toContentArray(): array
    {
        return [
            'slug' => $this->slug,
            'sort' => $this->sort,
            'is_active' => $this->is_active,
            'specialty' => $this->specialty,
            'icon' => $this->icon,
            'image' => (string) $this->image,
            'video' => (string) $this->video,
            'title' => $this->title ?? [],
            'excerpt' => $this->excerpt ?? [],
            'body' => $this->body ?? [],
            'faqs' => $this->faqs ?? [],
            'conditions' => $this->conditions ?? [],
            'related' => $this->related ?? [],
            'meta_title' => $this->meta_title ?? [],
            'meta_description' => $this->meta_description ?? [],
        ];
    }
}
