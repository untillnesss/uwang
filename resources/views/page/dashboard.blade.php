@extends('lay.lay')

@section('title', 'DASHBOARD')

@section('body')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex d-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-6 col-md-12 mb-2">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Saldo</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <span id="textSaldo"><i
                                        class="fas fa-sync fa-spin fa-sm"></i></span>,-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-2">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Laporan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span>{{$jumlahLaporan}}</span> Biji
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-2">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Anggota (aktif)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span>{{$jumlahOrang}}</span> Orang
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
    </div>

    <div class="row mb-3">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Garafik Perubahan Saldo</h6>
                </div>
                <div class="card-body">
                    <canvas id="myChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Garafik Perubahan Pemasukan dan Pengeluaran</h6>
                </div>
                <div class="card-body">
                    <canvas id="myChart2" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <!-- Scroll to Top Button-->


    @endsection

    @section('anggota')
    <style>
        .bulat {
            border-radius: 50%;
            height: 100px;
            width: 100px;
            color: whitesmoke;
        }

    </style>
    <div class="container mt-4">
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                <h3 class="text-center">{{strtoupper(Session::get('userLogin')->org)}}</h3>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <h4 style="font-weight: bold">LAPORAN KEUANGAN</h4>
            </div>
        </div>

        <div class="row mt-4" id="loading">
            <div class="col-12">
                <div class="card py-3 d-flex justify-content-center align-items-center">
                    <div class="spinner-grow text-primary" role="status"></div>
                </div>
            </div>
        </div>

        <div class="row mt-4" style="display:none" id="tableLaporan">
            <div class="col-12 mb-2">
                <table>
                    <tr>
                        <td class="pr-3">Tanggal Laporan</td>
                        <td style="text-align: right" class="pr-1">:</td>
                        <td id="tanggalLaporan">Tanggal</td>
                    </tr>
                </table>
            </div>
            <div class="col-12 table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 50%">Keterangan</th>
                            <th style="width: 5%" class="text-center">Banyak</th>
                            <th style="width: 10%">Harga</th>
                            <th style="width: 20%">Debit (+)</th>
                            <th style="width: 20%">Kredit (-)</th>
                        </tr>
                    </thead>
                    <tbody id="isiPoinLaporan"></tbody>
                    <thead>
                        <tr>
                            <th colspan="4">Jumlah</th>
                            <th id="debit">JUMALH</th>
                            <th id="kredit">JUMALH</th>
                        </tr>
                        <tr>
                            <th colspan="4">Total</th>
                            <th colspan="2" class="total">INI</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="col-12 table-responsive">
                <table class="table table-hover table-bordered">
                    <tbody>
                        <tr>
                            <td>Sisa saldo laporan sebelumnya (<span id="tanggalSebelum"></span>)</td>
                            <td id="saldoSebelum"></td>
                        </tr>
                        <tr>
                            <td>Perubahan saldo saat ini</td>
                            <td class="total">ini</td>
                        </tr>
                        <tr>
                            <td>Saldo saat ini</td>
                            <td id="saldoSaatIni">ini</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-4" id="fieldCardLaporan" style="display:none;"></div>

        <hr>
        <div class="row my-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn " data-toggle="collapse" href="#collapseGrafik" role="button" aria-expanded="false" aria-controls="collapseGrafik">Grafik Ringkasan</a>
                    </div>
                    <div class="collapse" id="collapseGrafik">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-primary">Garafik Perubahan Saldo</h6>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="myChart" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-primary">Garafik Perubahan Pemasukan dan Pengeluaran</h6>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="myChart2" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-light bg-dark fixed-top" id="myNav" style="display: none">

    </nav>
</div>

@section('js')

<script src="{{asset('js/anggotaLook.js')}}"></script>
@endsection
@endsection
