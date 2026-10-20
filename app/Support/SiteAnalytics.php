<?php

namespace App\Support;

use App\Models\Article;
use App\Models\Clinic;
use App\Models\Contact;
use App\Models\PageView;
use App\Models\PatientReview;
use App\Models\Service;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class SiteAnalytics
{
    private const DAYS = 14;

    /**
     * @return array<string, mixed>
     */
    public function dashboard(): array
    {
        $today = $this->visitsOn(today());
        $yesterday = $this->visitsOn(today()->subDay());
        $month = $this->visitsSince(now()->startOfMonth());
        $average = (int) round((float) PageView::query()->where('duration_seconds', '>', 0)->avg('duration_seconds'));
        $pages = $this->pages();

        return [
            'today' => $today,
            'yesterday' => $yesterday,
            'month' => $month,
            'average' => $this->duration($average),
            'unreadMessages' => Contact::query()->whereNull('read_at')->count(),
            'pendingReviews' => PatientReview::query()->where('is_published', false)->count(),
            'services' => Service::query()->where('is_active', true)->count(),
            'articles' => Article::query()->where('is_active', true)->count(),
            'clinics' => Clinic::query()->where('is_active', true)->count(),
            'pages' => $pages,
            'messages' => Contact::query()->latest()->limit(5)->get(),
            'reviews' => PatientReview::query()->latest()->limit(5)->get(),
            'charts' => [
                'days' => $this->days()->map(fn (Carbon $day) => $day->format('d M'))->values(),
                'views' => $this->viewsByDay(),
                'pageLabels' => $pages->pluck('label')->values(),
                'pageViews' => $pages->pluck('views')->values(),
                'locales' => [
                    $this->visitorsForLocale('ar'),
                    $this->visitorsForLocale('en'),
                ],
            ],
        ];
    }

    public function duration(int $seconds): string
    {
        if ($seconds <= 0) {
            return '—';
        }

        $minutes = intdiv($seconds, 60);
        $rest = $seconds % 60;

        return $minutes > 0 ? $minutes.'m '.$rest.'s' : $rest.'s';
    }

    /**
     * @return Collection<int, array{label: string, views: int, average: string, total: string}>
     */
    private function pages(): Collection
    {
        return PageView::query()
            ->select('page')
            ->selectRaw('COUNT(DISTINCT '.$this->visitorKey().') as views')
            ->selectRaw('ROUND(AVG(NULLIF(duration_seconds, 0))) as avg_duration')
            ->selectRaw('SUM(duration_seconds) as total_duration')
            ->groupBy('page')
            ->orderByDesc('views')
            ->limit(8)
            ->get()
            ->map(fn (PageView $view) => [
                'label' => $view->label(),
                'views' => (int) $view->views,
                'average' => $this->duration((int) $view->avg_duration),
                'total' => $this->duration((int) $view->total_duration),
            ]);
    }

    /**
     * @return Collection<int, int>
     */
    private function viewsByDay(): Collection
    {
        $counts = PageView::query()
            ->where('created_at', '>=', now()->subDays(self::DAYS - 1)->startOfDay())
            ->selectRaw('DATE(created_at) as day, COUNT(DISTINCT '.$this->visitorKey().') as views')
            ->groupByRaw('DATE(created_at)')
            ->pluck('views', 'day');

        return $this->days()->map(fn (Carbon $day) => (int) ($counts[$day->toDateString()] ?? 0));
    }

    private function visitsOn(Carbon $day): int
    {
        return (int) PageView::query()
            ->whereDate('created_at', $day)
            ->selectRaw('COUNT(DISTINCT '.$this->visitorKey().') as visits')
            ->value('visits');
    }

    private function visitsSince(Carbon $from): int
    {
        return (int) PageView::query()
            ->where('created_at', '>=', $from)
            ->selectRaw('COUNT(DISTINCT CONCAT('.$this->visitorKey().', DATE(created_at))) as visits')
            ->value('visits');
    }

    private function visitorsForLocale(string $locale): int
    {
        return (int) PageView::query()
            ->where('locale', $locale)
            ->selectRaw('COUNT(DISTINCT '.$this->visitorKey().') as visits')
            ->value('visits');
    }

    private function visitorKey(): string
    {
        return 'COALESCE(visitor_id, session_id)';
    }

    /**
     * @return Collection<int, Carbon>
     */
    private function days(): Collection
    {
        return collect(range(self::DAYS - 1, 0))
            ->map(fn (int $ago) => today()->subDays($ago));
    }
}
