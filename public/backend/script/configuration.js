$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function icon(configuration_id) {
    $.ajax({
        type: "post",
        url: "configuration/formIcon",
        data: {
            configuration_id: configuration_id
        },
        dataType: "json",
        success: function (response) {
            if (response.success) {
                $('.viewmodal').html(response.success).show();
                $('#modalupload').modal('show');
            }
        }
    });
}

$(document).on('submit', '#formStore', function (e) {
    $('.invalid-feedback').text('');
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "configuration/formStore",
        data: {
            configuration_id: $('input#configuration_id').val(),
            name: $('input#name').val(),
            description: $('textarea#description').val(),
            address: $('textarea#address').val(),
            email: $('input#email').val(),
            phone: $('input#phone').val(),
            facebook: $('input#facebook').val(),
            instagram: $('input#instagram').val(),
        },
        dataType: "json",
        success: function (response) {
            if (response.status == 200) {
                swal(response.message, {
                    icon: "success",
                }).then((success) => {
                    if (success) {
                        window.location.reload();
                    }
                });
            } else {
                swal(response.message, {
                    icon: "warning",
                });
            }
        },
        error: function (xhr) {
            if (xhr.status == 422) {
                $.each(xhr.responseJSON.errors, function (index, value) {
                    $('.error' + index).text(value[0]);
                    $('#' + index).addClass('is-invalid');
                });
            }
        }
    })
    console.log(data);
})

$(document).ready(function () {

    $('#formIcon').submit(function (e) {
        e.preventDefault();
        let data = new FormData(this);
        let configuration_id = $('#configuration_id').val();
        $.ajax({
            type: "POST",
            url: "configuration/iconStore/" + configuration_id,
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    swal(response.message, {
                        icon: "success",
                    }).then((success) => {
                        if (success) {
                            window.location.reload();
                        }
                    });
                } else {
                    swal(response.message, {
                        icon: "warning",
                    });
                }
            }
        });
    })
});
