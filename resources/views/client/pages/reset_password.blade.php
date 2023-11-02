<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            @if (session('message'))
                        <div class="col-sm-12 alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Khôi phục mật khẩu <br>Tài khoản của bạn</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="account-login-inner">
                    <form method="POST" action="{{ route('password.store') }}" class="ltn__form-box contact-form-box">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <input type="email" name="email" placeholder="Email*" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" >
                        @error('email')
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
                            <button class="theme-btn-1 btn reverse-color btn-block" type="submit">KHÔI PHỤC MẬT KHẨU</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
