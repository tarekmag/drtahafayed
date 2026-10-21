<?php

namespace Tests\Feature;

use App\Http\Middleware\RedirectToCanonicalUrl;
use App\Models\Article;
use App\Models\PatientReview;
use App\Models\Service;
use App\Models\SocialProfile;
use App\Models\User;
use App\Support\Seo\SiteUrl;
use DOMDocument;
use DOMXPath;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var list<string>
     */
    private const STATIC_PAGES = ['', '/about', '/services', '/clinics', '/articles', '/photos', '/videos', '/contact', '/review'];

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_root_permanently_redirects_to_the_arabic_home_page(): void
    {
        $this->get('/')->assertStatus(301)->assertRedirect('/ar');
    }

    /**
     * @return array<string, array{string, string|null, string}>
     */
    public static function duplicateUrlProvider(): array
    {
        return [
            'trailing slash' => ['/ar/', null, 'http://localhost/ar'],
            'nested trailing slash' => ['/en/services/', null, 'http://localhost/en/services'],
            'repeated slashes' => ['/ar//about', null, 'http://localhost/ar/about'],
            'trailing slash keeps query' => ['/ar/articles/?page=2', null, 'http://localhost/ar/articles?page=2'],
            'public install path' => ['/public/ar/about', '/public/index.php', 'http://localhost/ar/about'],
            'front controller path' => ['/index.php/ar/about', '/index.php', 'http://localhost/ar/about'],
        ];
    }

    #[DataProvider('duplicateUrlProvider')]
    public function test_duplicate_url_variants_redirect_permanently(string $uri, ?string $script, string $target): void
    {
        $server = $script ? ['SCRIPT_NAME' => $script, 'SCRIPT_FILENAME' => public_path('index.php')] : [];
        $request = Request::create('http://localhost'.$uri, server: $server);
        $this->app->instance('request', $request);

        $response = (new RedirectToCanonicalUrl)->handle($request, fn () => response('page'));

        $this->assertSame(301, $response->getStatusCode());
        $this->assertSame($target, $response->headers->get('Location'));
    }

    public function test_canonical_urls_pass_through_the_redirect_middleware(): void
    {
        $request = Request::create('http://localhost/ar/about?utm_source=x');
        $this->app->instance('request', $request);

        $response = (new RedirectToCanonicalUrl)->handle($request, fn () => response('page'));

        $this->assertSame('page', $response->getContent());
    }

    public function test_form_submissions_are_never_redirected(): void
    {
        $request = Request::create('http://localhost/ar/contact/', 'POST');
        $this->app->instance('request', $request);

        $response = (new RedirectToCanonicalUrl)->handle($request, fn () => response('submitted'));

        $this->assertSame('submitted', $response->getContent());
    }

    public function test_unknown_pages_return_not_found(): void
    {
        $this->get('/ar/services/does-not-exist')->assertNotFound();
        $this->get('/ar/articles/does-not-exist')->assertNotFound();
        $this->get('/fr')->assertNotFound();
    }

    public function test_public_pages_render_complete_unique_metadata(): void
    {
        $this->app['env'] = 'production';
        PatientReview::query()->create(['name' => 'Patient', 'rating' => 5, 'body' => 'Clear explanation.', 'locale' => 'ar', 'source' => 'website', 'is_published' => true]);

        $titles = [];
        $descriptions = [];

        foreach (['ar', 'en'] as $locale) {
            foreach ($this->localizedPages($locale) as $path) {
                $page = $this->page($this->get($path)->assertOk());
                $url = 'http://localhost'.$path;

                $this->assertSame($locale, $page->evaluate('string(/html/@lang)'), $path);
                $this->assertSame($locale === 'ar' ? 'rtl' : 'ltr', $page->evaluate('string(/html/@dir)'), $path);
                $this->assertSame(1, $page->query('//title')->length, $path);
                $this->assertSame(1, $page->query('//meta[@name="description"]')->length, $path);
                $this->assertSame(1, $page->query('//link[@rel="canonical"]')->length, $path);
                $this->assertSame(1, $page->query('//h1')->length, $path);
                $this->assertSame($url, $page->evaluate('string(//link[@rel="canonical"]/@href)'), $path);
                $this->assertSame($url, $page->evaluate('string(//meta[@property="og:url"]/@content)'), $path);
                $this->assertStringStartsWith('index, follow', $page->evaluate('string(//meta[@name="robots"]/@content)'), $path);
                $this->assertMatchesRegularExpression('/\.(jpe?g|png|webp)$/', $page->evaluate('string(//meta[@property="og:image"]/@content)'), $path);

                $titles[$path] = trim($page->evaluate('string(//title)'));
                $descriptions[$path] = $page->evaluate('string(//meta[@name="description"]/@content)');
            }
        }

        $this->assertSame(array_unique($titles), $titles, 'Duplicate titles');
        $this->assertSame(array_unique($descriptions), $descriptions, 'Duplicate descriptions');
    }

    public function test_hreflang_alternates_are_reciprocal(): void
    {
        $service = Service::query()->where('is_active', true)->value('slug');

        foreach (['/about', '/services/'.$service] as $suffix) {
            $ar = $this->page($this->get('/ar'.$suffix));
            $en = $this->page($this->get('/en'.$suffix));

            foreach ([$ar, $en] as $page) {
                $this->assertSame('http://localhost/ar'.$suffix, $page->evaluate('string(//link[@hreflang="ar"]/@href)'));
                $this->assertSame('http://localhost/en'.$suffix, $page->evaluate('string(//link[@hreflang="en"]/@href)'));
                $this->assertSame('http://localhost/ar'.$suffix, $page->evaluate('string(//link[@hreflang="x-default"]/@href)'));
            }
        }
    }

    public function test_canonical_ignores_tracking_and_filter_parameters(): void
    {
        $tracked = $this->page($this->get('/ar/about?utm_source=facebook&fbclid=abc'));
        $filtered = $this->page($this->get('/ar/articles?category=general&page=2'));

        $this->assertSame('http://localhost/ar/about', $tracked->evaluate('string(//link[@rel="canonical"]/@href)'));
        $this->assertSame('http://localhost/ar/articles', $filtered->evaluate('string(//link[@rel="canonical"]/@href)'));
    }

    public function test_paginated_listings_have_crawlable_self_canonical_pages(): void
    {
        $this->assertGreaterThan(10, Article::query()->where('is_active', true)->count());

        $first = $this->page($this->get('/ar/articles'));
        $second = $this->page($this->get('/ar/articles?page=2'));

        $this->assertSame('http://localhost/ar/articles?page=2', $first->evaluate('string(//nav[@class="pager"]//a[@rel="next"]/@href)'));
        $this->assertSame('http://localhost/ar/articles?page=2', $second->evaluate('string(//link[@rel="canonical"]/@href)'));
        $this->assertSame('http://localhost/ar/articles', $second->evaluate('string(//nav[@class="pager"]//a[@rel="prev"]/@href)'));
        $this->assertStringContainsString('صفحة 2', $second->evaluate('string(//title)'));
    }

    public function test_non_production_environments_are_not_indexable(): void
    {
        $page = $this->page($this->get('/ar'));

        $this->assertSame('noindex, follow', $page->evaluate('string(//meta[@name="robots"]/@content)'));
        $this->get('/robots.txt')->assertOk()->assertSeeText("User-agent: *\nDisallow: /", false);
    }

    public function test_production_robots_txt_allows_crawling_and_lists_the_sitemap(): void
    {
        $this->app['env'] = 'production';

        $body = $this->get('/robots.txt')
            ->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->getContent();

        $this->assertSame("User-agent: *\nAllow: /\n\nSitemap: http://localhost/sitemap.xml\n", $body);
    }

    public function test_private_screens_send_a_noindex_header(): void
    {
        $this->get('/backend/login')->assertOk()->assertHeader('X-Robots-Tag', 'noindex, nofollow');
        $this->actingAs(User::query()->first())
            ->get('/backend')
            ->assertOk()
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow');
    }

    public function test_review_page_is_only_indexable_when_it_shows_published_reviews(): void
    {
        $this->app['env'] = 'production';
        PatientReview::query()->where('source', 'website')->delete();

        $this->assertSame('noindex, follow', $this->page($this->get('/ar/review'))->evaluate('string(//meta[@name="robots"]/@content)'));
        $this->assertStringNotContainsString('/ar/review', $this->get('/sitemap.xml')->getContent());

        PatientReview::query()->create(['name' => 'Patient', 'rating' => 5, 'body' => 'Clear explanation.', 'locale' => 'ar', 'source' => 'website', 'is_published' => true]);

        $this->assertStringStartsWith('index, follow', $this->page($this->get('/ar/review'))->evaluate('string(//meta[@name="robots"]/@content)'));
        $this->assertStringContainsString('<loc>http://localhost/ar/review</loc>', $this->get('/sitemap.xml')->getContent());
    }

    public function test_structured_data_is_a_single_valid_graph_without_review_markup(): void
    {
        $article = Article::query()->where('is_active', true)->value('slug');

        foreach (['/ar', '/en/about', '/ar/articles/'.$article] as $path) {
            $page = $this->page($this->get($path));
            $blocks = $page->query('//script[@type="application/ld+json"]');

            $this->assertSame(1, $blocks->length, $path);

            $json = $blocks->item(0)->textContent;
            $schema = json_decode($json, true, flags: JSON_THROW_ON_ERROR);
            $types = array_column($schema['@graph'], '@type');
            $ids = array_column($schema['@graph'], '@id');

            $this->assertSame('https://schema.org', $schema['@context']);
            $this->assertContains('WebSite', $types);
            $this->assertContains('Physician', $types);
            $this->assertSame(array_unique($ids), $ids, $path);
            $this->assertStringNotContainsString('aggregateRating', $json);
            $this->assertStringNotContainsString('"Review"', $json);
            $this->assertStringNotContainsString('0.0.0.0', $json);
        }

        $about = $this->schema('/en/about');
        $this->assertSame('AboutPage', $this->node($about, 'AboutPage')['@type']);
        $this->assertSame('http://localhost/en/about', $this->node($about, 'BreadcrumbList')['itemListElement'][1]['item']);

        $articleSchema = $this->schema('/ar/articles/'.$article);
        $articleNode = $this->node($articleSchema, 'Article');
        $this->assertSame('http://localhost/#doctor', $articleNode['author']['@id']);
        $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2}$/', $articleNode['datePublished']);
        $this->assertStringNotContainsString('.svg', json_encode($articleNode['image'] ?? []));
    }

    public function test_structured_data_escapes_script_breaking_content(): void
    {
        Article::query()->where('is_active', true)->first()->update([
            'title' => ['ar' => 'عنوان </script><script>alert(1)</script>', 'en' => 'Title'],
        ]);
        $slug = Article::query()->where('is_active', true)->value('slug');

        $html = $this->get('/ar/articles/'.$slug)->assertOk()->getContent();

        $this->assertStringNotContainsString('<script>alert(1)</script>', $html);
    }

    public function test_sitemap_lists_only_absolute_reachable_canonical_urls(): void
    {
        $response = $this->get('/sitemap.xml')->assertOk()->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $document = new DOMDocument;
        $this->assertTrue($document->loadXML($response->getContent()));

        $xpath = new DOMXPath($document);
        $xpath->registerNamespace('s', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $locations = array_map(fn ($node) => $node->textContent, iterator_to_array($xpath->query('//s:url/s:loc')));

        $this->assertNotEmpty($locations);
        $this->assertSame(array_unique($locations), $locations);

        foreach ($locations as $location) {
            $this->assertStringStartsWith('http://localhost/', $location);
            $this->assertStringNotContainsString('/backend', $location);
            $this->get(substr($location, strlen('http://localhost')))->assertOk();
        }
    }

    public function test_social_links_skip_private_development_urls(): void
    {
        SocialProfile::query()->first()->update(['youtube' => 'http://0.0.0.0:8080/ar/contact', 'tiktok' => 'http://localhost/x']);

        $this->get('/ar')->assertOk()->assertDontSee('0.0.0.0', false)->assertDontSee('http://localhost/x', false);
    }

    public function test_canonical_root_requires_a_public_https_production_url(): void
    {
        config(['app.url' => 'https://drtahafayed.com']);
        $this->assertNull(SiteUrl::canonicalRoot());

        $this->app['env'] = 'production';
        $this->assertSame('https://drtahafayed.com', SiteUrl::canonicalRoot());

        config(['app.url' => 'http://0.0.0.0:8080']);
        $this->assertNull(SiteUrl::canonicalRoot());
    }

    /**
     * @return list<string>
     */
    private function localizedPages(string $locale): array
    {
        $pages = array_map(fn (string $path) => '/'.$locale.$path, self::STATIC_PAGES);

        foreach (Service::query()->where('is_active', true)->pluck('slug') as $slug) {
            $pages[] = '/'.$locale.'/services/'.$slug;
        }

        foreach (Article::query()->where('is_active', true)->pluck('slug') as $slug) {
            $pages[] = '/'.$locale.'/articles/'.$slug;
        }

        return $pages;
    }

    private function page(TestResponse $response): DOMXPath
    {
        $document = new DOMDocument;
        libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="UTF-8">'.$response->getContent());
        libxml_clear_errors();

        return new DOMXPath($document);
    }

    /**
     * @return array<string, mixed>
     */
    private function schema(string $path): array
    {
        $json = $this->page($this->get($path))->evaluate('string(//script[@type="application/ld+json"])');

        return json_decode($json, true, flags: JSON_THROW_ON_ERROR);
    }

    /**
     * @param  array<string, mixed>  $schema
     * @return array<string, mixed>
     */
    private function node(array $schema, string $type): array
    {
        return collect($schema['@graph'])->firstWhere('@type', $type) ?? [];
    }
}
