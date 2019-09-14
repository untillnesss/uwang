var G_idTanggalEdit = 0
var dataTableLaporan = $("#example1").DataTable({
    processing: true,
    serverSide: true,
    ajax: apis + "laporan/getDataLaporan",
    sort: false,
    columns: [{
            data: null,
            name: "tanggal",
            render: function (data) {
                return penanggalan(data.tanggal)
            }
        },
        {
            data: null,
            name: "aksi",
            width: "30%",
            render: function (data) {
                var btn = "";
                btn +=
                    '<button class="btn btn-sm btn-danger mr-2" onclick="deleteFun(' +
                    data.id +
                    ')"><i class="fas fa-trash"></i></button>';
                btn +=
                    '<button class="btn btn-sm btn-success mr-2" onclick="editFun(' + data.id + ')"><i class="fas fa-edit"></i></button>';

                if (data.terbit == '1') {
                    btn +=
                        '<button class="btn btn-sm btn-danger btn-icon-split pull-right" onclick="terbitFun(' + data.id + ', 0)"><span class="icon"><i class="fas fa-times"></i></span><span class="text">Batal Terbitkan</span></button>';
                } else {
                    btn +=
                        '<button class="btn btn-sm btn-primary btn-icon-split pull-right" onclick="terbitFun(' + data.id + ', 1)"><span class="icon"><i class="fas fa-check"></i></span><span class="text">Terbitkan</span></button>';
                }

                return btn;
            }
        }
    ]
});

$(() => {
    // loadDataLaporan();
    $('#fieldPenanggalan').html(penanggalan($('#tanggal').val()))
    $('#fieldPenanggalanEdit').html(penanggalan($('#tanggalEdit').val()))
});

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
                url: apis + "laporan/deleteDataLaporan",
                method: "POST",
                data: {
                    id: id
                },
                beforeSend: function () {
                    np();
                },
                success: function () {
                    dataTableLaporan.ajax.reload();
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
        url: apis + 'laporan/prepareEditLaporan/' + id,
        method: 'GET',
        beforeSend: function () {
            np()
        },
        success: function (data) {
            $('#idTanggalEdit').val(id)
            G_idTanggalEdit = id
            $('#tanggalEdit').val(data.tanggal)
            $('#fieldPenanggalanEdit').html(penanggalan(data.tanggal))

            $('#editLaporanModal').modal('show')
            np('done')
        }
    });

}

$("#btnTambahLaporan").on("click", function () {
    var tanggal = $("#tanggal").val();

    if (tanggal == "") {
        ToastSwal("Harus di isi ya pak !", 'error');
    } else {
        $.ajax({
            url: apis + "laporan/addDataLaporan",
            method: "POST",
            data: {
                tanggal: tanggal
            },
            beforeSend: function () {
                np();
            },
            success: function (d) {
                np('done')
                if (d == "y") {
                    ToastSwal('Berhasil menambahkan data pak!')
                    $('#tambahLaporanModal').modal('hide')
                    dataTableLaporan.ajax.reload()
                } else if (d == 'x') {
                    ToastSwal('Tanggal sudah tersedia !', 'error')
                }
            }
        });
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

function terbitFun(id, status) {
    $.ajax({
        url: apis + 'laporan/terbit',
        method: 'POST',
        data: {
            id: id,
            status: status
        },
        beforeSend: function () {
            np()
        },
        success: function (data) {
            if (data == '1') {
                ToastSwal('Laporan berhasil diterbitkan', 'success')
            } else {
                ToastSwal('Laporan dibatalkan', 'success')
            }
            dataTableLaporan.ajax.reload()
            np('done')
        }
    });
}

$('#tanggal').on('change', function () {
    var val = $(this).val()
    $('#fieldPenanggalan').html(penanggalan(val))
})

$('#tanggalEdit').on('change', function () {
    var val = $(this).val()
    $('#fieldPenanggalanEdit').html(penanggalan(val))
})

// $('#datetimepicker3').datetimepicker();
