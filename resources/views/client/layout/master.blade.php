<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Linxi - Tea & Coffee</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('assets/client/img/favicon.png')}} " type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/font-icons.css')}} ">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/plugins.css')}} ">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/style.css')}} ">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/responsive.css')}} ">



</head>

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="body-wrapper">

        <!-- HEADER AREA START (header-5) -->
        @include('client.pages.header')
        <!-- HEADER AREA END -->

        <!-- Utilize Mobile Menu Start -->
        @include('client.pages.mobile_menu')
        <!-- Utilize Mobile Menu End -->

        <div class="ltn__utilize-overlay"></div>

        @yield('page_header')

        @yield('login')

        @yield('register')

        @yield('forgot_password')

        @yield('account')

        @yield('cart')

        @yield('order_detail')

        @yield('shop')

        <!-- SLIDER AREA START (slider-3) -->
        @yield('slider')
        <!-- SLIDER AREA END -->

        <!-- FEATURE AREA START ( Feature - 3) -->
        @yield('feature')
        <!-- FEATURE AREA END -->

        <!-- ABOUT US AREA START -->
        @yield('about')
        <!-- ABOUT US AREA END -->

        <!-- CATEGORY AREA START -->
        @yield('category')
        <!-- CATEGORY AREA END -->

        <!-- PRODUCT TAB AREA START (product-item-3) -->
        @yield('products')
        <!-- PRODUCT TAB AREA END -->

        <!-- COUNTER UP AREA START -->
        @yield('counter')
        <!-- COUNTER UP AREA END -->

        <!-- PRODUCT AREA START (product-item-3) -->
        @yield('featured_product')
        <!-- PRODUCT AREA END -->

        <!-- FOOTER AREA START -->
        @include('client.pages.footer')
        <!-- FOOTER AREA END -->

        <!-- MODAL AREA START (Quick View Modal) -->
        {{-- @include('client.pages.quick_view_modal') --}}
        @yield('quick_view_modal')

        <!-- MODAL AREA END -->

        <!-- MODAL AREA START (Add To Cart Modal) -->
        @yield('add_to_cart_model')
        <!-- MODAL AREA END -->

        <!-- MODAL AREA START (Wishlist Modal) -->
        {{-- @include('client.pages.wishlist_modal') --}}
        <!-- MODAL AREA END -->

    </div>
    <!-- Body main wrapper end -->

    <!-- preloader area start -->
    @include('client.pages.preloader')
    <!-- preloader area end -->

    <!-- All JS Plugins -->
    <script src="{{ asset('assets/client/js/plugins.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/client/js/main.js') }}"></script>
    <!-- Thư viện SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

    @yield('js-custom')

</body>
</html>

