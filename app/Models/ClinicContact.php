<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['phone', 'whatsapp', 'email', 'booking_url'])]
class ClinicContact extends Model
{
    /**
     * @return array{phone: string, whatsapp: string, email: string, booking_url: string}
     */
    public function toContentArray(): array
    {
        return [
            'phone' => trim((string) $this->phone),
            'whatsapp' => preg_replace('/\D+/', '', (string) $this->whatsapp) ?? '',
            'email' => trim((string) $this->email),
            'booking_url' => trim((string) $this->booking_url),
        ];
    }
}
