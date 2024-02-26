<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="/">
            <img
                src="{{ url('admin/logo/logo-edduby1.png') }}"
                alt="logo"
                width="150"
                class=""
            />
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
        <li
            class="dropdown {{ request()->routeIs('admin.add.brand') ? 'active' : '' }}"
        >
            <a href="#" class="nav-link has-dropdown"
                ><i class="fa fa-bold" aria-hidden="true"></i><span>Brands</span></a
            >
            <ul class="dropdown-menu">
                <li
                    class="{{ request()->routeIs('admin.add.brand') ? 'active' : '' }}"
                >
                    <a class="nav-link" href="{{ route('admin.add.brand') }}"
                        >Manage
                    </a>
                </li>
                <li
                    class="{{ request()->routeIs('admin.brands.list') ? 'active' : '' }}"
                >
                    <a class="nav-link" href="{{ route('admin.brands.list') }}"
                        >Lists</a
                    >
                </li>
            </ul>
        </li>

        <li
            class="dropdown {{ request()->routeIs('admin.category.create') ? 'active' : '' }}"
        >
            <a href="#" class="nav-link has-dropdown"
                ><i class="fas fa-users-cog"></i><span>Category</span></a
            >
            <ul class="dropdown-menu">
                <li
                    class="{{ request()->routeIs('admin.category.create') ? 'active' : '' }}"
                >
                    <a
                        class="nav-link"
                        href="{{ route('admin.category.create') }}"
                        >Manage
                    </a>
                </li>
                <li
                    class="{{ request()->routeIs('admin.category.list') ? 'active' : '' }}"
                >
                    <a
                        class="nav-link"
                        href="{{ route('admin.category.list') }}"
                        >Lists</a
                    >
                </li>
            </ul>
        </li>
        <li
            class="dropdown {{ request()->routeIs('admin.products.index') ? 'active' : '' }}"
        >
            <a href="#" class="nav-link has-dropdown"
                ><i class="fa fa-binoculars" aria-hidden="true"></i><span>Product</span></a
            >
            <ul class="dropdown-menu">
                <li
                    class="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}"
                >
                    <a
                        class="nav-link"
                        href="{{ route('admin.products.create') }}"
                        >Manage
                    </a>
                </li>
                <li
                    class="{{ request()->routeIs('admin.category.list') ? 'active' : '' }}"
                >
                    <a class="nav-link" href="{{ route('admin.product.list') }}"
                        >Lists</a
                    >
                </li>
            </ul>
        </li>
        <li
            class="dropdown {{ request()->routeIs('admin.products.index') ? 'active' : '' }}"
        >
            <a href="#" class="nav-link has-dropdown"
                ><i class="fa fa-cart-arrow-down" aria-hidden="true"></i><span>Orders</span></a
            >
            <ul class="dropdown-menu">
                <li
                    class="{{ request()->routeIs('admin.category.list') ? 'active' : '' }}"
                >
                    <a class="nav-link" href="{{ route('admin.orders.index') }}"
                        >Lists</a
                    >
                </li>
            </ul>
        </li>
        <li
            class="dropdown {{ request()->routeIs('admin.size.create') ? 'active' : '' }}"
        >
            <a href="#" class="nav-link has-dropdown"
                ><i class="fa fa-bookmark" aria-hidden="true"></i><span>Size</span></a
            >
            <ul class="dropdown-menu">
                <li
                    class="{{ request()->routeIs('admin.size.create') ? 'active' : '' }}"
                >
                    <a class="nav-link" href="{{ route('admin.size.create') }}"
                        >Add</a
                    >
                </li>
                <li
                class="{{ request()->routeIs('admin.size.list') ? 'active' : '' }}"
            >
                <a class="nav-link" href="{{ route('admin.size.list') }}"
                    >List</a
                >
            </li>
            </ul>
        </li>
    </ul>
</aside>
