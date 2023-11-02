<div class="ltn__category-area section-bg-1-- ltn__primary-bg before-bg-1 bg-image bg-overlay-theme-black-5--0 pt-115 pb-90" data-bg="img/bg/5.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title white-color">Danh mục loại sản phẩm</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__category-slider-active slick-arrow-1">

            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-3 text-center">
                    <div class="ltn__category-item-img">
                        <a href="{{ route('products') }}">
                            <img style="width:30%" src="{{ asset('assets/client/img/icons/icon-img/all.png') }}" alt="Image">
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h5><a href="{{ route('products') }}">Tất cả</a></h5>
                        <h6>({{ $productCount }} món)</h6>
                    </div>
                </div>
            </div>
            @foreach ($productCategories as $productCategory)
            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-3 text-center">
                    <div class="ltn__category-item-img">
                            <a href="{{ route('products', ['slug'=> $productCategory->slug]) }}">
                            @php
                        $imagesLink = is_null($productCategory->image) || !file_exists('images/product_categories/' . $productCategory->image) ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg' : asset('images/product_categories/' . $productCategory->image);
                        @endphp
                            <img style="width:30%" src="{{ $imagesLink }}" alt="{{ $productCategory->name }}">
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h5>
                            {{-- <a href="{{ route('products.filter',['slug'=> $productCategory->slug]) }}">
                            {{ $productCategory->name }}</a> --}}
                            <a href="{{ route('products',  ['slug' => $productCategory->slug]) }}"> {{ $productCategory->name }}
                            </a>
                        </h5>
                        <h6>({{ $productCategory->product_count }} món)</h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
