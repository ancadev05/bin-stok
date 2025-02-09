<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/img/logo-biner.png') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dahsboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Master</h4>
                </li>

                <li class="nav-item {{ Request::is('category*') ? 'active' : '' }}">
                    <a href="{{ route('category') }}">
                        <i class="fas fa-cube"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('product*') ? 'active' : '' }}">
                    <a href="{{ route('product') }}">
                        <i class="fas fa-cubes"></i>
                        <p>Produk</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('supplier*') ? 'active' : '' }}">
                    <a href="{{ route('supplier') }}">
                        <i class="fas fa-truck"></i>
                        <p>Supplayer</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Transaksi</h4>
                </li>

                <li class="nav-item {{ Request::is('purchase*') ? 'active' : '' }}">
                    <a href="{{ route('purchase') }}">
                        <i class="fas fa-cart-plus"></i>
                        <p>Pembelian</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('sale*') ? 'active' : '' }}">
                    <a href="{{ route('sale') }}">
                        <i class="fas fa-luggage-cart"></i>
                        <p>Penjualan</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Laporan</h4>
                </li>

                <li class="nav-item {{ Request::is('purchase.report') ? 'active' : '' }}">
                    <a href="{{ route('purchase.report') }}">
                        <i class="fas fa-file-alt"></i>
                        <p>Laporan Pembelian</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">System</h4>
                </li>

                <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
                    <a href="{{ route('users') }}">
                        <i class="fas fa-user-cog"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('company*') ? 'active' : '' }}">
                    <a href="{{ route('company') }}">
                        <i class="fas fa-cog"></i>
                        <p>Pengaturan</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->