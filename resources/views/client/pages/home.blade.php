@extends('client.layout.master')

@section('header_top')
    @include('client.pages.header_top')
@endsection

@section('slider')
    @include('client.pages.slider')
@endsection

@section('feature')
    @include('client.pages.feature')
@endsection

@section('about')
    @include('client.pages.about')
@endsection

@section('category')
    @include('client.pages.category')
@endsection

@section('products')
    @include('client.pages.products')
@endsection

@section('counter')
    @include('client.pages.counter')
@endsection

@section('featured_product')
    @include('client.pages.featured_product')
@endsection

@section('add_to_cart_model')
    @include('client.pages.add_to_cart_model')
@endsection


@section('js-custom')
<script>
    $(document).ready(function() {


        $('#add_to_cart_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var productData = button.data('product'); // Dữ liệu sản phẩm từ thuộc tính data-product

            var modal = $(this);
            var productImage = modal.find('.modal-product-img img');
            var imagesLink = isNull(productData.image) || !fileExists('images/products/' + productData.image)
            ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
            : 'images/products/' + productData.image;
            productImage.attr('src', imagesLink); // Chỉnh sửa đường dẫn ảnh

            modal.find('.product-name a').text(productData.name);


        });

        $('.add-to-cart').on('click', function(event) {
            event.preventDefault();
            var url = $(this).data('url');
            $.ajax({
                    method: 'get', //method form
                    url: url, //action form
                    success: function(response) {
                        $('#total-items-cart').html(response.total_items);
                        reloadView(response);
                   },
            });
        });

    });

    function isNull(value) {
        return value === null || value === undefined || value === '';
    }

    function fileExists(url) {
        var http = new XMLHttpRequest();
        http.open('HEAD', url, false);
        http.send();
        return http.status !== 404;
    }

    function formatNumber(number) {
    return number.toLocaleString('en-US');
    }

    function reloadView(response) {
        $('#total-items-cart').html(formatNumber(response.total_items));
        $('#cart-subtotal').html(formatNumber(response.total_price));
        $('#cart-total').html(formatNumber(response.total_price));
    }
</script>
@endsection
