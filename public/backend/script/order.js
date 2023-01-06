$(function () {
    $('#orderList').DataTable({
        processing: true,
        serverSide: true,
        ajax: "order",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'invoice',
                name: 'invoice'
            },
            {
                data: 'total',
                name: 'total'
            },
            {
                data: 'transaction_status',
                name: 'transaction_status'
            },
            {
                data: 'order_status',
                name: 'order_status'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'action',
                name: 'action'
            },
        ]
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '#orderAction', function () {
        let order_id = $(this).data('order');
        $.ajax({
            type: "post",
            url: "formOrder",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                order_id: order_id
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    $('.viewmodal').html(response.success).show();
                    $('#modalOrder').modal('show');
                }
            }
        });
    })
});
