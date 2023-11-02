<div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
    <div class="ltn__utilize-menu-inner ltn__scrollbar">
        <div class="ltn__utilize-menu-head">
            <div class="site-logo">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/client/img/logo.png') }}" alt="Logo"></a>
            </div>
            <button class="ltn__utilize-close">×</button>
        </div>
        <div class="ltn__utilize-menu">
            <ul>
                <li ><a href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li ><a href="{{ route('about') }}">Giới thiệu</a>
                </li>
                <li ><a href="{{ route('products') }}">Thực đơn</a>
                </li>
                <li><a href="{{ route('contact') }}">Liên hệ</a></li>
            </ul>
        </div>
        <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
            <ul>
                <li>
                    <a href="{{ route('profile.edit') }}" title="My Account">
                        <span class="utilize-btn-icon">
                            <i class="far fa-user"></i>
                        </span>
                        Tài khoản của tôi
                    </a>
                </li>
                <li>
                    <a href="{{ route('cart.index') }}" title="Shoping Cart">
                        <span class="utilize-btn-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <span id="total-items-cart">{{ count(session()->get('cart', [])) }}</span>
                        </span>
                        Giỏ hàng
                    </a>
                </li>
            </ul>
        </div>
        <div class="ltn__social-media-2">
            <ul>
                @foreach ($informations as $information)
                <li><a href="{{ $information->fanpage }}" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
