<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>{{ Language::get('Admin_Title') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/images/ico/favicon.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/extensions/toastr.min.css') }}">
    <!-- END: Vendor CSS-->
    @yield('vendors_css')
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">

    @yield('external_css')

    @yield('stylesheets')

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout  navbar-floating footer-static " data-open="click"
    data-menu="vertical-menu-modern" data-col="" data-layout="dark-layout">
    <div id="main-content-wrapper" class="d-none">
        @include('admin.partials.header')

        @include('admin.partials.menu')

        <div class="app-content content todo-application">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-area-wrapper">
                @yield('content')
            </div>
        </div>

        @include('partials.customizer')

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        @include('admin.partials.footer')

        @yield('modals')
    </div>
    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100vh; width: 100%;"
        id="loading-content">
        <img src="{{ asset(env('APP_THEME', 'default') . '/app-assets/images/logo.jpg') }}" alt=""
            style="max-height: 60px;">
    </div>



    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/js/scripts/customizer.js') }}"></script>
    <!-- END: Theme JS-->

    @yield('external_js')

    @yield('scripts')

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })

    </script>
</body>
<!-- END: Body-->

</html>
