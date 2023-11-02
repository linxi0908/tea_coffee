<div class="liton__shoping-cart-area mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping-cart-inner">
                    <div class="shoping-cart-table table-responsive">
                        <table class="table text-center justify-content-center">
                            <thead>
                                <th class="cart-product-remove" >x</th>
                                <th class="cart-product-image" >Hình</th>
                                <th class="cart-product-info"  >Sản phẩm</th>
                                <th class="cart-product-price" >Giá</th>
                                <th class="cart-product-quantity" >Số lượng</th>
                                <th class="cart-product-subtotal">Tổng</th>
                            </thead>
                            <tbody id="table-cart" >
                                @php $total = 0 @endphp
                                @foreach ($cart as $productId => $item)
                                @php $total += $item['qty'] * $item['price'] @endphp
                                <tr id="{{ $productId }}">
                                    <td class="cart-product-remove">
                                    <span data-id="{{ $productId }}"
                                    data-url="{{ route('delete_item_in_cart', ['productId' => $productId]) }}"
                                    class="icon_close"></span>
                                    </td>
                                    <td class="cart-product-image">
                                        <a href="#"><img style="width:600px;" src="{{ $item['image'] ?? '' }}" alt="{{ $item['name'] }}"></a>
                                    </td>
                                    <td class="cart-product-info" >
                                        <h6><a href="#">{{ $item['name'] }}</a></h6>
                                    </td>
                                    <td class="cart-product-price" >{{ number_format($item['price'],0) }}</td>
                                    <td class="cart-product-quantity" >
                                        <div class="cart-plus-minus"
                                        data-price="{{ $item['price'] }}"
                                        data-url="{{ route('update_item_in_cart', ['productId' => $productId]) }}"
                                        data-id="{{ $productId }}"
                                        >
                                            <input type="text" value="{{ $item['qty'] }}" name="qtybutton" class="cart-plus-minus-box" disabled>
                                        </div>
                                    </td>
                                    <td class="cart-product-subtotal" >{{ number_format($item['qty'] * $item['price'], 0) }}</td>
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
                                        <a href="{{ route('products') }}">Tiếp tục mua</a>
                                    </button>
                                </div>
                                <div style="margin-right: 0 !important;">
                                    @if($cart != null)
                                    <button type="submit" class="btn theme-btn-2 btn-effect-2-- disabled delete-cart">Xóa sản phẩm</button>
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
                                    <td>Tổng cộng</td>
                                    <td><span id="cart-subtotal">{{ number_format($total, 0) }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Tổng đơn hàng</strong></td>
                                    <td><strong><span id="cart-total">{{ number_format($total, 0) }}</span></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="btn-wrapper text-right">
                            <a href="{{ route('checkout.index') }}" class="theme-btn-1 btn btn-effect-1">Tiến hành thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
