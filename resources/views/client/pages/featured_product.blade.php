<div class="ltn__product-area ltn__product-gutter pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">Sản phẩm nổi bật</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">
            <!-- ltn__product-item -->
            @foreach ($featuredProducts as $featuredProduct)
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__product-item ltn__product-item-3 text-left">
                    <div class="product-img">
                        @php
                            $imagesLink = is_null($featuredProduct->image) || !file_exists('images/products/' . $featuredProduct->image) ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg' : asset('images/products/' . $featuredProduct->image);
                        @endphp
                        <a href="#">
                            <img style="margin: 0 auto !important;" src="{{ $imagesLink }}" alt="{{ $featuredProduct->name }}">
                        </a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge">Mới</li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-info">
                        <h2 class="product-title"><a href="#">{{ $featuredProduct->name }}</a></h2>
                        <div class="product-price">
                            <span>{{ number_format($featuredProduct->price,0) }}</span>
                        </div>
                        <a style="border: 1.5px solid #699403; border-radius:5%; padding:7px 10px; " class="add-to-cart"  data-url="{{ route('add_to_cart', ['productId' => $featuredProduct->id]) }}"
                            href="#" title="Add to Cart" data-toggle="modal"
                            data-target="#add_to_cart_modal" data-product="{{ json_encode($featuredProduct) }}">
                            Mua <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            <!--  -->
        </div>
    </div>
</div>
