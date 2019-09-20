function getLaporan() {
    $.ajax({
        url: apis + 'dashboard/anggota/getDataLaporan',
        method: 'GET',
        beforeSend: function () {
            np()
        },
        success: function () {
            $('#fieldCardLaporan')
            $('#loading').slideUp(function () {
                console.log('pas')
            })
            np('done')
        }
    })
}


$(() => {
    getLaporan()
})
