@extends('temp.temp')

@section('title','SELAMAT DATANG PAK !')
@section('classBody','hold-transition skin-blue sidebar-mini fixed')

@section('body')

<div class="content-wrapper">
    <section class="content-header" style="display: flex; justify-content: space-between">
        <h1>Laporan</h1>
        <button class="btn btn-success btn-icon-split" data-toggle="control-sidebar">
            <span class="icon text-white-50">
                <i class="fa fa-plus"></i>
            </span>

            <span class="text">Tambah Laporan</span>
        </button>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        <h4 class="box-title">Daftar Laporan yang Tersedia</h4>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection
