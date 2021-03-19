<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sprica</title>

    <!-- META SECTION -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/sweetalert2.min.css')}}">
    
    @yield('page_css')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style>
        .navbar-nav .user-menu {
            margin-right: 10px;
        }
        .navbar-nav li>a.ddt-large {
            padding: 15px 12px 11px 10px;
            font-size: 10px;
        }
        .navbar-nav img.img-circle {
            max-height: 26px;
            margin-top: -2px;
        }
        .img-circle {
            border-radius: 50%;
        }
    </style>
    @yield('stylesheets')
</head>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">   
        @include('partials.navbar')
        @include('partials.menu')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        
        @include('partials.footer')
    </div>
    <!-- ./wrapper -->

    @yield('modals')

    <div class="modal fade" id="open-news-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="heading"></h4>
                    <p class="details"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- APP WRAPPER -->
    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    @yield('page_js')
    
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".nav-link.ana").click(function(){
                $(this).parent("has-treeview").addClass("menu-open");
            })
        });
        
        var pathname = window.location.pathname;
        var result = pathname.split('/');
        var lastEl = result[result.length-1];

        var url ="";
        var urlend ="";
        $( ".nav-sidebar .nav-link").each(function( index ) {
            url = $(this).attr("href").split('/');
            urlend = url[url.length-1];
            if(lastEl==urlend)
            {
                $(this).parents(".has-treeview").addClass("menu-open");
                $(this).parent(".nav-treeview").css("display","block");
                $(".nav-sidebar .nav-link").removeClass("active");
                $(this).addClass("active");
            }
        });

        $(document).ready(function()
        {
            bsCustomFileInput.init();
        });

    </script>

    @yield('scripts')
</body>
</html>



