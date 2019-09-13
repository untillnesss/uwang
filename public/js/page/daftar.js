$("#daftar").on("click", function () {
    var data = {
        nama: $("#nama").val(),
        email: $("#email").val(),
        pass: $("#pass").val(),
        rePass: $("#rePass").val(),
        org: $("#org").val()
    };

    var lewat = 0;

    $.each(data, function (i, d) {
        if (d != "") {
            lewat++;
            if (lewat == 5 && i == "org") {
                // VAL EMAIL
                if (valEmail(data.email)) {
                    if (data.pass == data.rePass) {
                        return $.ajax({
                            method: "POST",
                            data: data,
                            url: "/daftar",
                            beforeSend: function () {
                                np();
                            },
                            success: function (d) {
                                if (d == "admin") {
                                    Swal.fire({
                                        title: "Berhasil !",
                                        text: "Berhasil mendaftar sebagai admin, silahkan masuk untuk melanjutkan",
                                        type: "success",
                                        allowOutsideClick: false
                                    }).then(res => {
                                        if (res.value) {
                                            direct("/masuk");
                                        }
                                    });
                                } else if (d == "x") {
                                    toast({
                                        title: "Email sudah terdaftar, silahkan coba yang lainnya!",
                                        type: "error"
                                    });
                                } else if (d == 'uda') {
                                    Swal.fire({
                                        title: 'Informasi !',
                                        text: 'Email yang anda daftarkan, telah didaftarkan seorang admin menjadi anggotanya. Apakah anda ingin mengklaim akun anda atau tidak .?',
                                        type: 'info',
                                        showCancelButton: true,
                                        confirmButtonText: 'KLAIM',
                                        cancelButtonText: 'TOLAK',
                                        cancelButtonColor: 'crimson',
                                        allowOutsideClick: false
                                    }).then((res) => {
                                        if (res.value == true) {
                                            window.location.href = '/masuk/klaim'
                                        } else {
                                            $.ajax({
                                                url: apis + 'masuk/klaim/tolak',
                                                method: 'POST',
                                                data: {
                                                    email: $('#email').val()
                                                },
                                                beforeSend: function () {
                                                    np()
                                                },
                                                success: function () {
                                                    a('Berhasil !', 'Akun bisa berhasil ditolak, anda akan mendaftar sebagai admin');
                                                    np('done')
                                                }
                                            });
                                        }
                                    })
                                }
                                np("done");
                            }
                        });
                    } else {
                        toast({
                            title: "Password tidak sama",
                            type: "error"
                        });
                    }
                }
            }
        } else {
            return toast({
                title: "Harap semua field di isi semuanya!",
                type: "error"
            });
        }
    });
});
