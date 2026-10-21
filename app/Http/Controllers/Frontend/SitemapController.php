<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Clinic;
use App\Models\ClinicContact;
use App\Models\Doctor;
use App\Models\Faq;
use App\Models\PatientReview;
use App\Models\Photo;
use App\Models\SeoPage;
use App\Models\Service;
use App\Models\Video;
use DOMDocument;
use DOMElement;
use Illuminate\Database\Eloquent\Model;
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

        foreach ($this->staticPages() as $name) {
            $this->appendLocalized($document, $urlset, $name, [], $this->pageLastmod($name));
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
     * @return list<string>
     */
    private function staticPages(): array
    {
        return [
            'site.home',
            'site.about',
            'site.services',
            'site.clinics',
            'site.articles',
            'site.photos',
            'site.videos',
            'site.contact',
            'site.review',
        ];
    }

    /**
     * @param  array<string, string>  $parameters
     */
    private function appendLocalized(DOMDocument $document, DOMElement $urlset, string $name, array $parameters, ?Carbon $lastmod): void
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

    private function pageLastmod(string $name): ?Carbon
    {
        $stamps = match ($name) {
            'site.home' => [
                Doctor::query()->max('updated_at'),
                $this->activeStamp(Service::class),
                $this->activeStamp(Article::class),
                $this->activeStamp(Photo::class),
                $this->activeStamp(Faq::class),
                $this->activeStamp(Clinic::class),
                PatientReview::query()->where('is_published', true)->max('updated_at'),
                $this->seoStamp('home'),
            ],
            'site.about' => [
                Doctor::query()->max('updated_at'),
                $this->seoStamp('about'),
            ],
            'site.services' => [
                $this->activeStamp(Service::class),
                $this->seoStamp('services'),
            ],
            'site.clinics' => [
                $this->activeStamp(Clinic::class),
                $this->seoStamp('clinics'),
            ],
            'site.articles' => [
                $this->activeStamp(Article::class),
                $this->seoStamp('articles'),
            ],
            'site.photos' => [
                $this->activeStamp(Photo::class),
                $this->seoStamp('photos'),
            ],
            'site.videos' => [
                $this->activeStamp(Video::class),
                $this->seoStamp('videos'),
            ],
            'site.contact' => [
                ClinicContact::query()->max('updated_at'),
                $this->activeStamp(Clinic::class),
                $this->seoStamp('contact'),
            ],
            'site.review' => [
                $this->seoStamp('review'),
            ],
            default => [],
        };

        $latest = collect($stamps)->filter()->max();

        return $latest ? Carbon::parse($latest) : null;
    }

    /**
     * @param  class-string<Model>  $model
     */
    private function activeStamp(string $model): ?string
    {
        return $model::query()->where('is_active', true)->max('updated_at');
    }

    private function seoStamp(string $page): ?string
    {
        return SeoPage::query()->where('page', $page)->max('updated_at');
    }
}
