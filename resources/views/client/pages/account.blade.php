<div class="liton__wishlist-area pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- PRODUCT TAB AREA START -->
                <div class="ltn__product-tab-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="ltn__tab-menu-list mb-50">
                                    <div class="nav">
                                        <a class="active show" data-toggle="tab" href="#liton_tab_1_1">Bảng điều khiển <i class="fas fa-home"></i></a>
                                        <a data-toggle="tab" href="#liton_tab_1_2">Đơn hàng <i class="fas fa-file-alt"></i></a>
                                        <a data-toggle="tab" href="#liton_tab_1_3">Chi tiết tài khoản <i class="fas fa-user"></i></a>
                                        <form action="{{ route('logout') }}" method="POST" id="logout-form" >
                                            @csrf
                                            <button class="logout-link" type="submit" style="font-weight:400; color:black;background:none; padding:15px 20px;">Đăng xuất<i class="fas fa-sign-out-alt" style="position:absolute;right:65px;"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="liton_tab_1_1">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div style="padding: 20px; background-color: var(--section-bg-1);">
                                                Xin chào <strong style="display: inline-block;">{{ Auth::user()->name ?? '' }}</strong>( not <strong style="display: inline-block;">{{ Auth::user()->name ?? '' }} </strong> ?
                                                <small>
                                                    <form action="{{ route('logout') }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        <button type="submit" style="font-weight:400; color:black;background:none;">Đăng xuất</button>
                                                        </form>
                                                </small>)
                                            </div>
                                            <div style="padding-top: 25px;">

                                            </div>
                                            <p>Bổ sung chi tiết tài khoản để hỗ trợ khi đặt hàng.</p>
                                            @php
                                                $rank = $user->calculateTotalAmount();
                                                if(Auth::user()->role_id === 2){
                                                    if($rank >= 1000000){
                                                    // $rankName = 'VIP';
                                                    echo "<p>Hạng: <strong>VIP</strong></p>";
                                                }
                                                elseif ($rank < 1000000) {
                                                    // $rankName = 'Thành viên';
                                                    echo "<p>Hạng: <strong>Thành viên</strong></p>";
                                                }
                                                }else{
                                                    "";
                                                }

                                            @endphp

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="liton_tab_1_2">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>STT</th>
                                                            <th>Ngày</th>
                                                            <th>Trạng thái</th>
                                                            <th>Tổng</th>
                                                            <th>Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orders as $order)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ ($order->created_at)->format('d/m/Y') }}</td>
                                                            <td>{{ $order->status }}</td>
                                                            <td>{{ number_format($order->total,0) }}</td>
                                                            <td><a href="{{ route('order_detail',['orderId' => $order->id]) }}">Xem</a></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="liton_tab_1_3">
                                        @php
                                            if(session('message')) {
                                                echo "
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        Swal.fire({
                                                            icon: 'success',
                                                            text: '".session('message')."',
                                                            didOpen: () => {
                                                                $('.nice-select').css('display', 'none'); // Ẩn phần tử .nice-select
                                                            }
                                                        });
                                                    });
                                                </script>";
                                            }
                                        @endphp
                                        <div class="ltn__myaccount-tab-content-inner">

                                            <div class="ltn__form-box">
                                                <form action="{{ route('profile.update') }}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="row mb-20">
                                                        <div class="col-md-12">
                                                            <label>Tên:</label>
                                                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                                            required autofocus autocomplete="name">
                                                            @error('name')
                                                                <div class="error-message" style="color:red;">{{ $message }}</div>
                                                            @enderror
                                                            <label>Email:</label>
                                                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                                            required autofocus autocomplete="email">
                                                            @error('email')
                                                                <div class="error-message" style="color:red;">{{ $message }}</div>
                                                            @enderror
                                                            <label>Số điện thoại:</label>
                                                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                                            required autofocus autocomplete="phone">
                                                            @error('phone')
                                                                <div class="error-message" style="color:red;">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="btn-wrapper">
                                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">Lưu</button>
                                                    </div>
                                                </form>
                                                <form method="post" action="{{ route('password.update') }}">
                                                    @csrf
                                                    @method('put')
                                                    <fieldset style="margin-top: 20px">
                                                        <legend>Đổi mật khẩu</legend>
                                                        <div class="row mb-20 ">
                                                            <div class="col-md-12">
                                                                <label>Mật khẩu hiện tại (để trống để không thay đổi):</label>
                                                                <input name="current_password" type="password" autocomplete="current-password">
                                                                @error('current_password')
                                                                <div class="error-message" style="color:red;">{{ $message }}</div>
                                                                @enderror
                                                                <label>Mật khẩu mới (để trống để không thay đổi):</label>
                                                                <input type="password" name="password" type="password" autocomplete="new-password">
                                                                @error('password')
                                                                <div class="error-message" style="color:red;">{{ $message }}</div>
                                                                @enderror
                                                                <label>Xác nhận mật khẩu:</label>
                                                                <input name="password_confirmation" type="password" autocomplete="new-password" >
                                                                @error('password_confirmation')
                                                                <div class="error-message" style="color:red;">{{ $message }}</div>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="btn-wrapper">
                                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">Lưu</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCT TAB AREA END -->
            </div>
        </div>
    </div>
</div>
