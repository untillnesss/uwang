$('#masuk').on('click', function () {
    var data = {
        email: $('#email').val(),
        pass: $('#pass').val(),
    }

    var pass = 0

    $.each(data, function (i, d) {
        if (d != '') {
            pass++
            if (i == 'pass' && pass == 2) {
                if (valEmail(data.email)) {
                    $.ajax({
                        url: '/masuk',
                        method: 'POST',
                        data: data,
                        beforeSend: function () {
                            np()
                        },
                        success: function (d) {
                            if (d == 'y') {
                                Swal.fire({
                                    title: 'Berhasil !',
                                    text: 'Berhasil masuk pak, Selamat datang !',
                                    type: 'success',
                                    allowOutsideClick: false
                                }).then((res) => {
                                    if (res.value) {
                                        direct('/')
                                    }
                                })
                            } else if (d == 'x') {
                                np('done')
                                toast({
                                    title: 'Email dan password salah pak !',
                                    type: 'error'
                                })
                            }
                        }
                    })
                }
            }
        } else {
            toast({
                title: 'Semua field harus diisi!',
                type: 'error'
            })
        }
    })
})
