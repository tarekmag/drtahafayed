<?php

namespace App\Support\Seo;

class SearchIndexing
{
    public const INDEX = 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';

    public const NOINDEX = 'noindex, follow';

    /**
     * Only the production site may be indexed; local and staging copies stay out of search results.
     */
    public static function enabled(): bool
    {
        return app()->isProduction();
    }

    public static function robots(bool $indexable = true): string
    {
        return self::enabled() && $indexable ? self::INDEX : self::NOINDEX;
    }
}
