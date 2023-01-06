$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#checkout').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "/checkout/payMidtrans",
        data: {
            totals: $('input#totals').val(),
            firstname: $('input#firstname').val(),
            lastname: $('input#lastname').val(),
            state: $('input#state').val(),
            street: $('input#street').val(),
            detailstreet: $('input#detailstreet').val(),
            city: $('input#city').val(),
            postcode: $('input#postcode').val(),
            postcode: $('input#postcode').val(),
            phone: $('input#phone').val(),
            email: $('input#email').val(),
        },
        dataType: "json",
        success: function(response) {
            snap.pay(response.snapToken, {
                onSuccess: function(result) {
                    let dataResult = JSON.stringify(result, null, 2);
                    let dataObj = JSON.parse(dataResult);
                    $.ajax({
                        type: "post",
                        url: "/checkout",
                        data: {
                            invoice: dataObj.order_id,
                            transaction_status: dataObj.transaction_status,
                            snap_token: response.snapToken,
                            totals: $('input#totals').val(),
                            first_name: $('input#firstname').val(),
                            last_name: $('input#lastname').val(),
                            state: $('input#state').val(),
                            street: $('input#street').val(),
                            detailstreet: $('input#detailstreet').val(),
                            city: $('input#city').val(),
                            postcode: $('input#postcode').val(),
                            phone: $('input#phone').val(),
                            email: $('input#email').val(),
                        },
                        dataType: "json",
                        success: function(response) {
                            swal("Your order has been successfully paid!", {
                                icon: "success",
                            }).then((success) => {
                                if (success) {
                                    window.location.href = "/order";
                                }
                            });
                        }
                    });
                    document.getElementById('result-json').innerHTML += JSON
                        .stringify(result, null, 2);
                },
                onPending: function(result) {
                    let dataResult = JSON.stringify(result, null, 2);
                    let dataObj = JSON.parse(dataResult);
                    $.ajax({
                        type: "post",
                        url: "/checkout",
                        data: {
                            invoice: dataObj.order_id,
                            transaction_status: dataObj.transaction_status,
                            snap_token: response.snapToken,
                            totals: $('input#totals').val(),
                            first_name: $('input#firstname').val(),
                            last_name: $('input#lastname').val(),
                            state: $('input#state').val(),
                            street: $('input#street').val(),
                            detailstreet: $('input#detailstreet').val(),
                            city: $('input#city').val(),
                            postcode: $('input#postcode').val(),
                            phone: $('input#phone').val(),
                            email: $('input#email').val(),
                        },
                        dataType: "json",
                        success: function(response) {
                            window.location.href = "/order";
                        }
                    });
                    document.getElementById('result-json').innerHTML += JSON
                        .stringify(result, null, 2);
                },
                onError: function(result) {
                    document.getElementById('result-json').innerHTML += JSON
                        .stringify(result, null, 2);
                }
            });
        }
    });
})
