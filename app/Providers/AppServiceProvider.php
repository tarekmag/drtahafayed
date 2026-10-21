<?php

namespace App\Providers;

use App\Support\Seo\SiteUrl;
use App\Support\Seo\StructuredData;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(StructuredData::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        URL::defaults(['locale' => 'ar']);

        if ($root = SiteUrl::canonicalRoot()) {
            URL::forceRootUrl($root);
            URL::forceScheme('https');
        }
    }
}
