<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="user-info">
        <div class="profile">
            <img src="{{ asset(Auth::user()->image) }}">
        </div>
        <div class="details">
            <p class="user-name">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
            <p class="designation">{{ Auth::user()->type }}</p>
        </div>
    </div>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('seller.home') }}">
                <span class="menu-title">{{ __('Dashboard') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="background: none;" data-toggle="collapse" href="#shop" aria-expanded="false" aria-controls="shop">
                <span class="menu-title">{{ __('Shop') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="shop">
                <ul class="nav flex-column sub-menu">
                    <li class="{{ request()->segment(1) == 'add-shop' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('add.shop') }}">{{ __('Add a new Shop') }}</a>
                    </li>
                    <li class="{{ request()->segment(1) == 'all-shops' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('all.shop') }}">{{ __('Shops') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="background: none;" data-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
                <span class="menu-title">{{ __('Product') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="product">
                <ul class="nav flex-column sub-menu">
                    <li class="{{ request()->segment(1) == 'add-product' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('add.product') }}">{{ __('Add a new Product') }}</a>
                    </li>
                    <li class="{{ request()->segment(1) == 'all-products' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('all.product') }}">{{ __('Products') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="background: none;" data-toggle="collapse" href="#order" aria-expanded="false" aria-controls="order">
                <span class="menu-title">{{ __('Order') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="order">
                <ul class="nav flex-column sub-menu">
                    <li class="{{ request()->segment(2) == 'processing-orders' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('seller.processing.order') }}">{{ __('Processing Orders') }}</a>
                    </li>
                    <li class="{{ request()->segment(2) == 'completed-orders' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('seller.completed.order') }}">{{ __('Completed Orders') }}</a>
                    </li>
                    <li class="{{ request()->segment(2) == 'cancelled-orders' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('seller.canceled.order') }}">{{ __('Cancelled Orders') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="background: none;" data-toggle="collapse" href="#withdraw" aria-expanded="false" aria-controls="withdraw">
                <span class="menu-title">{{ __('Withdraw') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="withdraw">
                <ul class="nav flex-column sub-menu">
                    <li class="{{ request()->segment(1) == 'request-a-withdraw' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('seller.request.withdraw') }}">{{ __('Request a Withdraw') }}</a>
                    </li>
                    <li class="{{ request()->segment(1) == 'all-withdraws' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('seller.all.withdraw') }}">{{ __('Withdraws') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="background: none;" data-toggle="collapse" href="#profile" aria-expanded="false" aria-controls="profile">
                <span class="menu-title">{{ __('Profile') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="profile">
                <ul class="nav flex-column sub-menu">
                    <li class="{{ request()->segment(2) == 'change-email' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('seller.change.email') }}">{{ __('Change Email') }}</a>
                    </li>
                    <li class="{{ request()->segment(2) == 'change-password' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('seller.change.password') }}">{{ __('Change Password') }}</a>
                    </li>
                    <li class="{{ request()->segment(2) == 'change-picture' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('seller.change.picture') }}">{{ __('Change Picture') }}</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>