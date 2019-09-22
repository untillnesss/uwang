var apis = '/api/api/' //PUBLIC VARIABLE

$(() => {

    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });
})


function a(title = 'Test', desc = 'Test', type = 'success') {
    return Swal.fire({
        title: title,
        text: desc,
        type: type
    });
}

function np(type = 'start') {
    if (type == 'start') {
        NProgress.start();
    } else if (type == 'inc') {
        NProgress.inc()
    } else {
        NProgress.done();
    }
}

function direct(url) {
    window.location.href = url
}

function toast({
    title,
    type = 'success',
    position = 'top-end'
}) {
    Swal.fire({
        toast: true,
        title: title,
        showConfirmButton: false,
        position: position,
        type: type,
        timer: 3000
    })
}


function valEmail(email) {
    var email = email
    var splitAt = email.split('@');

    if (splitAt.length > 1) {
        var splitDot = splitAt[1].split('.')

        if (splitDot.length > 1) {
            return true
        } else {
            toast({
                title: 'Format email salah',
                type: 'error',
            })
            return false
        }
    } else {
        toast({
            title: 'Format email salah',
            type: 'error',
        })
        return false
    }
}

function formatRupiah(angka, prefix) {
    var number_string = angka.toString().replace(/[^,\d]/g, ''),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function ToastSwal(tit, ty = 'success') {
    Swal.fire({
        toast: true,
        showConfirmButton: false,
        timer: 3000,
        position: "top-right",
        title: tit,
        type: ty
    });
}

function penanggalan(
    date,
    hari = false,
    bulan = false,
    tahun = false,
) {
    var dateD = new Date(date)

    var AHari = [
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jum\'at',
        'Sabtu',
    ]

    var ABulan = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ]
    var harihari = AHari[dateD.getDay()]
    var bulanbulan = ABulan[dateD.getMonth()]
    var tahun = dateD.getUTCFullYear()

    if (hari == true) {
        return harihari
    }

    if (bulan == true) {
        return bulanbulan
    }

    if (dateD != 'Invalid Date') {
        return harihari + ', ' + dateD.getDate() + ' ' + bulanbulan + ' ' + tahun;
    } else {
        return 'Masukkan tanggal dengan benar'
    }
}


function cekAngka(val) {
    if (val.match(/^\d+$/)) {
        return true
    } else {
        return false
    }
}

function ucwords(str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}


function saranBug() {
    Swal.mixin({
        showCancelButton: true,
        progressSteps: ["1", "2"],
        allowOutsideClick: false,
        allowEscapeKey: false,
    }).queue([{
        title: 'Saran & Lapor bug',
        text: 'Kami sangat mengharapkan saran dan masukan anda untuk terus meningkatkan performa aplikasi kami, dan jangan lupa lapor bug jika anda menemukan bug yang terdapat dalam aplikasi kami. Silahkan masukkan nama anda dibawah ini!',
        type: 'info',
        input: 'text',
        inputPlaceholder: 'ex. Bambang Sugiyono',
        inputValidator: (val) => {
            return new Promise(resolve => {
                if (val == '') {
                    resolve('Wajib diisi pak')
                } else {
                    resolve()
                }
            })
        },
        confirmButtonText: "Selanjutnya"
    }, {
        text: 'Ketik masukan anda atau saran anda terhadap aplikasi ini! :)',
        input: 'textarea',
        confirmButtonText: "Kirim"
    }]).then((res) => {
        if (!res.dismiss) {
            $.ajax({
                url: apis + 'saranBug',
                method: 'POST',
                data: {
                    nama: res.value[0],
                    saran: res.value[1]
                },
                beforeSend: function () {
                    Swal.fire({
                        title: 'Mengirim saran anda',
                        onBeforeOpen: function () {
                            Swal.showLoading()
                        }
                    })
                },
                success: function () {
                    a('Terimakasih !', 'Saran dan masukan anda sangat berarti sekali bagi kami, kami sennag mendengarnya :)', 'success')
                }
            })
        }
    })
}
