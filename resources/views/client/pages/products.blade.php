<div class="ltn__product-tab-area ltn__product-gutter pt-30 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">Thực đơn</h1>
                </div>
                <div class="ltn__tab-menu ltn__tab-menu-2 ltn__tab-menu-top-right-- text-uppercase text-center">
                    <div class="nav">
                        @foreach ($productCategories as $key => $productCategory)
                            <a class="{{ $key === 0 ? 'active show' : '' }}" data-toggle="tab" href="#liton_tab_3_{{ $productCategory->id }}">{{ $productCategory->name }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="tab-content">
                    @foreach ($productCategories as $key => $productCategory)
                        <div class="tab-pane fade {{ $key === 0 ? 'active show' : '' }}" id="liton_tab_3_{{ $productCategory->id }}">
                            <div class="ltn__product-tab-content-inner">
                                <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                    @foreach ($productCategory->products as $product)
                                        <div class="col-lg-12">
                                            <div class="ltn__product-item ltn__product-item-3 text-center">
                                                <div class="product-img">
                                                    @php
                                                        $imagesLink = is_null($product->image) || !file_exists('images/products/' . $product->image) ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg' : asset('images/products/' . $product->image);
                                                    @endphp
                                                    <a href="#">
                                                        <img style="margin: 0 auto !important;" src="{{ $imagesLink }}" alt="{{ $product->name }}">
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <h2 class="product-title"><a href="#">{{ $product->name }}</a></h2>
                                                    <div class="product-price">
                                                        <span>{{ number_format($product->price,0) }}</span>
                                                    </div>
                                                        <a style="border: 1.5px solid #699403; border-radius:5%; padding:7px 10px; " class="add-to-cart" data-url="{{ route('add_to_cart', ['productId' => $product->id]) }}"
                                                            href="#" title="Add to Cart" data-toggle="modal"
                                                            data-target="#add_to_cart_modal" data-product="{{ json_encode($product) }}">
                                                            Mua <i class="fas fa-shopping-cart"></i>
                                                        </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

