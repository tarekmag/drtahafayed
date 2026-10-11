<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('backendtheme/assets/images/logo-sm.png') }}" alt=""
                                height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('backendtheme/assets/images/logo-dark.png') }}" alt=""
                                height="17">
                        </span>
                    </a>

                    <a href="{{ route('backend.dashboard') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('backendtheme/assets/images/logo-sm.png') }}" alt=""
                                height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('backendtheme/assets/images/logo-light.png') }}" alt=""
                                height="17">
                        </span>
                    </a>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode shadow-none">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                @php
                    $headerContacts = \App\Models\Contact::query()->whereNull('read_at')->latest()->limit(8)->get();
                    $headerReviews = \App\Models\PatientReview::query()->where('is_published', false)->latest()->limit(8)->get();
                    $headerContactCount = \App\Models\Contact::query()->whereNull('read_at')->count();
                    $headerReviewCount = \App\Models\PatientReview::query()->where('is_published', false)->count();
                    $headerNotificationCount = $headerContactCount + $headerReviewCount;
                    $headerNotifications = $headerContacts
                        ->map(fn ($contact) => [
                            'type' => 'contact',
                            'name' => $contact->name,
                            'text' => $contact->message,
                            'at' => $contact->created_at,
                            'url' => route('backend.messages.show', $contact),
                        ])
                        ->concat($headerReviews->map(fn ($review) => [
                            'type' => 'review',
                            'name' => $review->name,
                            'text' => $review->body,
                            'rating' => $review->rating,
                            'at' => $review->created_at,
                            'url' => route('backend.reviews.show', $review),
                        ]))
                        ->sortByDesc('at')
                        ->take(8)
                        ->values();
                @endphp
                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none"
                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        @if ($headerNotificationCount > 0)
                            <span
                                class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{ $headerNotificationCount }}<span
                                    class="visually-hidden">unread notifications</span></span>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge badge-soft-light fs-13"> {{ $headerNotificationCount }} New</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                    id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab"
                                            role="tab" aria-selected="true">
                                            All ({{ $headerNotificationCount }})
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab"
                                            aria-selected="false">
                                            Contacts ({{ $headerContactCount }})
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab"
                                            aria-selected="false">
                                            Reviews ({{ $headerReviewCount }})
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="tab-content position-relative" id="notificationItemsTabContent">
                            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    @forelse ($headerNotifications as $notification)
                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title {{ $notification['type'] === 'contact' ? 'bg-soft-info text-info' : 'bg-soft-warning text-warning' }} rounded-circle fs-16">
                                                        <i class="{{ $notification['type'] === 'contact' ? 'bx bx-message-square-dots' : 'bx bx-star' }}"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <a href="{{ $notification['url'] }}" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{ $notification['name'] }}</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">
                                                            @if ($notification['type'] === 'review')
                                                                {{ $notification['rating'] }}/5 —
                                                            @endif
                                                            {{ Str::limit($notification['text'], 90) }}
                                                        </p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> {{ $notification['at']->diffForHumans() }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center text-muted py-4">No new contacts or reviews.</div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel"
                                aria-labelledby="messages-tab">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    @forelse ($headerContacts as $contact)
                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                                        <i class="bx bx-message-square-dots"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <a href="{{ route('backend.messages.show', $contact) }}" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{ $contact->name }}</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">{{ Str::limit($contact->message, 90) }}</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> {{ $contact->created_at->diffForHumans() }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center text-muted py-4">No new contacts.</div>
                                    @endforelse

                                    <div class="my-3 text-center view-all">
                                        <a href="{{ route('backend.messages.index') }}"
                                            class="btn btn-soft-success waves-effect waves-light">View
                                            All Contacts <i class="ri-arrow-right-line align-middle"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade py-2 ps-2" id="alerts-tab" role="tabpanel"
                                aria-labelledby="alerts-tab">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    @forelse ($headerReviews as $review)
                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title bg-soft-warning text-warning rounded-circle fs-16">
                                                        <i class="bx bx-star"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <a href="{{ route('backend.reviews.show', $review) }}" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{ $review->name }}</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">{{ $review->rating }}/5 — {{ Str::limit($review->body, 90) }}</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> {{ $review->created_at->diffForHumans() }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center text-muted py-4">No pending reviews.</div>
                                    @endforelse

                                    <div class="my-3 text-center view-all">
                                        <a href="{{ route('backend.reviews.index') }}"
                                            class="btn btn-soft-success waves-effect waves-light">View
                                            All Reviews <i class="ri-arrow-right-line align-middle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn shadow-none" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{ asset('backendtheme/assets/images/users/avatar-1.jpg') }}"
                                alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->name }}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{ Auth::user()->email }}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{ Auth::user()->name }}!</h6>
                        <a class="dropdown-item" href="{{ route('backend.users.edit', Auth::user()->id) }}"><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Profile</span></a>
                        <a class="dropdown-item" href="{{ route('backend.messages.index') }}"><i
                                class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">Messages</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('backend.seo.edit') }}"><i
                                class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">SEO</span></a>
                        <form method="POST" action="{{ route('backend.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle" data-key="t-logout">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
