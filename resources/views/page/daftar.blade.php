@extends('lay.lay')

@section('title', 'Silahkan Mendaftar Dahulu')

@section('classBody', 'bg-gradient-success')

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
                                    <h1 class="h4 text-gray-900 mb-4">Mendaftar Sebagai Anggota</h1>
                                </div>
                                <form class="user">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                            id="nama"
                                            placeholder="Masukkan nama">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                            id="email"
                                            placeholder="Masukkan email">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <input type="password" class="form-control form-control-user"
                                                id="pass" placeholder="Masukkan password">

                                            </div>
                                            <div class="col-6">
                                            <input type="password" class="form-control form-control-user"
                                                id="rePass" placeholder="Masukkan ulang password">

                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            id="org"
                                            placeholder="Masukkan nama organisasi">
                                    </div>
                                    <a href="#" id="daftar" class="btn btn-primary btn-user btn-block">
                                        DAFTAR
                                    </a>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{route('masuk')}}">Sudah punya akun, Silahkan masuk saja</a>
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
