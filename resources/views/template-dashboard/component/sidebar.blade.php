  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a wire:navigate class="nav-link {{ Request::is('admin/dashboard') ? '' : 'collapsed' }} " href="{{ route('admin.dashboard') }}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li><!-- End Dashboard Nav -->


          <li class="nav-heading">Master</li>

          <li class="nav-item">
              <a wire:navigate class="nav-link {{ Request::is('category') ? '' : 'collapsed' }}" href="{{ route('category') }}">
                  <i class="bi bi-box"></i>
                  <span>Kategori</span>
              </a>
          </li>
          <li class="nav-item">
              <a wire:navigate class="nav-link {{ Request::is('product') ? '' : 'collapsed' }}" href="{{ route('product') }}">
                  <i class="bi bi-boxes"></i>
                  <span>Produk</span>
              </a>
          </li>
          <li class="nav-item">
              <a wire:navigate class="nav-link {{ Request::is('supplier') ? 'active' : 'collapsed' }}" href="{{ route('supplier') }}">
                  <i class="bi bi-truck"></i>
                  <span>Supplayer</span>
              </a>
          </li>

          <li class="nav-heading">Transaksi</li>

          <li class="nav-item">
              <a class="nav-link {{ Request::is('admin.dashboard') ? '' : 'collapsed' }}" href="#">
                  <i class="bi bi-cart-plus"></i>
                  <span>Pembelian</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ Request::is('admin.dashboard') ? '' : 'collapsed' }}" href="#">
                  <i class="bi bi-cart-dash"></i>
                  <span>Penjualan</span>
              </a>
          </li>

          <li class="nav-heading">Laporan</li>

      </ul>

  </aside><!-- End Sidebar-->
