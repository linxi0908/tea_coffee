<header class="ltn__header-area ltn__header-5 ltn__header-transparent-- gradient-color-4---">
    <!-- ltn__header-top-area start -->
    @yield('header_top')
    <!-- ltn__header-top-area end -->

    <!-- ltn__header-middle-area start -->
    <div class="ltn__header-middle-area ltn__header-sticky ltn__sticky-bg-white plr--9---">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="site-logo-wrap">
                        <div class="site-logo">
                            <a href="{{ route('home') }}">
                                <img style="width:200px;" src =" {{ asset('assets/client/img/logo.png') }}" alt="Logo">
                            </a>
                        </div>
                    </div>
                </div>
                <div class=" header-menu-column menu-color-white---">
                    <div class="header-menu d-none d-xl-block">
                        <nav>
                            <div class="ltn__main-menu">
                                <ul>
                                    <li class="{{ request()->route()->getName() === 'home' ? 'active': '' }}" >
                                        <a href="{{ route('home') }}">Trang chủ</a>
                                    </li>
                                    <li class="{{ request()->route()->getName() === 'about' ? 'active': '' }}" >
                                        <a href="{{ route('about') }}" >Giới thiệu</a>
                                    </li>
                                    <li class="{{ request()->route()->getName() === 'products' ? 'active': '' }}">
                                        <a href="{{ route('products') }}" >Thực đơn</a>
                                    </li>
                                    <li class="{{ request()->route()->getName() === 'contact' ? 'active': '' }}">
                                        <a href="{{ route('contact') }}" >Liên hệ</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="ltn__header-options ltn__header-options-2 mb-sm-20">

                   <!-- user-menu -->
                    <div class="ltn__drop-menu user-menu">
                        <ul>
                            <li>
                                <a href="{{ Auth::check() ? route('profile.edit') : route('login') }}"><i class="icon-user"></i></a>
                                <ul style="width: 200px !important;">
                                    @auth
                                        <li><a href="{{ route('profile.edit') }}">Tài khoản của tôi</a></li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                                @csrf
                                                <button type="submit" style="background:none; padding-left: 0;">Đăng xuất</button>
                                            </form>
                                        </li>
                                    @else
                                        <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                        <li><a href="{{ route('register') }}">Đăng ký</a></li>
                                        <li><a href="{{ route('profile.edit') }}">Tài khoản của tôi</a></li>
                                    @endauth
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- mini-cart -->
                    <div class="mini-cart-icon">
                        <a href="{{ route('cart.index') }}" >
                            <i class="icon-shopping-cart"></i>
                            <span id="total-items-cart">{{ count(session()->get('cart', [])) }}</span>
                        </a>
                    </div>
                    <!-- mini-cart -->
                    <!-- Mobile Menu Button -->
                    <div class="mobile-menu-toggle d-xl-none">
                        <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                            <svg viewBox="0 0 800 600">
                                <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                <path d="M300,320 L540,320" id="middle"></path>
                                <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ltn__header-middle-area end -->
</header>
