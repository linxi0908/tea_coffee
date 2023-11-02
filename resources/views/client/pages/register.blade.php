<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Đăng ký <br>Tài khoản của bạn</h1>
                    {{-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. <br>
                         Sit aliquid,  Non distinctio vel iste.</p> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="account-login-inner">
                    <form method="POST" action="{{ route('register') }}" class="ltn__form-box contact-form-box">
                        @csrf
                        <input type="text" name="name" placeholder="Tên" value="{{ old('name') }}" required autofocus autocomplete="name">
                        @error('name')
                            <div class="error-message" style="color:red;">{{ $message }}</div>
                        @enderror
                        <input type="text" name="email" placeholder="Email*" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <div class="error-message" style="color:red;">{{ $message }}</div>
                        @enderror
                        <input type="text" name="phone" placeholder="Số điện thoại*" value="{{ old('phone') }}" required autocomplete="phone">
                        @error('phone')
                            <div class="error-message" style="color:red;">{{ $message }}</div>
                        @enderror
                        <input type="password" name="password" placeholder="Mật khẩu*"   required autocomplete="new-password">
                        @error('password')
                            <div class="error-message" style="color:red;">{{ $message }}</div>
                        @enderror
                        <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu*" required autocomplete="new-password">
                        @error('password_confirmation')
                            <div class="error-message" style="color:red;">{{ $message }}</div>
                        @enderror
                        <div class="btn-wrapper">
                            <button class="theme-btn-1 btn reverse-color btn-block" type="submit">TẠO TÀI KHOẢN</button>
                        </div>
                    </form>
                    <div class="by-agree text-center">
                        <div class="go-to-btn mt-50">
                            <a href="{{ route('login') }}">ĐÃ CÓ TÀI KHOẢN ?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
