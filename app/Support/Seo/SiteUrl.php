<?php

namespace App\Support\Seo;

class SiteUrl
{
    /**
     * Hosts that must never appear in canonical URLs, sitemaps, or structured data.
     *
     * @var list<string>
     */
    private const PRIVATE_HOSTS = ['localhost', '0.0.0.0', '127.0.0.1', '::1'];

    /**
     * The configured production root (APP_URL), when it is a public HTTPS address.
     * Canonical URLs are built from it so they never depend on the request Host header or install path.
     */
    public static function canonicalRoot(): ?string
    {
        $root = rtrim((string) config('app.url'), '/');

        if (! app()->isProduction() || ! str_starts_with($root, 'https://') || ! self::isPublic($root)) {
            return null;
        }

        return $root;
    }

    /**
     * Site root without any install sub-path such as `/public` or `/index.php`.
     */
    public static function root(): string
    {
        return self::canonicalRoot() ?? request()->getSchemeAndHttpHost();
    }

    /**
     * Whether a URL is an absolute http(s) address on a publicly reachable host.
     */
    public static function isPublic(string $url): bool
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            return false;
        }

        $scheme = strtolower((string) parse_url($url, PHP_URL_SCHEME));
        $host = strtolower(trim((string) parse_url($url, PHP_URL_HOST), '[]'));

        return in_array($scheme, ['http', 'https'], true)
            && $host !== ''
            && ! in_array($host, self::PRIVATE_HOSTS, true)
            && ! str_ends_with($host, '.test')
            && ! str_ends_with($host, '.local')
            && ! str_ends_with($host, '.localhost');
    }
}
