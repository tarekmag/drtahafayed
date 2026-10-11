<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed" data-layout-style="default" data-sidebar-visibility="show">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon-32.png') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('backendtheme/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('backendtheme/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backendtheme/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backendtheme/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('backendtheme/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    @livewireStyles
</head>

<body>
    {{ $slot ?? '' }}
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.backend.header')

        <!-- ========== App Menu ========== -->
        @include('layouts.backend.menu')

        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('content')
            <!-- End Page-content -->

            @include('layouts.backend.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('backendtheme/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backendtheme/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backendtheme/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('backendtheme/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backendtheme/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('backendtheme/assets/js/plugins.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('backendtheme/assets/js/app.js') }}"></script>

    @stack('scripts')
    @livewireScripts
</body>

</html>
