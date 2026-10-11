<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['facebook', 'vezeeta', 'youtube', 'tiktok'])]
class SocialProfile extends Model
{
    /**
     * @return array<string, string>
     */
    public function toContentArray(): array
    {
        return array_filter([
            'facebook' => trim((string) $this->facebook),
            'vezeeta' => trim((string) $this->vezeeta),
            'youtube' => trim((string) $this->youtube),
            'tiktok' => trim((string) $this->tiktok),
        ]);
    }
}
