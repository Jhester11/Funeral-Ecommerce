<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav ">
        <li class="nav-item ">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="mdi mdi-speedometer menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        {{-- Inventory --}}
        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#inventory" aria-expanded="false"
                aria-controls="inventory">
                <i class="mdi mdi-bulletin-board menu-icon"></i>
                <span class="menu-title">Inventory</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="inventory">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/category') }}">Category</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/brands') }}">Brand</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/colors') }}">Color</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products') }}">Product</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ url('admin/sliders') }}">Slider</a></li> --}}
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/sliders') }}">
                <i class="mdi mdi-view-carousel menu-icon"></i>
                <span class="menu-title">Home Slider</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/orders') }}">
                <i class="mdi mdi-sale menu-icon"></i>
                <span class="menu-title">Orders</span>
            </a>
        </li>
        {{-- Point of Sale --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/point-of-sale') }}">
                <i class="mdi mdi-currency-usd menu-icon"></i>
                <span class="menu-title">Point of Sale</span>
            </a>
        </li>

    </ul>
</nav>
