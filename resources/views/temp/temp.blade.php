<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- CSS --}}
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    <link rel="stylesheet" href="{{asset('css/nprogress.css')}}">

    <style>
        .swal2-popup {
            font-size: 1.6rem !important;
        }

        .mr-1{
            margin-right: 2.5px;
        }
        .mr-2{
            margin-right: 5.0px;
        }
        .mr-3{
            margin-right: 7.5px;
        }
        .mr-4{
            margin-right: 10.0px;
        }

        .ml-1{
            margin-right: 2.5px;
        }
        .ml-2{
            margin-right: 5.0px;
        }
        .ml-3{
            margin-right: 7.5px;
        }
        .ml-4{
            margin-right: 10.0px;
        }


    </style>

    {{-- JAVA SCRIPTT --}}
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/sw.js')}}"></script>
    <script src="{{asset('js/f.js')}}"></script>
    <script src="{{asset('js/nprogress.js')}}"></script>
    {{-- <script src="bower_components/jquery/dist/jquery.min.js"></script> --}}
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="bower_components/chart.js/Chart.js"></script>
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    {{-- <script src="dist/js/pages/dashboard2.js"></script> --}}
    <script src="dist/js/demo.js"></script>

    @yield('head')



</head>

@if (Route::currentRouteName() == 'masuk' || Route::currentRouteName() == 'daftar')

@yield('body')

@else

<body class="@yield('classBody')">

    <div class="wrapper">
        @include('temp.navbar')
        @include('temp.aside')
        @yield('body')
        @include('temp.foo')
        @include('temp.conaside')
    </div>


    <script src="{{asset('js/page/'.Route::currentRouteName().'.js')}}"></script>
</body>
@endif

</html>
