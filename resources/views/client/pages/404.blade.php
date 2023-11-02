<!-- 404 area start -->
<div class="ltn__404-area ltn__404-area-1 mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="error-404-inner text-center">
                    <h1 class="error-404-title">404</h1>
                    <h2>Không tìm thấy trang! Không tìm thấy trang!</h2>
                    <p>Rất tiếc! Trang bạn đang tìm kiếm không tồn tại. Nó có thể đã được di chuyển hoặc bị xóa.</p>
                    <div class="btn-wrapper">
                        @if(!Auth::check() || Auth::user()->role_id !== 1)
                            <a href="{{ route('home') }}" class="btn btn-transparent"><i class="fas fa-long-arrow-alt-left"></i> QUAY LẠI TRANG CHỦ</a>
                        @else
                            <a href="{{ route('admin.index') }}" class="btn btn-transparent"><i class="fas fa-long-arrow-alt-left"></i> QUAY LẠI TRANG CHỦ</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 404 area end -->
