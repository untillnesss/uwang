@extends('lay.lay')

@section('title', 'Silahkan Masuk')

@section('classBody', 'bg-gradient-primary')

@section('body')

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-8 col-lg-8 col-md-8">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                            id="email"
                                            placeholder="Masukkan email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="pass" placeholder="Masukkan password">
                                    </div>
                                    <a href="#" id="masuk" class="btn btn-primary btn-user btn-block">
                                        MASUK
                                    </a>
                                </form>
                                <hr>
                                <div class="text-center">
                                <a class="small" href="{{route('daftar')}}">Buat akun</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection
