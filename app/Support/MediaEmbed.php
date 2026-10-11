<?php

namespace App\Support;

class MediaEmbed
{
    public static function image(?string $value): ?string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        if (preg_match('#^https?://#i', $value)) {
            return $value;
        }

        return asset(ltrim($value, '/'));
    }

    /**
     * @return array{type: string, src: string}|null
     */
    public static function video(?string $value): ?array
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([\w-]{6,})/i', $value, $matches)) {
            return [
                'type' => 'iframe',
                'src' => 'https://www.youtube.com/embed/'.$matches[1],
            ];
        }

        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/i', $value, $matches)) {
            return [
                'type' => 'iframe',
                'src' => 'https://player.vimeo.com/video/'.$matches[1],
            ];
        }

        if (preg_match('/\.(mp4|webm|ogg)(\?.*)?$/i', $value)) {
            return [
                'type' => 'file',
                'src' => preg_match('#^https?://#i', $value) ? $value : asset(ltrim($value, '/')),
            ];
        }

        if (preg_match('#^https?://#i', $value)) {
            return [
                'type' => 'iframe',
                'src' => $value,
            ];
        }

        return null;
    }
}
