@extends('lay.lay')

@section('title', 'PEMASUKAN & PENGELUARAN')

@section('body')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pemasukan & Pengeluaran</h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4" id="fieldDetailLaporan" style="display: none">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail laporan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responseive">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Tipe Laporan</th>
                                    <th style="width: 45%">Keterangan laporan</th>
                                    <th style="width: 10%">Banyak</th>
                                    <th style="max-width: 20%">Harga</th>
                                    <th style="text-align: center">Jumlah</th>
                                    {{-- <th style="text-align: center"></th> --}}
                                </tr>
                            </thead>
                            <tbody id="tbodyPoinLaporan">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <select name="" id="" class="form-control select">
                                                <option value="">Pemasukan</option>
                                                <option value="">Pengeluaran</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width: 50%">Total pemasukan</th>
                                <td class="text-right">:</td>
                                <td id="summaryPemasukan">0</td>
                            </tr>
                            <tr>
                                <th>Total pengeluaran</th>
                                <td class="text-right">:</td>
                                <td id="summaryPengeluaran">0</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td class="text-right">:</td>
                                <td id="summaryTotal">0</td>
                            </tr>
                            {{-- <tr>
                                <th>Saldo sebelumnya</th>
                                <td class="text-right">:</td>
                                <td id="summarySaldoSebelum">0</td>
                            </tr>
                            <tr>
                                <th>Total saldo sekarng</th>
                                <th class="text-right">:</th>
                                <th>0</th>
                            </tr> --}}
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end">
                            <button class="btn btn-sm btn-success btn-icon-split" onclick="addPoin()">
                                <span class="icon"><i class="fas fa-plus"></i></span>
                                <span class="text">Tambah Field</span>
                            </button>
                            <button class="btn btn-sm btn-primary btn-icon-split ml-2" onclick="savePoinLaporan()">
                                <span class="icon"><i class="fas fa-save"></i></span>
                                <span class="text">Simpan</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4" id="fieldDaftarLaporan">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar laporan</h6>
                </div>
                <div class="card-body">

                    <div id="idDaftarLaporan" class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                        <div class="spinner-grow text-primary spinner-grow-lg" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    {{-- <div class="card mb-2">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Collapsable Card Example</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample" style="">
                            <div class="card-body">
                                <div class="table-responseive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th>Keterangan laporan</th>
                                                <th style="width: 80px">Banyak</th>
                                                <th>Harga</th>
                                                <th style="text-align: right">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Ini keterangan laporan</td>
                                                <td>23</td>
                                                <td>20000</td>
                                                <td style="text-align: right">4600000</td>
                                            </tr>
                                            <tr>
                                                <th colspan="3" style="text-align:right">Saldo laporan sebelumnya</th>
                                                <td style="text-align: right">4600000</td>
                                            </tr>
                                            <tr>
                                                <th colspan="3" style="text-align:right">Saldo sekarang</th>
                                                <td style="text-align: right">4600000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-between">
                                        <button class="btn btn-success btn-sm">Kelola Laporan</button>
                                        <button class="btn btn-danger btn-icon-split btn-sm">
                                            <span class="icon"><i class="fas fa-trash"></i></span>
                                            <span class="text">Kosongkan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div id="accordion">
                        {{-- ISI --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection
