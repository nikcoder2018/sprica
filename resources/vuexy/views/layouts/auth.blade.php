<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Sprica | Login</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" href="{{asset(env('APP_THEME','default').'/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(env('APP_THEME','default').'/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->
    @yield('vendors_css')
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/pages/page-auth.css')}}">
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu dark-layout blank-page navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="blank-page" data-layout="dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset(env('APP_THEME','default').'/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

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