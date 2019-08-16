var loading =
    '<div class="spinner-grow text-primary spinner-grow-lg" role="status"><span class="sr-only">Loading...</span></div>';
var G_idLaporan = "";

function templateAccLaporan(data) {
    tmp = "";

    $.each(data, function (i, d) {
        tmp += '<div class="card mb-1">';
        tmp +=
            '<a href="#collapseAcc' +
            d.id +
            '" class="d-block card-header collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseAcc' +
            d.id +
            '" data-load="false" data-id-laporan="' +
            d.id +
            '" data-type="accCollapseLaporan">';
        tmp +=
            '<h6 class="m-0 font-weight-bold">' +
            penanggalan(d.tanggal) +
            "</h6></a>";

        tmp +=
            '<div id="collapseAcc' +
            d.id +
            '" class="collapse" aria-labelledby="headingAcc' +
            d.id +
            '">';
        tmp += '<div class="card-body" id="cardBodyAccLaporan' + d.id + '">';
        tmp +=
            '<div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center" id="noticeAccLaporan' +
            d.id +
            '">';
        tmp +=
            '<div class="spinner-grow text-primary spinner-grow-lg" role="status">';
        tmp += '<span class="sr-only">Loading...</span>';
        tmp += "</div>";
        tmp += "</div>";
        tmp += "</div>";
        tmp +=
            '<div class="card-footer"><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-between"><button class="btn btn-success btn-sm" onclick="goToLaporan(\'' +
            d.tanggal +
            "', '" +
            d.id +
            '\')">Kelola Laporan</button><button class="btn btn-danger btn-icon-split btn-sm"><span class="icon"><i class="fas fa-trash"></i></span><span class="text">Kosongkan</span></button></div></div></div>';
        tmp += "</div>";
        tmp += "</div>";

        np("inc");
    });

    return tmp;
}

function loadDataLaporan() {
    $.ajax({
        url: apis + "laporan/loadDataLaporan",
        method: "GET",
        beforeSend: function () {
            $("#accordion").empty();
            $("#idDaftarLaporan").html(loading);
            np();
        },
        success: function (data) {
            $("#accordion").html(templateAccLaporan(data));
            $("#idDaftarLaporan").empty();
            np("done");
        }
    });
}

$(document).on("click", "a", function () {
    var ini = $(this);

    if (ini.data("type") == "accCollapseLaporan") {
        if (ini.data("load") == false) {
            var id = ini.data("id-laporan");

            $.ajax({
                url: apis + "pemaspenge/laporan/" + id,
                success: function (data) {
                    var dleng = data.length;
                    var lama = 10
                    // var lama = Math.floor(Math.random() * (5000 - 1000)) + 1

                    setInterval(function () {
                        if (data == "") {
                            var notice = "";
                            notice += '<div class="card">';
                            notice += '<div class="card-body">';
                            notice += "Tidak ada data laporan di tanggal ini !";
                            notice += "</div>";
                            notice += "</div>";
                            $("#noticeAccLaporan" + id + "").html(notice);

                            ini.attr("data-load", true);
                        } else {
                            $("#cardBodyAccLaporan" + id + "").empty();
                            var tmp = "";
                            tmp += '<table class="table table-stripped">';
                            tmp += "<thead>";
                            tmp += "<tr>";
                            tmp +=
                                '<th style="width: 60%">Keterangan laporan</th><th style="width: 10%">Banyak</th><th>Harga</th><th style="text-align: center">Jumlah</th>';
                            tmp += "</th>";
                            tmp += "</tr>";
                            tmp += "</thead>";
                            tmp += "<tbody>";
                            $.each(data, function (i, d) {
                                tmp += templatePoinLaporan(dleng, d, i, "show");
                            });
                            tmp += "</tbody>";
                            tmp += "</table>";
                            $("#cardBodyAccLaporan" + id + "").html(tmp);
                        }
                    }, lama)
                }
            });
        }
    }
});

function goToLaporan(tgl, idLaporan) {
    G_idLaporan = idLaporan;
    $.ajax({
        url: apis + "pemaspenge/poin",
        method: "POST",
        data: {
            id: idLaporan
        },
        beforeSend: function () {
            np();
            $("#labelTanggalDetailLaporan").html(penanggalan(tgl));

            $("#scrollTopBtn").click();
            $("#fieldDaftarLaporan").slideUp(function () {
                $("#fieldTanggalLaporan").slideDown(function () {
                    $("#idDaftarLaporan").html(loading);
                    $("#accordion").empty();
                });
            });
        },
        success: function (data) {
            np("done");
            if (data == "") {
                controllerFieldPoinLaporan();
            } else {
                controllerFieldPoinLaporan(data);
            }
            $("#fieldDetailLaporan").slideDown();
        }
    });
}

function closeDetailMode() {
    $("#fieldDetailLaporan").slideUp(function () {
        $("#fieldDaftarLaporan").slideDown(function () {
            $("#fieldTanggalLaporan").slideUp(function () {
                loadDataLaporan();
            });
        });
    });
}

function controllerFieldPoinLaporan(
    data = [{
        jenis: "",
        nama: "",
        banyak: "1",
        harga: "",
        jumlah: ""
    }]
) {
    var dleng = data.length;

    localStorage.setItem("lengthPoinLaporan", JSON.stringify(dleng));
    localStorage.setItem("poinLaporan", JSON.stringify(data));
    $("#tbodyPoinLaporan").empty();
    if (data.length > 0) {
        $.each(data, function (i, d) {
            $("#tbodyPoinLaporan").append(templatePoinLaporan(dleng, d, i));
        });
    } else {
        $.each(data, function (i, d) {
            $("#tbodyPoinLaporan").append(templatePoinLaporan(dleng, d, i));
        });
    }
}

function templatePoinLaporan(dleng, d, i, type = "edit") {
    var tmp = "";
    if (d.jenis == '+') {
        var classTr = 'bg-tr-masuk'
    } else if (d.jenis == '-') {
        var classTr = 'bg-tr-keluar'
    }
    tmp += "<tr id='poin" + i + "' class='" + classTr + "'>";
    if (type == "edit") {
        tmp += "<td>";
        tmp += '<div class="form-group">';
        tmp +=
            '<select name="" id="jenis' + i + '" class="form-control select" data-type="jenis" data-index="' + i + '">';
        if (d.jenis == "+") {
            tmp += '<option value="." disabled>Pilih tipe</option>';
            tmp += '<option value="+" selected>MASUK</option>';
            tmp += '<option value="-">KELUAR</option>';
        } else if (d.jenis == "-") {
            tmp += '<option value="." disabled>Pilih tipe</option>';
            tmp += '<option value="+">MASUK</option>';
            tmp += '<option value="-" selected>KELUAR</option>';
        } else {
            tmp += '<option value="." selected disabled>Pilih tipe</option>';
            tmp += '<option value="+">MASUK</option>';
            tmp += '<option value="-">KELUAR</option>';
        }
        tmp += "</select>";
        tmp += "</div>";
        tmp += "</td>";
    }
    tmp += "<td>";
    tmp += '<div class="form-group">';
    if (type == "show") {
        tmp +=
            '<input type="text" data-type="nama" data-index="' + i + '" id="nama' +
            i +
            '" class="form-control text-gray-800" disabled value="' +
            d.nama +
            '">';
    } else {
        if (dleng == 0) {
            tmp +=
                '<input type="text" data-type="nama" data-index="' + i + '" id="nama' + i + '" class="form-control">';
        } else {
            tmp +=
                '<input type="text" data-type="nama" data-index="' + i + '" id="nama' +
                i +
                '" class="form-control" value="' +
                d.nama +
                '">';
        }
    }
    tmp += "</div>";
    tmp += "</td>";
    tmp += "<td>";
    tmp += '<div class="form-group">';
    if (type == "show") {
        tmp +=
            '<input type="text" data-type="banyak" data-index="' + i + '" id="banyak' +
            i +
            '" class="form-control text-gray-800" disabled value="' +
            d.banyak +
            '">';
    } else {
        if (dleng == 0) {
            tmp +=
                '<input type="text" data-type="banyak" data-index="' + i + '" id="banyak' + i + '" class="form-control">';
        } else {
            tmp +=
                '<input type="text" data-type="banyak" data-index="' + i + '" id="banyak' +
                i +
                '" class="form-control" value="' +
                d.banyak +
                '">';
        }
    }
    tmp += "</div>";
    tmp += "</td>";
    tmp += "<td>";
    tmp += '<div class="form-group">';
    if (type == "show") {
        tmp +=
            '<input type="text" data-type="harga" data-index="' + i + '" id="harga' +
            i +
            '" class="form-control text-gray-800" disabled value="' +
            d.harga +
            '">';
    } else {
        if (dleng == 0) {
            tmp +=
                '<input type="text" data-type="harga" data-index="' + i + '" id="harga' + i + '" class="form-control">';
        } else {
            tmp +=
                '<input type="text" data-type="harga" data-index="' + i + '" id="harga' +
                i +
                '" class="form-control" value="' +
                d.harga +
                '">';
        }
    }
    tmp += "</div>";
    tmp += "</td>";
    tmp += "<td>";
    tmp += '<div class="form-group">';
    if (type == "show") {
        tmp +=
            '<input type="text" data-type="jumlah" readonly disabled data-index="' + i + '" id="jumlah' +
            i +
            '" class="form-control text-gray-800" disabled value="' +
            d.jumlah +
            '">';
    } else {
        if (dleng == 0) {
            tmp +=
                '<input type="text" data-type="jumlah" readonly disabled data-index="' + i + '" id="jumlah' + i + '" class="form-control">';
        } else {
            tmp +=
                '<input type="text" data-type="jumlah" readonly disabled data-index="' + i + '" id="jumlah' +
                i +
                '" class="form-control" value="' +
                d.jumlah +
                '">';
        }
    }
    tmp += "</div>";
    tmp += "</td>";
    if (type == "edit") {
        if (dleng > 1) {
            tmp += "<td>";
            tmp +=
                '<button class="btn btn-danger" onclick="deletePoin(\'' +
                i +
                "', '" +
                d.id +
                "', '" +
                G_idLaporan +
                '\')"><i class="fas fa-times"></i></button>';
            tmp += "</td>";
        }
    }
    tmp += "</tr>";
    return tmp;
}

function deletePoin(index, id, idLaporanDelete) {
    Swal.fire({
        title: "Peringatan !",
        text: "Apakah anda yakin ingin menghapus poin ini .?",
        type: "question",
        showCancelButton: true
    }).then(res => {
        if (res.value) {
            $.ajax({
                url: apis + "pemaspenge/poin/delete",
                method: "POST",
                data: {
                    id: id,
                    idLaporan: idLaporanDelete
                },
                beforeSend: function () {
                    np();
                },
                success: function () {
                    $("#poin" + index + "").remove();
                    var data = JSON.parse(localStorage.getItem("poinLaporan"));
                    data.splice(index, 1);

                    // return false;
                    np("done");
                    ToastSwal("Berhasil menghapus");
                    if (data == "") {
                        controllerFieldPoinLaporan();
                    } else {
                        controllerFieldPoinLaporan(data);
                    }
                    $('#summaryPemasukan').html(writeSummary('+'))
                    $('#summaryPengeluaran').html(writeSummary('-'))
                    $('#summaryTotal').html(writeSummary('total'))
                }
            });
        }
    });
}

function addPoin() {
    np();
    var data = JSON.parse(localStorage.getItem("poinLaporan"));
    var newData = {
        jenis: "",
        nama: "",
        banyak: "1",
        harga: "",
        jumlah: ""
    };
    data.push(newData);
    localStorage.setItem("poinLaporan", JSON.stringify(data));
    controllerFieldPoinLaporan(data);
    np("done");
}

$("#tbodyPoinLaporan").on("keyup", 'input', function () {
    preSavePoinLaporan($(this))
    $('#summaryPemasukan').html(writeSummary('+'))
    $('#summaryPengeluaran').html(writeSummary('-'))
    $('#summaryTotal').html(writeSummary('total'))
});
$("#tbodyPoinLaporan").on("change", 'select', function () {
    preSavePoinLaporan($(this))
    $('#summaryPemasukan').html(writeSummary('+'))
    $('#summaryPengeluaran').html(writeSummary('-'))
    $('#summaryTotal').html(writeSummary('total'))
});

function preSavePoinLaporan(thisis) {
    var data = JSON.parse(localStorage.getItem('poinLaporan'))
    var index = thisis.data('index')
    var typeField = thisis.data('type')
    var valueThis = thisis.val()

    switch (typeField) {
        case 'jenis':
            if (valueThis == '+') {
                $('tr#poin' + index + '').addClass('bg-tr-masuk')
                $('tr#poin' + index + '').removeClass('bg-tr-keluar')
            } else if (valueThis == '-') {
                $('tr#poin' + index + '').addClass('bg-tr-keluar')
                $('tr#poin' + index + '').removeClass('bg-tr-masuk')
            }
            data[index].jenis = thisis.val()
            break;
        case 'nama':
            data[index].nama = thisis.val()
            break;
        case 'banyak':
            if (cekAngka(valueThis) && valueThis > 0 && valueThis.charAt(0) != 0) {
                data[index].banyak = valueThis
                data[index].jumlah = setJumlah(index)
            } else {
                thisis.val('')
                ToastSwal('Tidak boleh kosong atau negatif', 'error')
            }
            break;
        case 'harga':
            if (cekAngka(valueThis) && valueThis > 0 && valueThis.charAt(0) != 0) {
                data[index].harga = thisis.val()
                data[index].jumlah = setJumlah(index)
            } else {
                thisis.val('')
                ToastSwal('Harus angka', 'error')
            }
            break;
        case 'jumlah':
            data[index].jumlah = thisis.val()
            break;
    }
    localStorage.setItem('poinLaporan', JSON.stringify(data))
}

function setJumlah(index) {
    var banyak = $('input#banyak' + index + '').val()
    var harga = $('input#harga' + index + '').val()
    var jumlah = $('input#jumlah' + index + '')

    var hasil = harga * banyak

    // if (isNaN(hasil)) {
    //     jumlah.val('')
    // } else {
    // }

    jumlah.val(hasil)
    return hasil
}


function savePoinLaporan() {
    var data = JSON.parse(localStorage.getItem('poinLaporan'))

    var inc = 0
    var dataLen = data.length
    var hasilFor = 5 * dataLen


    $.each(data, function (i, d) {
        $.each(d, function (ii, dd) {
            if (dd == '' || dd == null) {
                ToastSwal('Harus diisi semuanya pak !', 'error')
                return false
            } else {
                inc++
            }
        })
    })

    if (inc == hasilFor) {
        console.log('pass');

    } else {
        console.log('Gakpaass');

    }
}

function writeSummary(type = '') {
    var data = JSON.parse(localStorage.getItem('poinLaporan'))
    var hasil = 0
    var isNegative = false

    if (type == 'total') {
        // MASUK PAK
        var masuk = 0
        var filteran = data.filter(function (d) {
            return d.jenis == '+'
        })

        $.each(filteran, function (i, d) {
            masuk = masuk + d.jumlah
        })

        // KELUAR PAK
        var keluar = 0
        var filteran = data.filter(function (d) {
            return d.jenis == '-'
        })

        $.each(filteran, function (i, d) {
            keluar = keluar + d.jumlah
        })

        // AKHIR
        hasil = masuk - keluar
        if (String(hasil).charAt(0) == '-') {
            isNegative = true
        }
    } else {
        var filteran = data.filter(function (d) {
            return d.jenis == type
        })

        $.each(filteran, function (i, d) {
            hasil = hasil + d.jumlah
        })
    }

    return isNegative ? '-' + formatRupiah(hasil) : formatRupiah(hasil)
}


$(() => {
    loadDataLaporan();
    writeSummary()
});
