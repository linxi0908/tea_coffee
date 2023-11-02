<!-- LOGIN AREA START -->
<div class="ltn__login-area pb-65">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Đăng nhập <br>Vào tài khoản của bạn</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="account-login-inner">
                    <form action="{{ route('login') }}" method="POST" class="ltn__form-box contact-form-box">
                        @csrf
                        <input type="text" name="email" placeholder="Email*" value="{{ old('email') }}" required autofocus autocomplete="username">
                        <input type="password" name="password" required autocomplete="current-password" placeholder="Mật khẩu*">
                        @if($errors->any())
                        <span class="error-message" style="color:red;" >Đã xảy ra lỗi. Vui lòng kiểm tra thông tin đăng nhập.</span>
                        @endif
                        <div class="btn-wrapper mt-0">
                            <button class="theme-btn-1 btn btn-block" type="submit">ĐĂNG NHẬP</button>
                        </div>
                        <div class="btn-wrapper ">
                            <button class="theme-btn-1 btn btn-block"><a href="{{ route('google.redirect') }}">
                                ĐĂNG NHẬP BẰNG GOOGLE
                            </a></button>
                        </div>

                        <div class="go-to-btn mt-20">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"><small>QUÊN MẬT KHẨU?</small></a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="account-create text-center pt-50">
                    <h4>KHÔNG CÓ TÀI KHOẢN?</h4>
                    <p>Thêm các mục vào danh sách mong muốn của bạn nhận các đề xuất được cá nhân hóa<br>
                        kiểm tra nhanh hơn theo dõi đơn hàng của bạn đăng ký</p>
                    <div class="btn-wrapper">
                        <a href="{{ route('register') }}" class="theme-btn-1 btn black-btn">TẠO TÀI KHOẢN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- LOGIN AREA END -->
