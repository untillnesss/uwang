@extends('temp.temp')

@section('title', 'DAFTAR')

@section('body')

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Laporan</b>UWANG</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Untuk mendaftar, Silahkan isi form dibawah</p>

            {{-- <form action="../../index2.html" method="post"> --}}
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Nama" id="nama">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" id="email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" id="pass">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Ketik ulang password" id="rePass">
                <span class="glyphicon glyphicon-refresh form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Nama Organisasi" id="org">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="button" id="daftar" class="btn btn-primary btn-block">MENDAFTAR</button>
                </div>
                <!-- /.col -->
            </div>
            {{-- </form> --}}

            <div class="row d-flex justify-content-center">
                <div class="col-xs-12">
                    <center>
                        <a href="{{route('masuk')}}" class="text-center">Sudah punya akun ? Silahkan masuk di sini</a>
                    </center>
                </div>
            </div>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

<script src="{{asset('js/page/'.Route::currentRouteName().'.js')}}"></script>
</body>

@endsection

@section('head')
    <script src="../../plugins/iCheck/icheck.min.js"></script>

@endsection
