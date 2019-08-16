$(() => {
    getSaldo()

    $('div.boxHeaderAccordion').on('click', function () {
        console.log($(this).data('type'));
    })
})

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
                $('#textSaldo').text(formatRupiah(data['jumlah']))
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
