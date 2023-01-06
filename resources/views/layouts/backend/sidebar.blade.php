<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">{{ $config->name }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">PO</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Transactions</li>
            <li class="{{ Route::is('admin.order') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.order') }}"><i class="fas fa-clipboard-list"></i> <span>Order List</span></a>

            <li class="{{ Route::is('admin.customer') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.customer') }}"><i class="fas fa-user-tie"></i> <span>Customers</span></a>

            <li class="dropdown {{ Route::is('admin.categories') || Route::is('admin.product')  ? 'active' : '' }}">
            {{-- <li class="dropdown {{ Route::is('admin.categories')  ? 'active' : '' }}"> --}}
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-cube"></i> <span>Product</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.categories') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.categories') }}">Categories</a></li>
                    <li class="{{ Route::is('admin.product') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.product') }}">Product List</a></li>
                </ul>
            </li>
            <li class="menu-header">Configuration</li>
            <li class="{{ Route::is('admin.configuration') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.configuration') }}"><i class="fas fa-plug"></i> <span>Configuration Web</span></a>
            {{-- <li class="{{ Route::is('users.*') || Route::is('user.*')  ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.configuration') }}"><i class="fas fa-plug"></i> <span>Configuration Web</span></a> --}}
            </li>
            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                <a href="https://github.com/prayogimhd" class="btn btn-primary btn-lg btn-block btn-icon-split">
                  <i class="fas fa-rocket"></i> Github
                </a>
              </div>
        </ul>
    </aside>
</div>
