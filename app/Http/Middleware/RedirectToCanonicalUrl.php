<?php

namespace App\Http\Middleware;

use App\Support\Seo\SiteUrl;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Permanently redirects duplicate URL variants (trailing slashes, repeated slashes,
 * and install paths such as `/public/ar` or `/index.php/ar`) to one canonical address.
 */
class RedirectToCanonicalUrl
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethodSafe()) {
            return $next($request);
        }

        $path = $request->getPathInfo();
        $canonicalPath = $this->normalize($path);

        if ($request->getBaseUrl() === '' && $canonicalPath === $path) {
            return $next($request);
        }

        $query = $request->getQueryString();

        return redirect()->to(SiteUrl::root().$canonicalPath.($query ? '?'.$query : ''), 301);
    }

    private function normalize(string $path): string
    {
        $path = preg_replace('#/{2,}#', '/', $path) ?? $path;

        return $path === '/' ? $path : rtrim($path, '/');
    }
}
