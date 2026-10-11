<?php

namespace App\Support;

class LocaleText
{
    public static function get(mixed $value): string
    {
        if (is_array($value)) {
            $locale = app()->getLocale();

            return trim((string) ($value[$locale] ?? $value['ar'] ?? $value['en'] ?? ''));
        }

        return trim((string) $value);
    }
}
