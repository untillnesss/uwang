@extends('lay.lay')

@section('title', 'DASHBOARD')

@section('meta')
    <meta name="level" content="{{$level}}">
@endsection

@section('body')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Anggota</h1>

        <div>
            <button class="btn btn-primary btn-sm btn-icon-split" data-toggle="modal" data-target="#tambahLaporanModal">
                <span class="icon">
                    <i class="fas fa-plus"></i>
                </span>

                <span class="text">Tambah Anggota</span>
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-stripped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Level</th>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form tambah anggota</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="">Masukkan nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Bambang Wis RaaNgiro">
                        </div>
                        <div class="form-group">
                            <label for="">Masukkan email</label>
                            <input type="text" class="form-control" id="email" placeholder="email@email.com">
                        </div>
                        <div class="form-group">
                            <label for="">Pilih level</label>
                            <select name="" class="custom-select" id="level">
                                <option value="0" selected disabled>-- PILIH LEVEL --</option>
                                @foreach ($level as $lvl)
                                <option value="{{$lvl->id}}">{{ucwords($lvl->nama)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                    <div><small>Password akan diisi oleh pemilik email sendiri</small></div>
                    <div>
                        <button class="btn btn-primary" id="btnTambahAnggota">Tambah</button>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editAnggotaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form edit anggota</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12" id="fieldEditAnggotaModal">
                        <div class="form-group">
                            <label for="">Masukkan nama</label>
                            <input type="text" class="form-control" id="namaEdit" placeholder="Bambang Wis RaaNgiro">
                        </div>
                        <div class="form-group">
                            <label for="">Masukkan email</label>
                            <input type="text" class="form-control" id="emailEdit" placeholder="email@email.com">
                        </div>
                        <div class="form-group">
                            <label for="">Pilih level</label>
                            <select name="" class="custom-select" id="levelEdit">
                                <option value="0" selected disabled>-- PILIH LEVEL --</option>
                                @foreach ($level as $lvl)
                                <option value="{{$lvl->id}}">{{ucwords($lvl->nama)}}</option>
                                @endforeach
                            </select>
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


@section('js')

@if ($level)
    <script>
        var data = $('meta[name="level"]').attr('content')
        localStorage.setItem('level', data)
    </script>
@endif

@endsection
