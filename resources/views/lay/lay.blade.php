<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/nprogress.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datetime.css')}}">


    @yield('css')
    <style>
        .bg-tr-keluar {
            background-color: rgba(231, 74, 59, 0.15);
        }

        .bg-tr-masuk {
            background-color: rgba(28, 200, 138, 0.15);
        }

    </style>

</head>

<body id="page-top" class="@yield('classBody')">
    @if (Route::currentRouteName() == 'masuk' || Route::currentRouteName() == 'daftar' || Route::currentRouteName() == 'klaim')
    <div id="particles-js" style="
        position: fixed;
        height: 100%;
        width: 100%;
    "></div>
    @yield('body')
    @else
    <div id="wrapper">
        @include('lay.sidebar')
        <div id="content-wrapper">
            @include('lay.navbar')
            <div id="content">
                @yield('body')
            </div>
        </div>
    </div>



    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route('keluar')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top" id="scrollTopBtn">
        <i class="fas fa-angle-up"></i>
    </a>
    @endif


    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    {{-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> --}}

    {{-- <script src="{{asset('js/jquery.js')}}"></script> --}}
    <script src="{{asset('js/sw.js')}}"></script>
    <script src="{{asset('js/f.js')}}"></script>
    <script src="{{asset('js/nprogress.js')}}"></script>
    <script src="{{asset('js/moment.js')}}"></script>
    <script src="{{asset('js/datetime.js')}}"></script>
    <script src="{{asset('js/datatables.min.js')}}"></script>

    @if (Route::currentRouteName() == 'daftar' || Route::currentRouteName()== 'masuk')
    <script src="{{asset('js/particles.min.js')}}"></script>
    <script>
        particlesJS.load('particles-js', '{{asset("js/particlesjs-config.json")}}', function () {
            console.log('callback - particles.js config loaded');
        });

    </script>
    @endif

    @if (Route::currentRouteName() == 'klaim')
    <script src="{{asset('js/page/masuk.js')}}"></script>

    @else
    <script src="{{asset('js/page/'.Route::currentRouteName().'.js')}}"></script>

    @endif


    @yield('js')


</body>

</html>
