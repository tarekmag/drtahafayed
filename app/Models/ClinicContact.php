<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['phone', 'phone_secondary', 'whatsapp', 'email', 'booking_url'])]
class ClinicContact extends Model
{
    /**
     * @return array{phone: string, phone_secondary: string, whatsapp: string, email: string, booking_url: string}
     */
    public function toContentArray(): array
    {
        return [
            'phone' => trim((string) $this->phone),
            'phone_secondary' => trim((string) $this->phone_secondary),
            'whatsapp' => preg_replace('/\D+/', '', (string) $this->whatsapp) ?? '',
            'email' => trim((string) $this->email),
            'booking_url' => trim((string) $this->booking_url),
        ];
    }
}
