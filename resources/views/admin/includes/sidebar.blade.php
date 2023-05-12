<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home.index') }}" class="brand-link text-center">
{{--        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.home.index') }}" class="nav-link {{ request()->is('admin') ? 'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>


                <li class="nav-header">PRODUCT MANAGEMENT</li>
                <li class="nav-item">
                    <a href="{{ route('admin.product.index') }}" class="nav-link {{ request()->is('harris_admin/product') || request()->is('harris_admin/product/*') ? 'active':'' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.category.index') }}" class="nav-link {{ request()->is('harris_admin/category') || request()->is('harris_admin/category/*') ? 'active':'' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-header">ORDER MANAGEMENT</li>
                <li class="nav-item">
                    <a href="{{ route('admin.order.index') }}" class="nav-link {{ request()->is('harris_admin/order') || request()->is('harris_admin/order/*') ? 'active':'' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Product Orders</p>
                    </a>
                </li>
              <li class="nav-item">
                    <a href="{{ route('admin.order.advance_index') }}" class="nav-link {{ request()->is('harris_admin/advance_order') || request()->is('harris_admin/advance_order/*') ? 'active':'' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p> Gold Advance Orders</p>
                    </a>
                </li>
                <li class="nav-header">USER MANAGEMENT</li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->is('harris_admin/user') || request()->is('harris_admin/user/*') ? 'active':'' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
               <li class="nav-header">BLOG MANAGEMENT</li>
                <li class="nav-item">
                    <a href="{{ route('admin.blog') }}" class="nav-link {{ request()->is('harris_admin/blog') || request()->is('harris_admin/blog/*') ? 'active':'' }}">
                        <i class="nav-icon 	fas fa-clone"></i>
                        <p>Blogs</p>
                    </a>
                </li>
                <li class="nav-header">SETTINGS</li>
               <li class="nav-item">
                    <a href="{{ route('admin.origin.index') }}" class="nav-link {{ request()->is('harris_admin/origin') ? 'active':'' }}">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>Todays Gold Rate</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.certification.index') }}" class="nav-link {{ request()->is('gem_admin/certification') ? 'active':'' }}">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>Gemstone</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.energize-type.index') }}" class="nav-link {{ request()->is('gem_admin/energize-type') ? 'active':'' }}">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>Cartage</p>
                    </a>
                </li>
             
                <li class="nav-item">
                    <a href="{{ route('admin.color.index') }}" class="nav-link {{ request()->is('gem_admin/color') ? 'active':'' }}">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>Color</p>
                    </a>
                </li>
              <li class="nav-item">
                    <a href="{{ route('admin.product.gold.discount') }}" class="nav-link ">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>Discount</p>
                    </a>
                </li>
               
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.metal.index') }}" class="nav-link {{ request()->is('gem_admin/metal') ? 'active':'' }}">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>Metal</p>
                    </a>
                </li> --}}
{{--                <li class="nav-item">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon far fa-circle text-info"></i>--}}
{{--                        <p>Logout</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
