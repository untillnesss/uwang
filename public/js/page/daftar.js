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
                                            np("done");
                                            direct("/masuk");
                                        }
                                    });
                                } else if (d == "x") {
                                    toast({
                                        title: "Email sudah terdaftar, silahkan coba yang lainnya!",
                                        type: "error"
                                    });
                                    np("done");
                                }
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
