$('#daftar').on('click', function () {
    var data ={
        nama: $('#nama').val(),
        email: $('#email').val(),
        pass: $('#pass').val(),
        rePass: $('#rePass').val(),
        org: $('#org').val()
    }

    var lewat = 0;

    $.each(data, function (i, d) {
        if (d != '') {
            lewat++
            if (lewat == 5 && i == 'org') {
                return $.ajax({
                    method: 'POST',
                    data: data,
                    url: '/daftar',
                    beforeSend: function(){
                        np();
                    },
                    success: function(d){
                        if(d == 'y'){
                            np('done')
                            Swal.fire({
                                title: 'Berhasil !',
                                text: 'Berhasil mendaftar, silahkan masuk untuk melanjutkan',
                                type: 'success',
                                allowOutsideClick: false
                            }).then((res)=>{
                                if(res.value){
                                    direct('/masuk')

                                }
                            });
                        }
                    }
                })
            }
        } else {
            return a('Gagal !', 'Semua field harus di isi ya pak !', 'error');
        }
    });
});

$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
    });
});

