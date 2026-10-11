<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'page',
    'meta_title',
    'meta_description',
])]
class SeoPage extends Model
{
    /**
     * Public pages whose title and description are edited from the SEO screen.
     *
     * @var array<string, string>
     */
    public const PAGES = [
        'home' => 'Home',
        'about' => 'About',
        'services' => 'Services',
        'articles' => 'Articles',
        'photos' => 'Photos',
        'videos' => 'Videos',
        'clinics' => 'Clinics',
        'contact' => 'Contact',
        'review' => 'Review',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'meta_title' => 'array',
            'meta_description' => 'array',
        ];
    }
}
