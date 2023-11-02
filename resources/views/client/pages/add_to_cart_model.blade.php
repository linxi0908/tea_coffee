<div class="ltn__modal-area ltn__add-to-cart-modal-area">
    <div class="modal fade" id="add_to_cart_modal" tabindex="-1">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ltn__quick-view-modal-inner">
                        <div class="modal-product-item">
                            <div class="row">
                                <div class="col-12">
                                    <div class="modal-product-img">
                                        <img style="margin: 0 auto !important; display:flex; width:100%;" src="" alt="">
                                    </div>
                                    <div class="modal-product-info">
                                        <h5 class="product-name"><a href="#"></a></h5>
                                        <p class="added-cart"><i class="fa fa-check-circle"></i> Thêm vào giỏ hàng thành công</p>
                                        <div class="btn-wrapper">
                                            <a href="{{ route('cart.index') }}" class="theme-btn-1 btn btn-effect-1">Giỏ hàng</a>
                                            <a href="{{ route('checkout.index') }}" class="theme-btn-2 btn btn-effect-2">Thanh toán</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
