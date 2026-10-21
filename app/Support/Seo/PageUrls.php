<?php

namespace App\Support\Seo;

use Illuminate\Support\Facades\Route;

/**
 * Canonical and language-alternate URLs for the current public page.
 */
class PageUrls
{
    /**
     * @var list<string>
     */
    public const LOCALES = ['ar', 'en'];

    public const DEFAULT_LOCALE = 'ar';

    /**
     * Self-referencing canonical URL. Tracking and filter parameters are dropped;
     * `page` is kept for unfiltered paginated listings so each page stays indexable on its own.
     */
    public static function canonical(): string
    {
        $url = self::localized(app()->getLocale());
        $page = self::page();
        $otherParameters = array_diff(array_keys(request()->query()), ['page']);

        return $page > 1 && $otherParameters === [] ? $url.'?page='.$page : $url;
    }

    /**
     * hreflang alternates for the current page, including x-default.
     *
     * @return array<string, string>
     */
    public static function alternates(): array
    {
        $alternates = [];

        foreach (self::LOCALES as $locale) {
            $alternates[$locale] = self::localized($locale);
        }

        $alternates['x-default'] = $alternates[self::DEFAULT_LOCALE];

        return $alternates;
    }

    public static function localized(string $locale): string
    {
        $route = Route::current();

        if ($route === null || $route->getName() === null) {
            return url()->current();
        }

        $parameters = array_intersect_key($route->originalParameters(), array_flip($route->parameterNames()));

        return route($route->getName(), array_merge($parameters, ['locale' => $locale]));
    }

    /**
     * Page one of a listing lives at the bare URL, so `?page=1` links would only create duplicates.
     */
    public static function withoutFirstPage(string $url): string
    {
        [$path, $queryString] = array_pad(explode('?', $url, 2), 2, '');
        parse_str($queryString, $query);

        if ((string) ($query['page'] ?? '') === '1') {
            unset($query['page']);
        }

        return $path.($query === [] ? '' : '?'.http_build_query($query));
    }

    public static function page(): int
    {
        $page = filter_var(request()->query('page'), FILTER_VALIDATE_INT);

        return is_int($page) && $page > 1 ? $page : 1;
    }
}
