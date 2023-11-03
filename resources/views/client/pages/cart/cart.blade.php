@extends('client.layout.master')

@section('page_header')
@include('client.pages.cart.page_header')
@endsection

@section('cart')
@include('client.pages.cart')
@endsection


@section('js-custom')
<script>
    $(document).ready(function() {
        $('.icon_close').on('click', function() {
                var url = $(this).data('url');
                var id = $(this).data('id');
                $.ajax({
                    method: 'get',
                    url: url,
                    data: {
                        'name': '1',
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                        });
                        $('tr#' + id).empty();
                        reloadView(response);
                    }
            });
        });

        $('.delete-cart').on('click', function(event) {
                event.preventDefault();
                $.ajax({
                    method: 'get',
                    url: '{{ route('delete_cart') }}',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                        });

                        $('#table-cart').empty();
                        $('#total-items-cart').html(formatNumber(response.total_items));
                        $('#cart-subtotal').html(formatNumber(response.total_price));
                        $('#cart-total').html(formatNumber(response.total_price));
                        $('.delete-cart').remove();
                    }
            });
        });

        $('.qtybutton').on('click', function() {
            var button = $(this);
            var id = button.parent().data('id');
            var qtyInput = button.siblings('.cart-plus-minus-box');
            var qty = parseInt(qtyInput.val());
            var url = button.parent().data('url');
            var price = parseFloat(button.parent().data('price'));

            if (button.hasClass('inc')) {
                qty + 1;
            } else {
                (qty < 0) ? 0 : (qty - 1);
            }

            qtyInput.val(qty);

            var totalPrice = price * qty;

            url += '/' + qty;
            // console.log(url),
            $.ajax({
                method: 'GET',
                url: url,

                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        text: response.message,
                    });
                    if (qty === 0) {
                        $('tr#' + id).empty();
                    }

                    $('tr#' + id + ' .cart-product-subtotal').html(formatNumber(totalPrice));
                    reloadView(response);
                }
            });
        });

    });
    function reloadView(response) {
        $('#total-items-cart').html(formatNumber(response.total_items));
        $('#cart-subtotal').html(formatNumber(response.total_price));
        $('#cart-total').html(formatNumber(response.total_price));
    }
    function formatNumber(number) {
    return number.toLocaleString('en-US');
    }


</script>
@endsection

