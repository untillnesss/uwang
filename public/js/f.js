

function a(title = null, desc = null, type = 'success'){
    return Swal.fire({
        title: title,
        text: desc,
        type: type
    });
}
