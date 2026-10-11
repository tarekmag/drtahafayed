<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('backend.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('backendtheme/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('backendtheme/assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('backend.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('backendtheme/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('backendtheme/assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('backend.dashboard') }}">
                        <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-file-text-line"></i> <span data-key="t-content">Content</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('backend.bio.edit') }}">
                        <i class="mdi mdi-book-open"></i> <span data-key="t-dr-bio">DR. Bio</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="mdi mdi-briefcase-outline"></i> <span data-key="t-services">Services</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('backend.articles.index') }}">
                        <i class="mdi mdi-newspaper"></i> <span data-key="t-articles">Articles</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('backend.photos.index') }}">
                        <i class="mdi mdi-image"></i> <span data-key="t-photos">Photos</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('backend.videos.index') }}">
                        <i class="mdi mdi-video"></i> <span data-key="t-videos">Videos</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-contacts-book-line"></i> <span data-key="t-contacts">Contacts</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="mdi mdi-star"></i> <span data-key="t-reviews">Reviews</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('backend.messages.index') }}">
                        <i class="mdi mdi-message"></i> <span data-key="t-messages">Messages</span>
                        @php $unreadMessages = \App\Models\Contact::query()->whereNull('read_at')->count(); @endphp
                        @if ($unreadMessages > 0)
                            <span class="badge badge-pill bg-success">{{ $unreadMessages }}</span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('backend.clinics.index') }}">
                        <i class="mdi mdi-hospital-building"></i> <span data-key="t-clinics">Clinics</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('backend.contacts.edit') }}">
                        <i class="mdi mdi-phone"></i> <span data-key="t-contacts-data">Contacts Data</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('backend.social.edit') }}">
                        <i class="mdi mdi-link"></i> <span data-key="t-social-media-data">Social Media Data</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-settings-2-line"></i> <span data-key="t-settings">Settings</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('backend.seo.edit') }}">
                        <i class="mdi mdi-file-chart"></i> <span data-key="t-seo">SEO</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="mdi mdi-account-group"></i> <span data-key="t-users">Users</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
