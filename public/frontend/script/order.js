$(document).ready(function () {

    $('body').on('click', '#orderdetails', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        $('#product').html('');
        $('#product').html('');
        $('#detailOrder').modal('show');
        $.get(url, function (data) {
            $.each(data, function (index, value) {
                $('#invoice').html(`No Invoice #` + value.order.invoice + ``)
                $('#product').append(`
                <span> <b> ` + value.products.product_name + ` </b> x ` + value.quantity + ` </span> <br>
            `);
                $('#total').html(`` + value.order.total + ``)
                $('#recipient').html(`
                <h6 class="offset-1">Name &nbsp &nbsp &nbsp : ` + value.order.first_name + ` ` + value.order.last_name + `</h6>  <br>
                <h6 class="offset-1">Address    &nbsp  : ` + value.order.street + `, ` + value.order.city + ` ` + value.order.postcode + ` </h6>  <br>
                <h6 class="offset-1">Email &nbsp &nbsp &nbsp &nbsp: ` + value.order.email + `</h6>  <br>
                <h6 class="offset-1">Phone &nbsp &nbsp &nbsp : ` + value.order.phone + `</h6>  <br>
            `);
            })
        })
    })
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('click', '#cancel', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        swal({
                title: "Are you sure?",
                text: "Once canceled, you will not be able to make payments on this order!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "post",
                        url: url,
                        dataType: "json",
                        success: function (response) {
                            swal("Your order has been successfully cancelled!", {
                                icon: "success",
                            }).then((success) => {
                                if (success) {
                                    window.location.reload();
                                }
                            });
                        }
                    });
                }
            });
    })

    $('#pendingPay').submit(function (e) {
        e.preventDefault();
        var order_id = $('#orderId').val();
        $.ajax({
            type: "POST",
            url: "order/pendingPay",
            data: {
                order_id: order_id
            },
            dataType: "json",
            success: function (response) {
                if (response.redirect == true) {
                    swal("Your order has been paid!", {
                        icon: "warning",
                    }).then((success) => {
                        if (success) {
                            window.location.reload();
                        }
                    });
                }
                snap.pay(response.snapToken, {
                    onSuccess: function (result) {
                        $.ajax({
                            type: "POST",
                            url: "/order/pendingUpdate/",
                            data: {
                                order_id: order_id
                            },
                            dataType: "json",
                            success: function (response) {
                                swal("Your order has been successfully paid!", {
                                    icon: "success",
                                }).then((success) => {
                                    if (success) {
                                        window.location.reload();
                                    }
                                });
                            }
                        });
                        document.getElementById('result-json').innerHTML += JSON
                            .stringify(result, null, 2);
                    },
                    onPending: function (result) {
                        console.log(result);
                        document.getElementById('result-json').innerHTML += JSON
                            .stringify(result, null, 2);
                    },
                    onError: function (result) {
                        document.getElementById('result-json').innerHTML += JSON
                            .stringify(result, null, 2);
                    }
                });
            }
        });
    })
});
