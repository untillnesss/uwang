@extends('temp.temp')

@section('title','SELAMAT DATANG PAK !')
@section('classBody','hold-transition skin-blue sidebar-mini fixed')

@section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            {{-- <small>Version 2.0</small> --}}
        </h1>
        {{-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol> --}}
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">JUMLAH SALDO</span>
                        <span class="info-box-number" style="display: flex; justify-content: space-between">
                            <span>
                                Rp. <span id="textSaldo"><i class="fa fa-spin fa-refresh"></i></span><small>,-</small>
                            </span>

                            <span class="description-percentage text-green">
                                <i class="ml-4 fa fa-caret-up"></i>
                                0%
                            </span>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-pencil-square"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">JUMLAH LAPORAN</span>
                        <span class="info-box-number">41,410</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">New Members</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">-- DAFTAR LAPORAN TERBARU --</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <div class="panel box box-danger">
                                <div class="box-header with-border boxHeaderAccordion" data-id="1" data-type="accordionLaporan">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#acc1"
                                            class="collapsed" aria-expanded="false" id="1">
                                            Laporan Jum'at, 02 Januari 2019
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc1" class="panel-collapse collapse" aria-expanded="false"
                                    style="height: 0px;">
                                    <div class="box-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3
                                        wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                        nesciunt laborum
                                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                        single-origin coffee nulla
                                        assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
                                        anderson cred
                                        nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                        occaecat craft beer
                                        farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of
                                        them accusamus
                                        labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-success">
                                <div class="box-header with-border boxHeaderAccordion">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                                            class="collapsed" aria-expanded="false">
                                            Collapsible Group Success
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false"
                                    style="height: 0px;">
                                    <div class="box-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3
                                        wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                        nesciunt laborum
                                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                        single-origin coffee nulla
                                        assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
                                        anderson cred
                                        nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                        occaecat craft beer
                                        farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of
                                        them accusamus
                                        labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection
