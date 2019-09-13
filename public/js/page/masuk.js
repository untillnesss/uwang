$("#masuk").on("click", function () {
    var data = {
        email: $("#email").val(),
        pass: $("#pass").val()
    };

    var pass = 0;

    $.each(data, function (i, d) {
        if (d != "") {
            pass++;
            if (i == "pass" && pass == 2) {
                if (valEmail(data.email)) {
                    $.ajax({
                        url: "/masuk",
                        method: "POST",
                        data: data,
                        beforeSend: function () {
                            np();
                        },
                        success: function (d) {
                            if (d == "y") {
                                Swal.fire({
                                    title: "Berhasil !",
                                    text: "Berhasil masuk pak, Selamat datang !",
                                    type: "success",
                                    allowOutsideClick: false
                                }).then(res => {
                                    if (res.value) {
                                        direct("/");
                                    }
                                });
                            } else if (d == "x") {
                                np("done");
                                toast({
                                    title: "Email dan password salah pak !",
                                    type: "error"
                                });
                            }
                        }
                    });
                }
            }
        } else {
            toast({
                title: "Semua field harus diisi!",
                type: "error"
            });
        }
    });
});

$("#klaim").on("click", function () {
    Swal.mixin({
            showCancelButton: true,
            progressSteps: ["1", "2"],
            confirmButtonText: "Selanjutnya",
            allowOutsideClick: false
        })
        .queue([{
                title: "Informasi !",
                type: "info",
                text: "Anda memasuki sesi klaim akun. Dimana anda sudah didaftarkan oleh admin, kemudian minta email dan kode keamanan dari admin"
            },
            {
                text: "Minta email yang telah didaftarkan oleh admin",
                title: "Email",
                input: "email",
                inputPlaceholder: "Masukkan email anda"
            }
        ])
        .then(res => {
            if (!res.dismiss) {
                Swal.fire({
                    title: "Memperoses ...",
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                        $.ajax({
                            url: apis + "masuk/klaim/cekEmail",
                            method: "POST",
                            data: {
                                email: res.value[1]
                            },
                            success: function (data) {
                                if (data == 'x') {
                                    Swal.fire({
                                        title: 'Gagal !',
                                        text: 'Email tidak ditemukan. Mungkin anda salah memasukkan emailnya, silahkan coba lagi !',
                                        type: 'error',
                                        confirmButtonText: 'Coba lagi'
                                    }).then(() => {
                                        $('#klaim').click()
                                    })
                                } else {
                                    localStorage.setItem('klaimEmail', res.value[1])
                                    Swal.mixin({
                                        allowOutsideClick: false,
                                        showCancelButton: true,
                                        progressSteps: [
                                            '3', '4'
                                        ],
                                        confirmButtonText: 'Selanjutnya'
                                    }).queue([{
                                        text: 'Akun dengan email ' + res.value[1] + ' telah terdaftar, silahkan masukkan kode keamanan yang didapatkan dari admin untuk melanjutkan proses.',
                                        type: 'success',
                                        title: 'Berhasil !'
                                    }, {
                                        text: 'Masukkan kode anda',
                                        input: 'text',
                                        inputPlaceholder: 'XXXXXX',
                                        inputValidator: (val) => {
                                            return new Promise(resolve => {
                                                if (val == '') {
                                                    resolve('Wajib diisi pak')
                                                } else {
                                                    resolve()
                                                }
                                            })
                                        }
                                    }]).then(res => {
                                        if (!res.dismiss) {
                                            console.log(res)
                                            Swal.fire({
                                                title: 'Memperoses ...',
                                                allowOutsideClick: false,
                                                onBeforeOpen: () => {
                                                    Swal.showLoading()
                                                    $.ajax({
                                                        url: apis + 'masuk/klaim/cekKode',
                                                        method: 'POST',
                                                        data: {
                                                            kode: res.value[1],
                                                            email: localStorage.getItem('klaimEmail')
                                                        },
                                                        success: function (data) {
                                                            if (data == 'x') {
                                                                Swal.fire({
                                                                    title: 'Gagal !',
                                                                    text: 'Kode keamanan dan email tidak cocok, silahkan coba lagi !',
                                                                    type: 'error',
                                                                    confirmButtonText: 'Coba lagi'
                                                                }).then(() => {
                                                                    $('#klaim').click()
                                                                })
                                                            } else {
                                                                localStorage.setItem('klaimKode', res.value[1])
                                                                klaimPassword().then(res => {
                                                                    if (res.value.length == 3) {
                                                                        if (res.value[1] == res.value[2]) {
                                                                            storePass(res)
                                                                        } else {
                                                                            Swal.fire({
                                                                                title: 'Maaf !',
                                                                                text: 'Password keduanya harus sama, silahkan coba lagi !',
                                                                                type: 'error'
                                                                            }).then(() => {
                                                                                klaimPassword('ulang')
                                                                            })
                                                                        }
                                                                    } else {
                                                                        if (res.value[0] == res.value[1]) {
                                                                            storePass(res)
                                                                        } else {
                                                                            Swal.fire({
                                                                                title: 'Maaf !',
                                                                                text: 'Password keduanya harus sama, silahkan coba lagi !',
                                                                                type: 'error'
                                                                            }).then(() => {
                                                                                klaimPassword('ulang') //BELOM ADA CATCH NYA BELOM DI TANGKAP
                                                                            })
                                                                        }
                                                                    }
                                                                })
                                                            }
                                                        }
                                                    })
                                                }
                                            })
                                        }
                                    })
                                }
                            }
                        });
                    }
                });
            }
        });
});

function klaimPassword(type = 'biasa') {
    var step, queueeuwe
    if (type == 'ulang') {
        step = [
            '5',
            '6'
        ]

        queueeuwe = [{
            title: 'Password',
            input: 'password',
            inputPlaceholder: 'Masukkan password',
            inputValidator: (val) => {
                return new Promise((resolve) => {
                    if (val == '') {
                        resolve('Password wajib di isi')
                    } else {
                        resolve()
                    }
                })
            }
        }, {
            title: 'Re-Password',
            input: 'password',
            inputPlaceholder: 'Ketik ulang password',
            inputValidator: (val) => {
                return new Promise((resolve) => {
                    if (val == '') {
                        resolve('Password wajib di isi')
                    } else {
                        resolve()
                    }
                })
            }
        }]

        return Swal.mixin({
            allowOutsideClick: false,
            progressSteps: step,
            confirmButtonText: 'Selanjutnya',
            showCancelButton: true
        }).queue(
            queueeuwe
        ).then(res => {
            if (!res.dismiss) {
                if (res.value[0] == res.value[1]) {
                    storePass(res)
                } else {
                    Swal.fire({
                        title: 'Maaf !',
                        text: 'Password keduanya harus sama, silahkan coba lagi !',
                        type: 'error'
                    }).then(() => {
                        klaimPassword('ulang') //BELOM ADA CATCH NYA BELOM DI TANGKAP
                    })
                }
            }
        })
    } else {
        step = [
            '5',
            '6',
            '7'
        ]

        queueeuwe = [{
            title: 'Berhasil !',
            text: 'Anda berhasil mengklaim akun ' + localStorage.getItem('klaimEmail') + ', langkah selanjutnya adalah menambahkan password untuk akun ini',
            type: 'success'
        }, {
            title: 'Password',
            input: 'password',
            inputPlaceholder: 'Masukkan password',
            inputValidator: (val) => {
                return new Promise((resolve) => {
                    if (val == '') {
                        resolve('Password wajib di isi')
                    } else {
                        resolve()
                    }
                })
            }
        }, {
            title: 'Re-Password',
            input: 'password',
            inputPlaceholder: 'Ketik ulang password',
            inputValidator: (val) => {
                return new Promise((resolve) => {
                    if (val == '') {
                        resolve('Password wajib di isi')
                    } else {
                        resolve()
                    }
                })
            }
        }]
        return Swal.mixin({
            allowOutsideClick: false,
            progressSteps: step,
            confirmButtonText: 'Selanjutnya',
            showCancelButton: false
        }).queue(
            queueeuwe
        )
    }

}

function storePass(res) {
    var pass = ''

    if (res.value.length == 2) {
        if (res.value[0].length < 8 && res.value[1].length < 8) {
            return a('Gagal !', 'Password terlalu sedikit, coba tambahkan beberapa karakter !', 'error').then(() => {
                klaimPassword('ulang')
            });
        }

        pass = res.value[0]
    } else {
        if (res.value[1].length < 8 && res.value[2].length < 8) {
            return a('Gagal !', 'Password terlalu sedikit, coba tambahkan beberapa karakter !', 'error').then(() => {
                klaimPassword('ulang')
            });
        }
        pass = res.value[1]
    }

    Swal.fire({
        allowOutsideClick: false,
        title: 'Tunggu sebentar ...',
        text: 'Semuanya sedang diperoses, silahkan tunggu beberapa saat.',
        onBeforeOpen: () => {
            Swal.showLoading()

            $.ajax({
                url: apis + 'masuk/klaim/storePass',
                method: 'POST',
                data: {
                    email: localStorage.getItem('klaimEmail'),
                    kode: localStorage.getItem('klaimKode'),
                    pass: pass,
                },
                success: function (data) {
                    if (data == 'y') {
                        a('Berhasil !', 'Anda berhasil mengklaim akun anda dengan password yang anda masukkan tadi. Selamat datang :->');
                    } else {
                        Swal.fire({
                            title: 'Gagal ! :-<',
                            text: 'Sepertinya ada yang salah pak, silahkan coba lagi !',
                            type: 'error',
                            confirmButtonText: 'Coba lagi'
                        }).then(() => {
                            $('#klaim').click()
                        })
                    }
                }
            });
        }
    });
}
