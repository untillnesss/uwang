window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
};


function getSaldo() {
    $.ajax({
        url: apis + 'saldo/getSaldo',
        method: 'GET',
        beforeSend: function () {
            np()
        },
        success: function (data) {
            np('done')
            if (data == 'x') {
                tambahkanSaldoAwal()
            } else {
                if (data['jumlah'].charAt(0) == '-') {
                    $('#textSaldo').text('-' + formatRupiah(data['jumlah']))

                } else {
                    $('#textSaldo').text(formatRupiah(data['jumlah']))

                }

            }
        }
    })
}

function tambahkanSaldoAwal() {
    Swal.fire({
        title: 'Karena anda adalah member baru, jumlah saldo anda tidak ditemukan',
        text: 'Silahkan isi field dibawah untuk menambahkan jumlah saldo awal',
        input: 'text',
        inputPlaceholder: 'Masukkan angka',
        confirmButtonText: 'SIMPAN',
        allowOutsideClick: false,
        inputValidator: (v) => {
            return new Promise((resolve) => {
                if (v != '') {
                    resolve()
                } else {
                    resolve('Field tidak boleh kosong')
                }
            })
        }
    }).then((res) => {
        if (cekAngka(res.value)) {
            $.ajax({
                url: apis + 'saldo/postSaldo',
                method: 'POST',
                data: {
                    saldo: res.value
                },
                beforeSend: function () {
                    np()
                },
                success: function (d) {
                    np('done')
                    if (d == 'y') {
                        a('Berhasil !', 'Berhasil menambahkan saldo awal', 'success')
                        getSaldo()
                    } else {
                        tambahkanSaldoAwal()
                    }
                }
            })
        } else {
            a('Gagal !', 'Format harus angka saja !', 'error').then(() => {
                tambahkanSaldoAwal()
            })
        }
    })
}

$.ajax({
    url: apis + 'summary',
    method: 'GET',
    success: function (data) {
        var dataPerubahanSaldoPerHari = data[0]

        var tanggal = []
        $.each(data[1], function (i, d) {
            tanggal.push(penanggalan(d.split('T')[0]).split(', ')[1])
        })

        var config = {
            type: 'line',
            data: {
                labels: tanggal,
                datasets: [{
                    label: 'Saldo',
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: dataPerubahanSaldoPerHari,
                    fill: true
                }]
            },
            options: {
                legend: {
                    display: false,
                    position: 'top'
                },
                responsive: true,
                title: {
                    display: false,
                    text: 'Chart.js Line Chart'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Tanggal'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                        }
                    }]
                }
            }
        }
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, config);
    }
})

$.ajax({
    url: apis + 'pemasukanPengeluaran',
    method: 'GET',
    success: function (data) {

        var tanggal = []
        var masuk = []
        var keluar = []
        $.each(data, function (i, d) {
            tanggal.push(d.tanggal)
            masuk.push(d.data.masuk)
            keluar.push(d.data.keluar)
        })

        var config = {
            type: 'line',
            data: {
                labels: tanggal,
                datasets: [{
                    label: 'Pengeluaran',
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: keluar,
                    fill: false,
                }, {
                    label: 'Pemasukan',
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: masuk,
                    fill: false,
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top'
                },
                responsive: true,
                title: {
                    display: false,
                    text: 'Chart.js Line Chart'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Tanggal'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                        }
                    }]
                }
            }
        }
        var ctx = document.getElementById('myChart2').getContext('2d');
        var myChart = new Chart(ctx, config);
    }
})


$(() => {
    getSaldo()

    $('div.boxHeaderAccordion').on('click', function () {
        console.log($(this).data('type'));
    })

})
