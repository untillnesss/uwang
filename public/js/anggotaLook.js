function genereateButtonNav(ty = "ori") {
    $("#myNav").slideUp(function () {
        var myNav = "";
        if (ty == "all") {
            myNav +=
                '<button class="navbar-toggler bg-light" onclick="backFunc()">' +
                '<span class="fas fa-arrow-left"></span>' +
                "</button>" +
                '<button class="navbar-toggler bg-light" data-toggle="modal" data-target="#logoutModal">' +
                '<span class="fas fa-sign-out-alt"></span>' +
                "</button>";
        } else {
            myNav +=
                '<button class="navbar-toggler bg-light ml-auto" data-toggle="modal" data-target="#logoutModal">' +
                '<span class="fas fa-sign-out-alt"></span>' +
                "</button>";
        }

        $("#myNav").html(myNav);
        $("#myNav").slideDown();
    });
}

function getLaporan() {
    $.ajax({
        url: apis + "dashboard/anggota/getDataLaporan",
        method: "GET",
        beforeSend: function () {
            np();
        },
        success: function (data) {
            var isi = "";

            genereateButtonNav();
            if (data == "") {
                isi +=
                    '<div class="col-12 p-1"><div class="card"><div class="card-body text-center">Tidak ada data laporan yang di publikasikan, silahkan hubungi admin !</div></div></div>';
            } else {
                $.each(data, function (i, d) {
                    isi += '<div class="col-md-6 col-xs-12 ';
                    if (data.length == 2) {
                        isi += "col-xl-6";
                    } else if (data.length == 1) {
                        isi += "col-xl-12";
                    } else if (data.length >= 3) {
                        isi += "col-xl-4";
                    }
                    isi += '">';
                    isi += '<div class="card my-1">';
                    isi += '<div class="card-body row">';
                    isi +=
                        '<div class="col-md-4 col-sm-12 d-flex flex-column justify-content-center align-items-center">';
                    isi +=
                        '<div class="bulat d-flex flex-column justify-content-center align-items-center bg-primary">';
                    isi +=
                        '<h4 class="m-0 p-0">' + d.tanggal.substr(-2) + "</h4>";
                    isi +=
                        '<p class="p-0 m-0" style="font-size: 12px">' +
                        penanggalan(d.tanggal, false, true) +
                        "</p>";
                    isi += "</div></div>";
                    isi +=
                        '<div class = "col-md-8 col-sm-12 flex-column d-sm-flex d-flex d-md-block justify-content-center align-items-center mt-3 mt-md-0"><p class="m-0">Laporan pada tanggal</p><p class="text-muted m-0"><small>' +
                        penanggalan(d.tanggal) +
                        "</small></p></div>";
                    isi += "</div>";
                    isi +=
                        '<div class="card-footer d-flex justify-content-between align-item-center" onclick="detail(' +
                        d.id +
                        ')" style="cursor:pointer"><a href="#">Lihat</a><span class="fas fa-angle-right d-flex justify-content-center"></span></div>';
                    isi += "</div></div>";
                });
            }
            $("#fieldCardLaporan").html(isi);
            $("#loading").slideUp(function () {
                $("#fieldCardLaporan").slideDown();
            });
            np("done");
        }
    });
}

$(() => {
    getLaporan();
});

function detail(id) {
    $("#fieldCardLaporan").slideUp(function () {
        $("#loading").slideDown(function () {
            $.ajax({
                url: apis + "dashboard/anggota/getDetailLaporan/" + id,
                method: "GET",
                beforeSend: function () {
                    np();
                },
                success: function (data) {
                    genereateButtonNav("all");
                    np("done");
                    $("#loading").slideUp(function () {
                        $('#tanggalLaporan').html(' ' + penanggalan(data[0].tanggal))
                        var isiTable = ''
                        $.each(data[1], function (i, d) {
                            isiTable += '<tr>' +
                                '<td>' + parseInt(i + 1) + '</td>' +
                                '<td>' + d.nama + '</td>' +
                                '<td class="text-center">' + d.banyak + '</td>' +
                                '<td>' + formatRupiah(d.harga) + '</td>'
                            if (d.jenis == '+') {
                                isiTable += '<td>' + formatRupiah(d.jumlah) + '</td>' +
                                    '<td></td>'
                            } else {
                                isiTable += '<td></td>' +
                                    '<td>' + formatRupiah(d.jumlah) + '</td>'
                            }
                            isiTable += '</tr>'
                        })
                        $('#isiPoinLaporan').html(isiTable)
                        $('#debit').html(formatRupiah(data[2][0]))
                        $('#kredit').html(formatRupiah(data[2][1]))

                        var total = parseInt(data[2][0] - data[2][1])

                        total < 0 ? $('.total').html('-' + formatRupiah(total)) : $('.total').html(formatRupiah(total))

                        data[3][0] == 'x' ? $('#tanggalSebelum').html('Ini adalah laporan paling awal') : $('#tanggalSebelum').html(penanggalan(data[3][0]))
                        $('#saldoSebelum').html(data[3][1])
                        $('#saldoSaatIni').html(data[3][2])
                        $("#tableLaporan").slideDown();
                    });
                }
            });
        });
    });
}

function backFunc() {
    $("#tableLaporan").slideUp(function () {
        $("#loading").slideDown(function () {
            getLaporan();
        });
    });
}
