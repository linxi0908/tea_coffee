<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('assets/admin/dist/img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Linxi Tea & Coffee</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-2 pb-2 mb-2 d-flex justify-content-center">
            <div class="info">
                <a href="" class="d-block">{{ Auth::user()->name ?? '' }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.index') }}" class="nav-link {{ request()->route()->getName() === 'admin.index' ? 'active': '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Bảng điều khiển
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview
                {{ request()->route()->getName() === 'admin.about.create'
                    || request()->route()->getName() === 'admin.about.edit'
                    || request()->route()->getName() === 'admin.footer.create'
                    || request()->route()->getName() === 'admin.footer.edit'
                    || request()->route()->getName() === 'admin.contact.create'
                    || request()->route()->getName() === 'admin.contact.edit'
                    ? 'menu-open': '' }}
                ">
                    <a href="#" class="nav-link
                    {{ request()->route()->getName() === 'admin.about.create'
                    || request()->route()->getName() === 'admin.about.edit'
                    || request()->route()->getName() === 'admin.footer.create'
                    || request()->route()->getName() === 'admin.footer.edit'
                    || request()->route()->getName() === 'admin.contact.create'
                    || request()->route()->getName() === 'admin.contact.edit'
                    ? 'active': '' }}
                    ">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Quản lý trang tĩnh
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.about.create') }}" class="nav-link {{ request()->route()->getName() === 'admin.about.create' || request()->route()->getName() === 'admin.about.edit' ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Giới thiệu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.contact.create') }}" class="nav-link {{ request()->route()->getName() === 'admin.contact.create' || request()->route()->getName() === 'admin.contact.edit' ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Liên hệ</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.information.create') }}" class="nav-link {{ request()->route()->getName() === 'admin.information.create' || request()->route()->getName() === 'admin.information.edit' ? 'active': '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Thiết lập thông tin
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->route()->getName() === 'admin.user.index' ? 'active': '' }}">
                        <i class="nav-icon fas fa-users"></i></i>
                        <p>
                            Quản lý khách hàng
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{ request()->route()->getName() === 'admin.product_category.index' || request()->route()->getName() === 'admin.product.index' ? 'menu-open': '' }}">
                    <a href="#" class="nav-link {{ request()->route()->getName() === 'admin.product_category.index' || request()->route()->getName() === 'admin.product.index' ? 'active': '' }}">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>
                            Quản lý sản phẩm
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.product_category.index') }}" class="nav-link {{ request()->route()->getName() === 'admin.product_category.index' ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loại sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}" class="nav-link {{ request()->route()->getName() === 'admin.product.index' ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sản phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.invoices.index') }}" class="nav-link {{ request()->route()->getName() === 'admin.invoices.index' ? 'active': '' }}">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>
                            Quản lý đơn hàng
                        </p>
                    </a>

                </li>
            </ul>
        </nav>
        <div style="position:relative; top: 30%">
            <form action="{{ route('logout') }}" method="POST" id="logout-form" >
                @csrf
                <button class="logout-link" type="submit" style="background:none; padding:20px; border:none; color:aliceblue">Đăng xuất<i class="fas fa-sign-out-alt" style="position:absolute;right:65px;"></i></button>
            </form>
        </div>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>
