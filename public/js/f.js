var _token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': _token
    }
});


function a(title = null, desc = null, type = 'success'){
    return Swal.fire({
        title: title,
        text: desc,
        type: type
    });
}

function np(type = 'start'){
    if(type == 'start'){
        NProgress.start();
    }else{
        NProgress.done();
    }
}

function direct(url){
    window.location.href = url
}
