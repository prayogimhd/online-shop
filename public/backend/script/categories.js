$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $('#categoriesList').DataTable({
        processing: true,
        serverSide: true,
        ajax: "categories",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'slug',
                name: 'slug'
            },
            {
                data: 'action',
                name: 'action'
            },
        ]
    });
});

$('body').on('click', '#addCategories', function() {
    $.ajax({
        type: "post",
        url: "formCategories",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                $('.viewmodal').html(response.success).show();
                $('#modalCategories').modal('show');
            }
        }
    });
})

$('body').on('click', '#categoriesAction', function() {
    let categories_id = $(this).data('categories');
    $.ajax({
        type: "post",
        url: "formCategories",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            categories_id: categories_id
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                $('.viewmodal').html(response.success).show();
                $('#modalCategories').modal('show');
            }
        }
    });
})


$('body').on('click', '#deleteCategories', function() {
    let categories_id = $(this).data('categories');
    $.ajax({
        type: "post",
        url: "deleteCategories/" + categories_id,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            categories_id: categories_id
        },
        dataType: "json",
        success: function(response) {
            if (response.status == 200) {
                swal(response.message, {
                    icon: "success",
                }).then((success) => {
                    $('#modalCategories').modal('hide');
                    $('#categoriesList').DataTable().ajax.reload();
                });
            } else {
                swal(response.message, {
                    icon: "warning",
                });
            }
        }
    });
})
