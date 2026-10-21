<?php

namespace App\Support;

class ResponsiveImage
{
    /**
     * @var list<int>
     */
    private const WIDTHS = [480, 800, 1200];

    public static function url(string $src): string
    {
        return self::isRemote($src) ? $src : asset(ltrim($src, '/'));
    }

    /**
     * WebP `srcset` built from pre-generated `{name}-{width}.webp` siblings of a local JPEG or PNG.
     */
    public static function webpSrcset(string $src): ?string
    {
        if (self::isRemote($src) || ! preg_match('/\.(jpe?g|png)$/i', $src)) {
            return null;
        }

        $base = preg_replace('/\.(jpe?g|png)$/i', '', ltrim($src, '/'));
        $sources = [];

        foreach (self::WIDTHS as $width) {
            if (is_file(public_path("{$base}-{$width}.webp"))) {
                $sources[] = asset("{$base}-{$width}.webp")." {$width}w";
            }
        }

        return $sources === [] ? null : implode(', ', $sources);
    }

    /**
     * Search engines and social networks only accept raster images for previews and rich results.
     */
    public static function isRaster(?string $url): bool
    {
        $path = strtolower((string) parse_url((string) $url, PHP_URL_PATH));

        return preg_match('/\.(jpe?g|png|webp|gif)$/', $path) === 1;
    }

    private static function isRemote(string $src): bool
    {
        return preg_match('#^https?://#i', $src) === 1;
    }
}
