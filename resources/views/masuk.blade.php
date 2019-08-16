@extends('temp.temp')

@section('title', 'MASUK')


@section('body')

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Laporan</b>UWANG</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Silahkan masuk terlebih dahulu !</p>

                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" id="email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" id="pass">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="button" class="btn btn-primary btn-block btn-flat" id="masuk">MASUK</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="row d-flex justify-content-center">
                <div class="col-xs-12">
                    <center>
                        <a href="{{route('daftar')}}" class="text-center">Belum punya akun .? Silahkan daftar di
                            sini</a>
                    </center>
                </div>
            </div>
        </div>
        <!-- /.login-box-body -->
    </div>

    <script src="../../plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });

    </script>

<script src="{{asset('js/page/'.Route::currentRouteName().'.js')}}"></script>

</body>

@endsection
