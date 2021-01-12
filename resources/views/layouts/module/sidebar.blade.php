<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="nav-icon icon-speedometer"></i> Dashboard
            </a>
        </li>
        @if ( Auth::user()->role_id == 1 )
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fa fa-user-circle-o"></i> Admin
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon icon-home"></i> Manajemen Beranda
            </a>
        </li>
        @endif

        @if ( Auth::user()->role_id == 2 )
        <li class="nav-title">OWNER {{ Auth::user()->business->name ?? '' }}</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="nav-icon icon-drop"></i> Kategori Produk
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product.index') }}">
                <i class="nav-icon icon-drop"></i> Produk
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon icon-basket-loaded"></i> Pesanan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('transaction.index') }}">
                <i class="nav-icon icon-basket-loaded"></i> Transaksi
            </a>
        </li>
        
        <li class="nav-title">Master Data</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('asset.index') }}">
                <i class="nav-icon icon-puzzle"></i> Aset
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon icon-puzzle"></i> Modal
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('debt.index') }}">
                <i class="nav-icon icon-puzzle"></i> Hutang
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('supplier.index') }}">
                <i class="nav-icon icon-puzzle"></i> Supplier
            </a>
        </li>
        @endif

        @if ( Auth::user()->role_id == 3 )
        <li class="nav-title">EMPLOYEE {{ Auth::user()->business->name ?? '' }}</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="nav-icon icon-drop"></i> Kategori
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product.index') }}">
                <i class="nav-icon icon-drop"></i> Produk
            </a>
        </li>
        <li class="nav-title">Pesanan</li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon icon-basket-loaded"></i> Pending
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon icon-basket-loaded"></i> Selesai
            </a>
        </li>
        @endif
    </ul>
</nav>
