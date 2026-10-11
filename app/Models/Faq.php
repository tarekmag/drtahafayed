<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['question', 'answer', 'sort', 'is_active'])]
class Faq extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'question' => 'array',
            'answer' => 'array',
            'sort' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Same shape the public FAQ list already reads.
     *
     * @return array<string, mixed>
     */
    public function toContentArray(): array
    {
        return [
            'sort' => $this->sort,
            'is_active' => $this->is_active,
            'q' => $this->question ?? [],
            'a' => $this->answer ?? [],
        ];
    }
}
