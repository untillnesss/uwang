@extends('lay.lay')

@section('title', 'DASHBOARD')

@section('body')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan</h1>

        <div>
            <button class="btn btn-primary btn-sm btn-icon-split" data-toggle="modal" data-target="#tambahLaporanModal">
                <span class="icon">
                    <i class="fas fa-plus"></i>
                </span>

                <span class="text">Tambah Laporan</span>
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar laporan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-stripped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Hari, tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- MODAL MODAL-->
<div class="modal fade" id="tambahLaporanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form tambah laporan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="">Masukkan tanggal</label>
                            <input type="date" class="form-control" id="tanggal" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    {{-- <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker3'>
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div id="fieldPenanggalan"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btnTambahLaporan">Tambah</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editLaporanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form edit laporan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="">Masukkan tanggal</label>
                            <input type="hidden" name="" id="idTanggalEdit">
                            <input type="date" class="form-control" id="tanggalEdit" value="">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div id="fieldPenanggalanEdit"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btnSimpanLaporan">Simpan</button>
            </div>
        </div>
    </div>
</div>

@endsection
