<?php

namespace App\Models;

use App\Support\Seo\SiteUrl;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['facebook', 'instagram', 'vezeeta', 'clinido', 'youtube', 'tiktok'])]
class SocialProfile extends Model
{
    /**
     * Public profile links only; local or development addresses are never rendered.
     *
     * @return array<string, string>
     */
    public function toContentArray(): array
    {
        return array_filter([
            'facebook' => trim((string) $this->facebook),
            'instagram' => trim((string) $this->instagram),
            // 'vezeeta' => trim((string) $this->vezeeta),
            // 'clinido' => trim((string) $this->clinido),
            'youtube' => trim((string) $this->youtube),
            'tiktok' => trim((string) $this->tiktok),
        ], fn (string $url) => $url !== '' && SiteUrl::isPublic($url));
    }
}
