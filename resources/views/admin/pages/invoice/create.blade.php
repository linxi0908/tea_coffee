@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        @include('admin.pages.invoice.content_header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Lập hóa đơn</h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary" href="{{ route('admin.invoice.checkout') }}"> Tiến hành tạo đơn</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                    <div class="text-uppercase text-center mt-2">
                                        <ul class="nav nav-pills" >
                                            @foreach ($productCategories as $key => $productCategory)
                                            <li class="nav-item">
                                                <a class="nav-link {{ $key === 0 ? 'active show' : '' }}" data-toggle="tab" href="#liton_tab_3_{{ $key + 1 }}">{{ $productCategory->name }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        @foreach ($productCategories as $key => $productCategory)
                                            <div class="tab-pane fade {{ $key === 0 ? 'active show' : '' }}" id="liton_tab_3_{{ $key + 1 }}">
                                                <div class="ltn__product-tab-content-inner">
                                                    <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                                        @foreach ($productCategory->products as $product)
                                                            <div class="col-lg-6" style="display:flex; padding:20px;">
                                                                <div class="text-center" style="border:1px solid #666; border-radius:5%; padding:10px">
                                                                    <div class="product-img">
                                                                        @php
                                                                            $imagesLink = is_null($product->image) || !file_exists('images/products/' . $product->image) ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg' : asset('images/products/' . $product->image);
                                                                        @endphp
                                                                            <img style="width:100%" src="{{ $imagesLink }}" alt="{{ $product->name }}">

                                                                    </div>
                                                                    <div class="product-info">
                                                                        <p class="product-title">{{ $product->name }}</p>
                                                                        <div class="product-price">
                                                                            <span style=" padding-bottom:10px; color:blue">{{ number_format($product->price,0) }} VNĐ</span>
                                                                        </div>
                                                                            <button style="border-radius:5%;" class="btn btn-primary">
                                                                                <a style=" color :#fff" class="add-to-cart" data-url="{{ route('admin.add_to_cart', ['productId' => $product->id]) }}"
                                                                                href="#" title="Add to Cart" data-toggle="modal"
                                                                                data-target="#add_to_cart_modal" data-product="{{ json_encode($product) }}">
                                                                                CHỌN
                                                                            </a></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Sản phẩm</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <section class="content">
                                <div class="container-fluid">
                                  <div class="row">
                                    <div class="col-12">

                                      <!-- Main content -->
                                      <div class="invoice p-3 mb-3">
                                        <div class="row">
                                          <div class="col-12 table-responsive">
                                            <table id="cart-table" class="table table-striped text-center justify-content-center">
                                                <thead>
                                                <tr>
                                                    <th class="cart-product-remove" >x</th>
                                                    <th class="cart-product-quantity" >Số lượng</th>
                                                    <th class="cart-product-info"  >Sản phẩm</th>
                                                    <th class="cart-product-price" >Giá</th>
                                                    <th class="cart-product-subtotal">Tổng</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @php $total = 0 @endphp
                                                    @foreach ($cart as $productId => $item)
                                                    @php $total += $item['qty'] * $item['price'] @endphp
                                                    <tr id="{{ $productId }}">
                                                        <td class="cart-product-remove">
                                                            <span data-id="{{ $productId }}"
                                                            data-url="{{ route('admin.delete_item_in_cart', ['productId' => $productId]) }}"
                                                            class="icon_close" style="cursor: pointer;">x</span>
                                                            </td>
                                                        <td class="cart-product-quantity">{{ $item['qty'] }}</td>
                                                        <td class="cart-product-info" >
                                                            <h6>{{ $item['name'] }}</h6>
                                                        </td>
                                                        <td class="cart-product-price" >{{ number_format($item['price'],0) }}</td>
                                                        <td class="cart-product-subtotal">{{ number_format($item['qty'] * $item['price'], 0) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                          </div>
                                          <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                          <div class="col-6">
                                          </div>
                                          <!-- /.col -->
                                          <div class="col-6">
                                            <div class="table-responsive">
                                              <table class="table">
                                                <tr>
                                                  <th style="width:50%">Tổng:</th>
                                                  <td><span id="cart-subtotal">{{ number_format($total, 0) }}</span></td>
                                                </tr>
                                              </table>
                                            </div>
                                          </div>
                                          <!-- /.col -->
                                        </div>
                                        <div class="row">
                                            <div style="margin-right: 0 !important;">
                                                <button type="submit" class="btn btn-outline-primary  delete-cart">Xóa sản phẩm</button>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                      </div>
                                      <!-- /.invoice -->
                                    </div><!-- /.col -->
                                  </div>
                                  <!-- /.row -->
                                </div><!-- /.container-fluid -->
                            </section>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


@section('js-custom')
 <script>
    $(document).ready(function() {
        $('.add-to-cart').on('click', function(event) {
            event.preventDefault();
            var url = $(this).data('url');
            $.ajax({
                method: 'get',
                url: url,
                success: function(response) {
                    reloadView(response);
                },
            });
        });

        $('#cart-table tbody').on('click', '.icon_close', function() {
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
                    $('tr#' + id).remove();
                    $('#cart-subtotal').html(formatNumber(response.total_price));
                    $('#cart-total').html(formatNumber(response.total_price));
                }
            });
        });

        $('.delete-cart').on('click', function(event) {
                event.preventDefault();
                $.ajax({
                    method: 'get',
                    url: '{{ route('admin.delete_cart') }}',
                    success: function(response) {

                        $('#cart-table tbody').empty();
                        $('#cart-subtotal').html(formatNumber(response.total_price));
                        $('#cart-total').html(formatNumber(response.total_price));
                    }
            });
        });

        // Lắng nghe sự kiện khi người dùng nhập số điện thoại
        $('input[name="phone"]').on('keyup', function() {
            var phoneNumber = $(this).val();

            // Gửi yêu cầu Ajax để kiểm tra số điện thoại và lấy dữ liệu người dùng
            $.ajax({
                method: 'POST',
                url: '{{ route('admin.get_user_by_phone') }}',
                data: {
                    phone: phoneNumber,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Kiểm tra dữ liệu trả về
                    if (response.success) {
                        // Điền dữ liệu vào các trường tương ứng
                        $('input[name="name"]').val(response.user.name);
                        // Điền dữ liệu khác nếu cần thiết
                    }
                }
            });
        });
    });

    function reloadView(response) {
        $('#cart-subtotal').html(formatNumber(response.total_price));
        $('#cart-total').html(formatNumber(response.total_price));
        var tbody = $('#cart-table tbody');
        tbody.empty();


        Object.entries(response.cart).forEach(function([id, item]) {
            var row = '<tr id="' + id + '">' +
                '<td class="cart-product-remove">' +
                    '<span data-id="' + item.id + '" data-url="' + item.deleteUrl + '" class="icon_close" style="cursor: pointer;">x</span>' +
                    '</td>' +
                    '<td class="cart-product-quantity">' + item.qty + '</td>' +
                    '<td class="cart-product-info">' +
                    '<h6>' + item.name + '</h6>' +
                    '</td>' +
                    '<td class="cart-product-price">' + formatNumber(item.price) + '</td>' +
                    '<td class="cart-product-subtotal">' + formatNumber(item.price * item.qty) + '</td>' +
                    '</tr>';
            tbody.append(row);
        });
    }

    function formatNumber(number) {
        return number.toLocaleString('en-US');
    }
 </script>

@endsection
