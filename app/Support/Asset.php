<?php

namespace App\Support;

class Asset
{
    /**
     * Public asset URL with a file-modification query string, so browsers drop stale copies.
     */
    public static function versioned(string $path): string
    {
        $path = ltrim($path, '/');
        $file = public_path($path);

        return asset($path).(is_file($file) ? '?v='.filemtime($file) : '');
    }
}
