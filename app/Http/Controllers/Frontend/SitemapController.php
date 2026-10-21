<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Faq;
use App\Models\Photo;
use App\Models\Service;
use App\Models\Video;
use DOMDocument;
use DOMElement;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class SitemapController extends Controller
{
    private const SITEMAP_NS = 'http://www.sitemaps.org/schemas/sitemap/0.9';

    private const XHTML_NS = 'http://www.w3.org/1999/xhtml';

    /**
     * @var list<string>
     */
    private const LOCALES = ['ar', 'en'];

    public function __invoke(): Response
    {
        $document = new DOMDocument('1.0', 'UTF-8');
        $document->formatOutput = true;

        $urlset = $document->createElementNS(self::SITEMAP_NS, 'urlset');
        $urlset->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xhtml', self::XHTML_NS);
        $document->appendChild($urlset);
        $document->insertBefore(
            $document->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="/sitemap.xsl"'),
            $urlset,
        );

        $latest = $this->latestChange();

        foreach ($this->staticPages() as $page) {
            $this->appendLocalized($document, $urlset, $page['name'], [], $page['priority'], $latest);
        }

        Service::query()
            ->where('is_active', true)
            ->orderBy('sort')
            ->orderBy('id')
            ->get(['slug', 'updated_at'])
            ->each(function (Service $service) use ($document, $urlset): void {
                $this->appendLocalized(
                    $document,
                    $urlset,
                    'site.service',
                    ['service' => $service->slug],
                    '0.7',
                    $service->updated_at,
                );
            });

        Article::query()
            ->where('is_active', true)
            ->orderByDesc('published_at')
            ->orderBy('sort')
            ->get(['slug', 'updated_at'])
            ->each(function (Article $article) use ($document, $urlset): void {
                $this->appendLocalized(
                    $document,
                    $urlset,
                    'site.article',
                    ['article' => $article->slug],
                    '0.7',
                    $article->updated_at,
                );
            });

        $xml = preg_replace(
            '/<xhtml:link xmlns:xhtml="http:\/\/www\.w3\.org\/1999\/xhtml"/',
            '<xhtml:link',
            $document->saveXML(),
        );

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    public function stylesheet(): Response
    {
        $xsl = (string) file_get_contents(resource_path('xsl/sitemap.xsl'));

        return response($xsl, 200, [
            'Content-Type' => 'text/xsl; charset=UTF-8',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    /**
     * @return list<array{name: string, priority: string}>
     */
    private function staticPages(): array
    {
        return [
            ['name' => 'site.home', 'priority' => '1.0'],
            ['name' => 'site.about', 'priority' => '0.8'],
            ['name' => 'site.services', 'priority' => '0.8'],
            ['name' => 'site.clinics', 'priority' => '0.6'],
            ['name' => 'site.articles', 'priority' => '0.8'],
            ['name' => 'site.photos', 'priority' => '0.5'],
            ['name' => 'site.videos', 'priority' => '0.5'],
            ['name' => 'site.contact', 'priority' => '0.6'],
            ['name' => 'site.review', 'priority' => '0.4'],
        ];
    }

    /**
     * @param  array<string, string>  $parameters
     */
    private function appendLocalized(DOMDocument $document, DOMElement $urlset, string $name, array $parameters, string $priority, ?Carbon $lastmod): void
    {
        $alternates = [];

        foreach (self::LOCALES as $locale) {
            $alternates[$locale] = route($name, ['locale' => $locale, ...$parameters]);
        }

        $alternates['x-default'] = $alternates['ar'];

        foreach (self::LOCALES as $locale) {
            $url = $document->createElementNS(self::SITEMAP_NS, 'url');
            $url->appendChild($this->textElement($document, 'loc', $alternates[$locale]));

            if ($lastmod) {
                $url->appendChild($this->textElement($document, 'lastmod', $lastmod->toDateString()));
            }

            $url->appendChild($this->textElement($document, 'priority', $priority));

            foreach ($alternates as $lang => $href) {
                $link = $document->createElementNS(self::XHTML_NS, 'xhtml:link');
                $link->setAttribute('rel', 'alternate');
                $link->setAttribute('hreflang', $lang);
                $link->setAttribute('href', $href);
                $url->appendChild($link);
            }

            $urlset->appendChild($url);
        }
    }

    private function textElement(DOMDocument $document, string $name, string $value): DOMElement
    {
        $element = $document->createElementNS(self::SITEMAP_NS, $name);
        $element->appendChild($document->createTextNode($value));

        return $element;
    }

    private function latestChange(): ?Carbon
    {
        $latest = collect([
            Doctor::query()->max('updated_at'),
            Service::query()->max('updated_at'),
            Article::query()->max('updated_at'),
            Clinic::query()->max('updated_at'),
            Photo::query()->max('updated_at'),
            Video::query()->max('updated_at'),
            Faq::query()->max('updated_at'),
        ])->filter()->max();

        return $latest ? Carbon::parse($latest) : null;
    }
}
