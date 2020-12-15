<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{App\Helpers\Language::settings('Admin_Title')}}</title>

    <!-- META SECTION -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/sweetalert.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    @yield('external_css')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    @yield('stylesheets')
</head>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">   
        @include('admin.components.navbar')
        @include('admin.components.menu')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        
        @include('admin.components.footer')
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
    <!-- jQuery UI -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert2/zsweet.all.min.js')}}"></script>
    
    @yield('external_js')

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

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        $('.open-news').on('click',async function(){
            let id = $(this).data('id');

            const news = await $.ajax({
                url: "{{route('notices.show')}}",
                type: 'POST',
                data: {
                    _token: "{{csrf_token()}}",
                    id
                }
            });

            let newsModal = $('#open-news-modal').modal('show');
            newsModal.find('.heading').text(news.heading);
            newsModal.find('.details').text(news.details);
        });
    </script>
    
    @yield('scripts')
</body>
</html>



