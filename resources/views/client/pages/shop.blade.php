<div class="ltn__product-area ltn__product-gutter">
    <div class="container">
        <div class="row">
            <div class="col-lg-4  mb-120">
                <aside class="sidebar ltn__shop-sidebar">
                    <!-- Search Widget -->
                    <div class="widget ltn__search-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Tìm kiếm sản phẩm</h4>
                        <form action="{{ route('products') }}" method="GET">
                            <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Tìm kiếm...">

                            <button type="submit">Tìm kiếm</button>
                        </form>
                    </div>
                    <!-- Category Widget -->
                    <div class="widget ltn__menu-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Danh mục sản phẩm</h4>
                        <ul>
                            @foreach($productCategories as $productCategory)
                            <li>
                                <a href="{{ route('products',['slug' => $productCategory->slug]) }}">
                                    {{ $productCategory->name }}
                                    <span><i class="fas fa-long-arrow-alt-right"></i></span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
            <div class="col-lg-8 order-lg-2 mb-120">
                <div class="ltn__shop-options">
                    <ul>
                        <li>
                            <div class="ltn__grid-list-tab-menu ">
                                <div class="nav">
                                    <a class="active show" data-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                    <a data-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                           <div class="short-by text-center" >
                            <form action="{{ route('products',['slug' => $slug]) }}" method="GET">
                                <select class="select-nice" name="sortBy" onchange="this.form.submit()">
                                    <option value="" >Mặc định</option>
                                    <option {{ $sortBy === 'asc' ? 'selected' : ''}} value="asc">Sắp xếp theo giá: thấp đến cao</option>
                                    <option {{ $sortBy === 'desc' ? 'selected' : ''}} value="desc">Sắp xếp theo giá: cao xuống thấp</option>
                                </select>
                                <input type="hidden" name="keyword" value="{{ $keyword }}">
                                </a>
                            </form>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="product-list">
                    <div class="tab-pane fade active show" id="liton_product_grid">
                        <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                            <div class="row">
                                <!-- ltn__product-item -->
                                @foreach ($products as $product)
                                <div class="col-xl-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-center">
                                        <div class="product-img">
                                            @php
                                                $imagesLink = is_null($product->image) || !file_exists('images/products/' . $product->image) ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg' : asset('images/products/' . $product->image);
                                            @endphp
                                                <img style="margin: 0 auto !important;" src="{{ $imagesLink }}" alt="{{ $product->name }}">

                                            @php
                                                $featured = $product->featured;
                                                if ($featured === 1) {
                                                    $tag = '<div class="product-badge">
                                                                <ul>
                                                                    <li class="sale-badge">New</li>
                                                                </ul>
                                                            </div>';
                                                } else {
                                                    $tag = '';
                                                }
                                            @endphp
                                            {!! $tag !!}
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title">{{ $product->name }}</h2>
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
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="liton_product_list">
                        <div class="ltn__product-tab-content-inner ltn__product-list-view">
                            <div class="row">
                                <!-- ltn__product-item -->
                                <div class="col-lg-12">
                                    @foreach ($products as $product)
                                    <div class="ltn__product-item ltn__product-item-3">
                                        <div class="product-img">
                                            @php
                                            $imagesLink = is_null($product->image) || !file_exists('images/products/' . $product->image) ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg' : asset('images/products/' . $product->image);
                                            @endphp
                                            <img style="margin: 0 auto !important;" src="{{ $imagesLink }}" alt="{{ $product->name }}">
                                            @php
                                                $featured = $product->featured;
                                                if ($featured === 1) {
                                                    $tag = '<div class="product-badge">
                                                                <ul>
                                                                    <li class="sale-badge">New</li>
                                                                </ul>
                                                            </div>';
                                                } else {
                                                    $tag = '';
                                                }
                                            @endphp
                                            {!! $tag !!}
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title">{{ $product->name }}</h2>
                                            <div class="product-price">
                                                <span>{{ number_format($product->price,0) }}</span>
                                            </div>
                                            <div class="product-brief">
                                                <p>{!! $product->description !!}</p>
                                            </div>
                                            <a style="border: 1.5px solid #699403; border-radius:5%; padding:7px 10px; " class="add-to-cart" data-url="{{ route('add_to_cart', ['productId' => $product->id]) }}"
                                                href="#" title="Add to Cart" data-toggle="modal"
                                                data-target="#add_to_cart_modal" data-product="{{ json_encode($product) }}">
                                                Mua <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ltn__pagination-area text-center">
                    <div class="ltn__pagination">
                        <ul>
                            {{-- Kiểm tra xem có trang trước không --}}
                            @if ($products->appends(['keyword' => $keyword, 'sortBy'=>$sortBy, 'slug'=> $slug])->onFirstPage())
                                <li class="disabled">
                                    <a href="#"><i class="fas fa-angle-double-left"></i></a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $products->previousPageUrl() }}"><i class="fas fa-angle-double-left"></i></a>
                                </li>
                            @endif

                            {{-- Loop through the pagination links --}}
                            @foreach ($products->appends(['sortBy'=>$sortBy,'keyword' => $keyword, 'slug'=> $slug])->links()->elements as $key => $elements)
                                @foreach ($elements as $page => $url)
                                    @if ($page == $products->currentPage())
                                        <li class="active">
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endforeach

                            {{-- Kiểm tra xem có trang tiếp theo không --}}
                            @if ($products->appends(['keyword' => $keyword, 'sortBy'=>$sortBy, 'slug'=> $slug ])->hasMorePages())
                                <li>
                                    <a href="{{ $products->nextPageUrl() }}"><i class="fas fa-angle-double-right"></i></a>
                                </li>
                            @else
                                <li class="disabled">
                                    <a href="#"><i class="fas fa-angle-double-right"></i></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

