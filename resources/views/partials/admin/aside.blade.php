<aside id="sidebar-wrapper" >
    <div class="sidebar-brand">
        <a href="/">
            <img src="{{ url('admin/logo/logo-edduby1.png') }}" alt="logo" width="150" class="" />
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="/">ED</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="far fa-square"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="dropdown {{ request()->routeIs('admin.add.brand','admin.brands.list') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fa fa-bold"
                    aria-hidden="true"></i><span>Brands</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->routeIs('admin.add.brand') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.add.brand') }}">Create
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.brands.list') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.brands.list') }}">List</a>
                </li>
            </ul>
        </li>

        <li class="dropdown {{ request()->routeIs('admin.category.create','admin.category.list') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-users-cog"></i><span>Category</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->routeIs('admin.category.create') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.category.create') }}">Create
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.category.list') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.category.list') }}">List</a>
                </li>
            </ul>
        </li>
        <li class="dropdown {{ request()->routeIs('admin.products.create','admin.product.list','admin.discounts.manage','admin.discount.discounted_products') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fa fa-binoculars"
                    aria-hidden="true"></i><span>Product</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.products.create') }}">Create
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.product.list') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.product.list') }}">List</a>
                </li>
                <li
                    class="{{ request()->routeIs('admin.discounts.manage') ? 'active' : '' }}"
                >
                    <a class="nav-link" href="{{ route('admin.discounts.manage') }}"
                        >Pending Discount List</a
                    >
                </li>
                <li
                    class="{{ request()->routeIs('admin.discount.discounted_products') ? 'active' : '' }}"
                >
                    <a class="nav-link" href="{{ route('admin.discount.discounted_products') }}"
                        >Discounted List</a
                    >
                </li>
            </ul>
        </li>
        <li class="dropdown {{ request()->routeIs(['admin.orders.index', 'admin.orders.dispatch.index', 'admin.orders_status']) ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fa fa-cart-arrow-down"
                    aria-hidden="true"></i><span>Orders</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.orders.index') }}">List</a>
                </li>
                <li class="{{ request()->routeIs('admin.orders.dispatch.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.orders.dispatch.index') }}"> Dispatched List</a>
                </li>
                <li class="{{ request()->route('status') === 'pending' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.orders_status','pending') }}">Pending</a>
                </li>
                <li class="{{ request()->route('status') === 'dispatched' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.orders_status','dispatched') }}">Dispatched</a>
                </li>
                <li class="{{ request()->route('status') === 'delivered' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.orders_status','delivered') }}">Delivered</a>
                </li>
                <li class="{{ request()->route('status') === 'rejected' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.orders_status','rejected') }}">Rejected</a>
                </li>
                <li class="{{ request()->route('status') === 'returned' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.orders_status','returned') }}">Returned</a>
                </li>
                <li class="{{ request()->route('status') === 'delivery_failed' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.orders_status','delivery_failed') }}">Delivery Failed</a>
                </li>
            </ul>
        </li>

        <li class="dropdown {{ request()->routeIs('admin.size.create','admin.size.list' ) ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fa fa-bookmark"
                    aria-hidden="true"></i><span>Size</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->routeIs('admin.size.create') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.size.create') }}">Create</a>
                </li>
                <li class="{{ request()->routeIs('admin.size.list') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.size.list') }}">List</a>
                </li>
            </ul>
        </li>

        <li class="dropdown {{ request()->routeIs('admin.sliders.create','admin.sliders.list') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fa fa-bookmark"
                    aria-hidden="true"></i><span>Slider</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->routeIs('admin.sliders.create') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.sliders.create') }}">Create</a>
                </li>
                <li class="{{ request()->routeIs('admin.sliders.list') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.sliders.list') }}">List</a>
                </li>
            </ul>
        </li>
    </ul>
</aside>