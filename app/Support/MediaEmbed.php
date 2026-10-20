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

    public static function thumbnail(?string $value): ?string
    {
        $id = self::youtubeId((string) $value);

        return $id ? 'https://i.ytimg.com/vi/'.$id.'/hqdefault.jpg' : null;
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

        if ($id = self::youtubeId($value)) {
            return [
                'type' => 'iframe',
                'src' => 'https://www.youtube-nocookie.com/embed/'.$id,
            ];
        }

        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/i', $value, $matches)) {
            return [
                'type' => 'iframe',
                'src' => 'https://player.vimeo.com/video/'.$matches[1],
            ];
        }

        if ($facebook = self::facebookEmbed($value)) {
            return [
                'type' => 'iframe',
                'src' => $facebook,
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

    /**
     * Google Maps link and embed source for a search query, "lat,lng", or a full https URL.
     *
     * @return array{link: string, src: string}|null
     */
    public static function map(?string $value): ?array
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        if (preg_match('#^https?://#i', $value)) {
            return ['link' => $value, 'src' => $value];
        }

        $query = rawurlencode($value);

        return [
            'link' => 'https://www.google.com/maps/search/?api=1&query='.$query,
            'src' => 'https://maps.google.com/maps?q='.$query.'&z=15&output=embed',
        ];
    }

    private static function facebookEmbed(string $value): ?string
    {
        if (preg_match('#facebook\.com/plugins/video\.php#i', $value)) {
            return $value;
        }

        $isFacebook = preg_match('#^https?://(?:[\w-]+\.)?(?:facebook\.com|fb\.watch)/#i', $value) === 1;

        if (! $isFacebook) {
            return null;
        }

        $canonical = preg_replace('#^https?://(?:[\w-]+\.)?facebook\.com#i', 'https://www.facebook.com', $value) ?? $value;
        $isVideo = preg_match('#facebook\.com/(?:reel|reels|watch)(?:/|\?|$)#i', $canonical) === 1
            || preg_match('#facebook\.com/.+/videos/#i', $canonical) === 1
            || preg_match('#fb\.watch/#i', $value) === 1;

        if (! $isVideo) {
            return null;
        }

        return 'https://www.facebook.com/plugins/video.php?href='.rawurlencode($canonical).'&show_text=false';
    }

    private static function youtubeId(string $value): ?string
    {
        return preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([\w-]{6,})/i', $value, $matches)
            ? $matches[1]
            : null;
    }
}
