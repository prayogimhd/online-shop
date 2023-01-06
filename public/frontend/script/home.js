$(document).ready(function () {
    $('body').on('click', '#details,#buynow', function () {
        var url = $(this).data('url');
        var img = $(this).data('img');
        $.get(url, function (data) {
            $('#detailProduct').modal('show');
            $('#products_img').attr("src", img)
            $('#product_id').val(data.id);
            $('#name').text(data.product_name);
            $('#price').text(data.price);
            $('#descriptions').text(data.product_descriptions);
            $('#weight').text(data.weight);
        })
    });

    var quantitiy = 0;
    $('.quantity-right-plus').click(function (e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        $('#quantity').val(quantity + 1);
    });

    $('.quantity-left-minus').click(function (e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        if (quantity > 0) {
            $('#quantity').val(quantity - 1);
        }
    });
});
