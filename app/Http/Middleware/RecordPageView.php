<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecordPageView
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldRecord($request)) {
            $view = PageView::query()->create([
                'page' => $this->pageKey($request),
                'path' => '/'.ltrim($request->path(), '/'),
                'locale' => app()->getLocale(),
                'session_id' => $request->session()->getId(),
                'duration_seconds' => 0,
            ]);

            view()->share('pageViewId', $view->id);
        }

        return $next($request);
    }

    private function shouldRecord(Request $request): bool
    {
        if (! $request->isMethod('GET') || $request->ajax() || $request->expectsJson()) {
            return false;
        }

        $purpose = strtolower((string) ($request->header('Purpose') ?: $request->header('Sec-Purpose')));

        if (str_contains($purpose, 'prefetch')) {
            return false;
        }

        $agent = (string) $request->userAgent();

        return $agent !== '' && ! preg_match('/bot|crawl|spider|slurp|preview|lighthouse|headless/i', $agent);
    }

    private function pageKey(Request $request): string
    {
        return match ($request->route()?->getName()) {
            'site.home' => 'home',
            'site.about' => 'about',
            'site.services' => 'services',
            'site.service' => 'service:'.$request->route('service'),
            'site.articles' => 'articles',
            'site.article' => 'article:'.$request->route('article'),
            'site.photos' => 'photos',
            'site.videos' => 'videos',
            'site.clinics' => 'clinics',
            'site.contact' => 'contact',
            'site.review' => 'review',
            default => 'other',
        };
    }
}
