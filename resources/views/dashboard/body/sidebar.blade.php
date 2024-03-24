
<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Core</div>
            <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>
            <!-- <a class="nav-link {{ Request::is('pos*') ? 'active' : '' }}" href="{{ route('pos.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                POS
            </a> -->

            <!-- Sidenav Heading (Orders)-->
            <div class="sidenav-menu-heading">Orders</div>
            <a class="nav-link {{ Request::is('orders/complete*') ? 'active' : '' }}" href="{{ route('order.completeOrders') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Complete
            </a>
            <a class="nav-link {{ Request::is('orders/pending*') ? 'active' : '' }}" href="{{ route('order.pendingOrders') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-clock"></i></div>
                Pending
            </a>
            <a class="nav-link {{ Request::is('orders/due*') ? 'active' : '' }}" href="{{ route('order.dueOrders') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-credit-card"></i></div>
                Due
            </a>
            <!-- Sidenav Heading (Purchases)-->
            <!-- <div class="sidenav-menu-heading">Purchases</div>
            <a class="nav-link {{ Request::is('purchases', 'purchase/create*', 'purchases/details*') ? 'active' : '' }}" href="{{ route('purchases.allPurchases') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-cash-register"></i></div>
                All
            </a>
            <a class="nav-link {{ Request::is('purchases/approved*') ? 'active' : '' }}" href="{{ route('purchases.approvedPurchases') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Approval
            </a>
            <a class="nav-link {{ Request::is('purchases/report*') ? 'active' : '' }}" href="{{ route('purchases.dailyPurchaseReport') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-flag"></i></div>
                Daily Purchase Report
            </a> -->

            <!-- Sidenav Accordion (Pages)-->
           

            <!-- Sidenav Heading (Pages)-->
            <!-- <div class="sidenav-menu-heading">Pages</div>
            <a class="nav-link {{ Request::is('customers*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Customers
            </a> -->
           <!--  <a class="nav-link {{ Request::is('suppliers*') ? 'active' : '' }}" href="{{ route('suppliers.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Suppliers
            </a> -->

            <!-- Sidenav Heading (Products)-->
            <div class="sidenav-menu-heading">Products</div>
           
            <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-folder"></i></div>
                Categories
            </a>
             <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                Products
            </a>
            <!-- <a class="nav-link {{ Request::is('units*') ? 'active' : '' }}" href="{{ route('units.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-folder"></i></div>
                Units
            </a> -->

            <!-- Sidenav Heading (Settings)-->
            <div class="sidenav-menu-heading">Settings</div>
             <a class="nav-link {{ Request::is('config*') ? 'active' : '' }}" href="{{ route('config.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-cog"></i></div>
                Site Config
            </a>
            <a class="nav-link {{ Request::is('banner*') ? 'active' : '' }}" href="{{ route('banner.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-image"></i></div>
                Banners
            </a>
            <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Users
            </a>
        </div>
    </div>

    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{ auth()->user()->name }}</div>
        </div>
    </div>
</nav>
