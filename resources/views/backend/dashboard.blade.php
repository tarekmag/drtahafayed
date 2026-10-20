@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Last 14 days</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Visits today</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold">{{ number_format($today) }}</h2>
                                    <p class="mb-0 text-muted">Yesterday {{ number_format($yesterday) }}</p>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary rounded-circle fs-2"><i class="bx bx-show"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Visits this month</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold">{{ number_format($month) }}</h2>
                                    <p class="mb-0 text-muted">{{ $services }} services · {{ $articles }} articles · {{ $clinics }} clinics</p>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info rounded-circle fs-2"><i class="bx bx-bar-chart-alt-2"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Avg. time on page</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold">{{ $average }}</h2>
                                    <p class="mb-0 text-muted">Visits that stayed on the page</p>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning rounded-circle fs-2"><i class="bx bx-time-five"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Needs attention</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold">{{ number_format($unreadMessages + $pendingReviews) }}</h2>
                                    <p class="mb-0">
                                        <a href="{{ route('backend.messages.index') }}">{{ $unreadMessages }} messages</a>
                                        ·
                                        <a href="{{ route('backend.reviews.index') }}">{{ $pendingReviews }} reviews</a>
                                    </p>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-danger rounded-circle fs-2"><i class="bx bx-bell"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Daily visits</h4>
                        </div>
                        <div class="card-body">
                            <div id="views-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Language</h4>
                        </div>
                        <div class="card-body">
                            <div id="locale-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Top pages</h4>
                        </div>
                        <div class="card-body">
                            @if ($pages->isEmpty())
                                <p class="text-muted mb-0">Views will appear here after the first visit.</p>
                            @else
                                <div id="pages-chart" class="apex-charts" dir="ltr"></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Time on each page</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Page</th>
                                            <th>Views</th>
                                            <th>Avg. time</th>
                                            <th>Total time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pages as $page)
                                            <tr>
                                                <td>{{ $page['label'] }}</td>
                                                <td>{{ number_format($page['views']) }}</td>
                                                <td>{{ $page['average'] }}</td>
                                                <td>{{ $page['total'] }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No page views yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4 class="card-title mb-0 flex-grow-1">Latest messages</h4>
                            <a href="{{ route('backend.messages.index') }}" class="btn btn-sm btn-soft-primary">View all</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Message</th>
                                            <th>Received</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($messages as $message)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('backend.messages.show', $message) }}">{{ $message->name }}</a>
                                                    @if ($message->read_at === null)
                                                        <span class="badge bg-success">New</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Illuminate\Support\Str::limit($message->message, 60) }}</td>
                                                <td>{{ $message->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No messages yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4 class="card-title mb-0 flex-grow-1">Latest reviews</h4>
                            <a href="{{ route('backend.reviews.index') }}" class="btn btn-sm btn-soft-primary">View all</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Review</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($reviews as $review)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('backend.reviews.show', $review) }}">{{ $review->name }}</a>
                                                    <div class="text-muted">{{ $review->rating }}/5</div>
                                                </td>
                                                <td>{{ \Illuminate\Support\Str::limit($review->body, 60) }}</td>
                                                <td>
                                                    @if ($review->is_published)
                                                        <span class="badge bg-success">Published</span>
                                                    @else
                                                        <span class="badge bg-warning">Pending</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No reviews yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backendtheme/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        const charts = @json($charts);
        const dark = document.documentElement.getAttribute('data-layout-mode') === 'dark';
        const fore = dark ? '#ced4da' : '#878a99';
        const grid = dark ? '#32383e' : '#f3f6f9';

        const base = {
            chart: { toolbar: { show: false }, fontFamily: 'inherit', background: 'transparent' },
            theme: { mode: dark ? 'dark' : 'light' },
            grid: { borderColor: grid },
            dataLabels: { enabled: false },
        };

        new ApexCharts(document.querySelector('#views-chart'), {
            ...base,
            chart: { ...base.chart, type: 'area', height: 320 },
            series: [{ name: 'Views', data: charts.views }],
            colors: ['#405189'],
            stroke: { curve: 'smooth', width: 2 },
            fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.45, opacityTo: 0.05, stops: [0, 100] } },
            xaxis: { categories: charts.days, labels: { style: { colors: fore } } },
            yaxis: { labels: { style: { colors: fore } }, forceNiceScale: true },
        }).render();

        new ApexCharts(document.querySelector('#locale-chart'), {
            ...base,
            chart: { ...base.chart, type: 'donut', height: 320 },
            series: charts.locales,
            labels: ['Arabic', 'English'],
            colors: ['#405189', '#0ab39c'],
            legend: { position: 'bottom', labels: { colors: fore } },
            plotOptions: { pie: { donut: { size: '68%' } } },
        }).render();

        const pagesChart = document.querySelector('#pages-chart');

        if (pagesChart && charts.pageLabels.length) {
            new ApexCharts(pagesChart, {
                ...base,
                chart: { ...base.chart, type: 'bar', height: Math.max(260, charts.pageLabels.length * 42) },
                series: [{ name: 'Views', data: charts.pageViews }],
                colors: ['#0ab39c'],
                plotOptions: { bar: { horizontal: true, borderRadius: 4, barHeight: '60%' } },
                xaxis: { categories: charts.pageLabels, labels: { style: { colors: fore } } },
                yaxis: { labels: { style: { colors: fore } } },
            }).render();
        }
    </script>
@endpush
