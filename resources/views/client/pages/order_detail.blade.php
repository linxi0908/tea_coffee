<div class="liton__shoping-cart-area mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping-cart-inner">
                    @if (session('message'))
                        <div class="col-sm-12 alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="shoping-cart-table table-responsive">
                        <table class="table text-center justify-content-center">
                            <thead>
                                <th class="cart-product-remove" >STT</th>
                                <th class="cart-product-info"  >Sản phẩm</th>
                                <th class="cart-product-price" >Giá</th>
                                <th class="cart-product-quantity" >Số lượng</th>
                                <th class="cart-product-subtotal">Tổng</th>
                            </thead>
                            <tbody id="table-cart" >
                            @foreach ($orderItems as $item)
                            <tr>
                                <td class="cart-product-remove">{{ $loop->iteration }}</td>
                                <td class="cart-product-info">
                                    <h6><a href="#">{{ $item->product_name }}</a></h6>
                                </td>
                                <td class="cart-product-price">{{ number_format($item->product_price, 0) }}</td>
                                <td class="cart-product-quantity">
                                        <input type="text" value="{{ $item->qty }}" name="qtybutton" class="cart-plus-minus-box" disabled>
                                </td>
                                <td class="cart-product-subtotal">{{ number_format($item->qty * $item->product_price, 0) }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-coupon-row">
                                <div>
                                    <button class="btn theme-btn-2 btn-effect-2">
                                        <a href="{{ route('profile.edit') }}">Quay lại</a>
                                    </button>
                                </div>
                                <div>
                                    @if($order->status != "success")
                                    <button class="btn theme-btn-2 btn-effect-2 disabled">
                                        <a href="{{ route('update_order_status',[$order->id]) }}">Xác nhận giao hàng</a>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shoping-cart-total mt-50">
                        <h4>Tổng giỏ hàng</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><strong>Tổng đơn hàng</strong></td>
                                    <td><strong><span id="cart-total">{{ number_format($order->total, 0) }}</span></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
