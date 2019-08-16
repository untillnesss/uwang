// var dataTableLaporan;
var dataTableLaporan = $("#example1").DataTable({
    processing: true,
    serverSide: true,
    ajax: apis + "laporan/getDataLaporan",
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

                btn +=
                    '<button class="btn btn-sm btn-primary btn-icon-split pull-right" onclick="editFun(' + data.id + ')"><span class="icon"><i class="fas fa-dollar-sign"></i></span><span class="text">Buat laporan</span></button>';
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
                id: id
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
