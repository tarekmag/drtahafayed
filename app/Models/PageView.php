<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['page', 'path', 'locale', 'session_id', 'duration_seconds'])]
class PageView extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'duration_seconds' => 'integer',
        ];
    }

    public function label(): string
    {
        return match (true) {
            $this->page === 'home' => 'Home',
            $this->page === 'about' => 'About',
            $this->page === 'services' => 'Services',
            $this->page === 'articles' => 'Articles',
            $this->page === 'photos' => 'Photos',
            $this->page === 'videos' => 'Videos',
            $this->page === 'clinics' => 'Clinics',
            $this->page === 'contact' => 'Contact',
            $this->page === 'review' => 'Review',
            str_starts_with($this->page, 'service:') => 'Service / '.substr($this->page, 8),
            str_starts_with($this->page, 'article:') => 'Article / '.substr($this->page, 8),
            default => $this->page,
        };
    }
}
