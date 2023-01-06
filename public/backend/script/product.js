$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $('#productList').DataTable({
        processing: true,
        serverSide: true,
        ajax: "product",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'categories_id',
                name: 'categories_id'
            },
            {
                data: 'product_name',
                name: 'product_name'
            },
            {
                data: 'product_descriptions',
                name: 'product_descriptions'
            },
            {
                data: 'slug',
                name: 'slug'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: 'weight',
                name: 'weight'
            },
            {
                data: 'thumbnails',
                name: 'thumbnails'
            },
            {
                data: 'action',
                name: 'action'
            },
        ]
    });
});
$('body').on('click', '#addProduct', function() {
    $.ajax({
        type: "post",
        url: "formProduct",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                $('.viewmodal').html(response.success).show();
                $('#modalProduct').modal('show');
            }
        }
    });
})

$('body').on('click', '#productAction', function() {
    let product_id = $(this).data('product');
    $.ajax({
        type: "post",
        url: "formProduct",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            product_id: product_id
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                $('.viewmodal').html(response.success).show();
                $('#modalProduct').modal('show');
            }
        }
    });
})
$('body').on('click', '#deleteProduct', function() {
    let product_id = $(this).data('product');
    swal({
        title: "Are you sure?",
        text: "Once canceled, you will repeat back to make it!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "post",
                url: "deleteProduct/" + product_id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: product_id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {
                        swal(response.message, {
                            icon: "success",
                        }).then((success) => {
                            $('#modalProduct').modal('hide');
                            $('#productList').DataTable().ajax.reload();
                        });
                    } else {
                        swal(response.message, {
                            icon: "warning",
                        });
                    }
                }
            });
        }
    });
})

