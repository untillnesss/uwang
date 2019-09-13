var G_idAnggotaEdit = 0
var dataTableAnggota = $("#example1").DataTable({
    processing: true,
    serverSide: true,
    ajax: apis + "anggota/getDataAnggota",
    sort: false,
    columns: [{
            data: 'nama',
            name: "nama",
        },
        {
            data: 'email',
            name: 'email'
        }, {
            data: null,
            name: 'level',
            width: '10%',
            render: function (data) {
                var out = ''

                switch (data.level) {
                    case 'admin':
                        out = '<h6><span class="badge badge-success">ADMIN</span></h6>'
                        break;
                    case 'bendahara':
                        out = '<h6><span class="badge badge-primary">BENDAHARA</span></h6>'
                        break;
                    case 'anggota':
                        out = '<h6><span class="badge badge-secondary">ANGGOTA</span></h6>'
                        break;

                }

                return out
            }
        }, {
            data: null,
            name: 'status',
            render: function (data) {
                var out = ''

                switch (data.status) {
                    case 'pending':
                        out = '<h6><span class="badge badge-warning">PENDING</span></h6>'
                        break;
                    case 'acc':
                        out = '<h6><span class="badge badge-success">ONLINE</span></h6>'
                        break;
                    case 'not':
                        out = '<h6><span class="badge badge-danger">DITOLAK</span></h6>'
                        break;
                }
                return out
            }
        },
        {
            data: null,
            name: "aksi",
            width: "15% ",
            render: function (data) {
                var btn = "";

                if (data.status == 'pending') {
                    btn +=
                        '<button class="btn btn-sm btn-primary mr-2" data-toggle="tooltip" title="Lihat kode keamanan" data-placement="bottom" onclick="showKodeKeamanan(' +
                        data.id +
                        ')"><i class="fas fa-eye"></i></button>';
                }

                btn +=
                    '<button class="btn btn-sm btn-danger mr-2" onclick="deleteFun(' +
                    data.id +
                    ')"><i class="fas fa-trash"></i></button>';

                if (data.status != 'not') {
                    btn +=
                        '<button class="btn btn-sm btn-success mr-2" onclick="editFun(' + data.id + ')"><i class="fas fa-edit"></i></button>';
                }

                return btn;
            }
        }
    ]
});

$(() => {
    // loadDataLaporan();
});

function showKodeKeamanan(id) {
    $.ajax({
        url: apis + 'anggota/kodeKeamanan',
        method: 'POST',
        data: {
            id: id
        },
        beforeSend: function () {
            np()
        },
        success: function (data) {
            np('done')
            Swal.fire({
                title: 'Kode keamanan ' + data.nama + ' adalah ..',
                text: data.kode,
                type: 'success'
            })
        }
    });
}

function deleteFun(id) {
    Swal.fire({
        title: "Perinngatan !",
        text: "Apakah anda yakin ingin menghapus data tersebut .?",
        type: "question",
        showCancelButton: true,
        confirmButtonText: "Yes"
    }).then(res => {
        if (res.value) {
            $.ajax({
                url: apis + "anggota/deleteDataAnggota",
                method: "POST",
                data: {
                    id: id
                },
                beforeSend: function () {
                    np();
                },
                success: function () {
                    dataTableAnggota.ajax.reload();
                    np("done");
                    Swal.fire({
                        toast: true,
                        position: "top-right",
                        title: "Berhasil menghapus data",
                        timer: 3000,
                        type: "success",
                        showConfirmButton: false
                    });
                }
            });
        }
    });
}

function editFun(id) {
    $.ajax({
        url: apis + 'laporan/prepareEditAnggota/' + id,
        method: 'GET',
        beforeSend: function () {
            np()
        },
        success: function (data) {
            G_idAnggotaEdit = id
            var el = ''
            if (data.status == 'pending') {
                el += '<div class="form-group">'
                el += '<label for="">Masukkan nama</label>'
                el += '<input type="text" class="form-control" id="namaEdit" placeholder="Bambang Wis RaaNgiro" value="' + data.nama + '">'
                el += '</div>'

                el += '<div class="form-group">'
                el += '<label for="">Masukkan email</label>'
                el += '<input type="email" class="form-control" id="emailEdit" placeholder="example@email.com" value="' + data.email + '">'
                el += '</div>'

            }
            el += '<div class="form-group">'
            el += '<label for="">Pilih level</label>'
            el += '<select name="" class="custom-select" id="levelEdit">'
            el += '<option value="0" selected disabled>-- PILIH LEVEL --</option>'
            $.each(JSON.parse(localStorage.getItem('level')), function (i, d) {
                if (d.id == data.idLevel) {
                    el += '<option selected value="' + ucwords(d.nama) + '">' + ucwords(d.nama) + '</option>'
                } else {
                    el += '<option value="' + ucwords(d.nama) + '">' + ucwords(d.nama) + '</option>'
                }
            })
            el += '</select>'
            el += '</div>'

            $('#fieldEditAnggotaModal').html(el)
            $('#editAnggotaModal').modal('show')
            np('done')
        }
    });

}

$("#btnTambahAnggota").on("click", function () {
    var data = {
        nama: $('#nama').val(),
        email: $('#email').val(),
        level: $('#level').val()
    }

    if (data.nama == '' || data.email == '' || data.level == null) {
        return ToastSwal('Harus di isi semuanya ya pak !', 'error')
    } else {
        if (valEmail(data.email)) {
            $.ajax({
                url: apis + "anggota/addDataAnggota",
                method: "POST",
                data: data,
                beforeSend: function () {
                    np();
                },
                success: function (d) {
                    np('done')
                    if (d == "y") {
                        ToastSwal('Berhasil menambahkan data pak!')
                        $('#tambahLaporanModal').modal('hide')
                        dataTableAnggota.ajax.reload()
                    } else if (d == 'x') {
                        ToastSwal('Email sudah digunakan', 'error')
                    }
                }
            });
        }
    }
});

$("#btnSimpanLaporan").on("click", function () {
    var tanggal = $("#tanggalEdit").val();
    var id = $("#idTanggalEdit").val();

    if (tanggal == "") {
        ToastSwal("Harus di isi ya pak !", 'error');
    } else {
        $.ajax({
            url: apis + "laporan/editDataLaporan",
            method: "POST",
            data: {
                tanggal: tanggal,
                id: G_idTanggalEdit
            },
            beforeSend: function () {
                np();
            },
            success: function (d) {
                np('done')
                if (d == "y") {
                    ToastSwal('Berhasil mengubah data pak!')
                    $('#editLaporanModal').modal('hide')
                    dataTableLaporan.ajax.reload()
                } else if (d == 'x') {
                    ToastSwal('Tanggal sudah tersedia ! tidak tersimpan', 'error')
                }
            }
        });
    }
});

$('#tanggal').on('change', function () {
    var val = $(this).val()
    $('#fieldPenanggalan').html(penanggalan(val))
})
$('#tanggalEdit').on('change', function () {
    var val = $(this).val()
    $('#fieldPenanggalanEdit').html(penanggalan(val))
})
