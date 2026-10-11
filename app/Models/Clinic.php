<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'slug',
    'name',
    'address',
    'hours',
    'days',
    'opens',
    'closes',
    'phone',
    'map',
    'photos',
    'sort',
    'is_active',
])]
class Clinic extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'array',
            'address' => 'array',
            'hours' => 'array',
            'days' => 'array',
            'photos' => 'array',
            'is_active' => 'boolean',
            'sort' => 'integer',
        ];
    }

    /**
     * Same shape the public views already read from Content::clinics().
     *
     * @return array<string, mixed>
     */
    public function toContentArray(): array
    {
        return [
            'id' => $this->slug,
            'sort' => $this->sort,
            'is_active' => $this->is_active,
            'name' => $this->name ?? [],
            'address' => $this->address ?? [],
            'hours' => $this->hours ?? [],
            'days' => array_map('intval', $this->days ?? []),
            'opens' => (string) $this->opens,
            'closes' => (string) $this->closes,
            'phone' => (string) $this->phone,
            'map' => (string) $this->map,
            'photos' => $this->photos ?? [],
        ];
    }
}
