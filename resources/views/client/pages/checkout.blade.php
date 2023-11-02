<div class="ltn__checkout-area mb-105">
    <div class="container">
        <form method="post" action="{{ route('place_order') }}">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__checkout-inner">
                    <div class="ltn__checkout-single-content mt-50">
                        @if (session('message'))
                        <div class="col-sm-12 alert alert-danger">
                            {{ session('message') }}
                        </div>
                        @endif
                        <h4 class="title-2">Chi tiết thanh toán</h4>
                        <div class="ltn__checkout-single-content-info">
                            <h6>Thông tin cá nhân</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-item-name ltn__custom-icon">
                                            <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Tên">
                                        </div>
                                        @error('name')
                                            <div class="error-message" style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-email ltn__custom-icon">
                                            <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Email" disabled>
                                        </div>
                                        @error('email')
                                            <div class="error-message" style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-phone ltn__custom-icon">
                                            <input type="text" name="phone" value="{{ Auth::user()->phone }}" placeholder="Số điện thoại">
                                        </div>
                                        @error('phone')
                                            <div class="error-message" style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-address ltn__custom-icon">
                                            <input type="text" name="city" value="Thành phố Hồ Chí Minh" placeholder="Số điện thoại" disabled>
                                        </div>
                                        @error('city')
                                            <div class="error-message" style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-item-textarea  ltn__custom-icon">
                                              <input type="text" name="district" value="{{ old('district') }}" placeholder="Quận, Huyện" >
                                        </div>
                                        @error('district')
                                            <div class="error-message" style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-textarea ltn__custom-icon">
                                            <input type="text" name="address" value="{{ old('address') }}" placeholder="Số nhà, đường, phường">
                                        </div>
                                        @error('address')
                                            <div class="error-message" style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-auto">


                                      </div>
                                </div>
                                <h6>Ghi chú đặt hàng (không bắt buộc)</h6>
                                <div class="input-item input-item-textarea ltn__custom-icon">
                                    <textarea name="note" placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: ghi chú đặc biệt để giao hàng."></textarea>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ltn__checkout-payment-method mt-50">
                    <h4 class="title-2">Phương thức thanh toán</h4>
                    <div id="checkout_accordion_1">
                        <!-- card -->
                        <div class="card">
                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    <input name="payment_provider" type="radio" id="payment" value="cod">
                                    <span class="checkmark"></span>
                                    Thanh toán khi nhận hàng
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    <input name="payment_provider" type="radio" id="vnpay" value="vnpay">
                                    <span class="checkmark"></span>
                                    VN Pay
                                </label>
                            </div>
                            @error('payment_provider')
                            <div class="error-message" style="color:red;">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping-cart-total mt-50">
                    <h4 class="title-2">Tổng giỏ hàng</h4>
                    <table class="table">
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach ($cart as $productId => $item)
                            @php $total += $item['qty'] * $item['price']; @endphp
                            <tr>
                                <td>{{ $item['name'] }} <strong>× {{ $item['qty'] }}</strong></td>
                                <td>{{ number_format($item['qty'] * $item['price'],0) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td><strong>Tổng</strong></td>
                                <td><strong>{{ number_format($total, 0) }}</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Tổng đơn hàng</strong></td>
                                <td><strong>{{ number_format($total, 0) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <button style="margin: 20px" class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Đặt hàng</button>
        </div>
    </form>
    </div>
</div>
