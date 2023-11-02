@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        @include('admin.pages.invoice.content_header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Lập hóa đơn</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (session('message'))
                                    <div class="col-sm-12 alert alert-danger">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <form role="form" method="post" action="{{ route('admin.place_order') }}" >
                                    <div class="col-md-12 mb-2">
                                        <div class="input-item input-item-phone">
                                            <strong>Số điện thoại KH:</strong>
                                            <br>
                                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại">
                                        </div>
                                        @error('phone')
                                            <div class="error-message" style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="input-item input-item-name ">
                                            <strong>Tên: </strong><br><input type="text" name="name" value="{{ old('name') }}" placeholder="Tên" disabled>
                                        </div>
                                        @error('name')
                                            <div class="error-message" style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-2 input-item input-item-textarea">
                                        <strong> Ghi chú: </strong>
                                        <textarea style="width:100%" name="note" placeholder="Ghi chú "></textarea>
                                    </div>

                                    <div class="ltn__checkout-payment-method mt-50">
                                        <strong>Phương thức thanh toán:</strong>
                                        <div id="checkout_accordion_1">
                                            <!-- card -->
                                            <div >
                                                <div>
                                                        <input name="payment_provider" type="radio" id="payment" value="cash">
                                                        <span class="checkmark"></span>
                                                        Tiền mặt
                                                </div>
                                                <div>
                                                        <input name="payment_provider" type="radio" id="bank" value="bank">
                                                        <span class="checkmark"></span>
                                                        Chuyển khoản
                                                </div>
                                                @error('payment_provider')
                                                <div class="error-message" style="color:red;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <a class="btn btn-primary" href="{{ route('admin.invoices.create') }}"> Quay lại chọn món</a>
                                    <button type="submit" class="btn btn-outline-primary float-right">Tạo đơn</button>
                                    @csrf
                                </form>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-7">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Lập hóa đơn</h3>
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
                                                    <th class="cart-product-remove" >STT</th>
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
                                                            class="icon_close" style="cursor: pointer;">{{ $loop->iteration }}</span>
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
 </script>

@endsection
