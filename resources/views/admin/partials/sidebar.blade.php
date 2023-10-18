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
            <a class="nav-link" href="{{ route('admin.home') }}">
                <span class="menu-title">{{ __('Dashboard') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="background: none;" data-toggle="collapse" href="#brand" aria-expanded="false" aria-controls="brand">
                <span class="menu-title">{{ __('Brand') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="brand">
                <ul class="nav flex-column sub-menu">
                    <li class="{{ request()->segment(1) == 'add-brand' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('add.brand') }}">{{ __('Add a new Brand') }}</a>
                    </li>
                    <li class="{{ request()->segment(1) == 'all-brands' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('all.brand') }}">{{ __('Brands') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="background: none;" data-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category">
                <span class="menu-title">{{ __('Category') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="category">
                <ul class="nav flex-column sub-menu">
                    <li class="{{ request()->segment(1) == 'add-category' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('add.category') }}">{{ __('Add a new Category') }}</a>
                    </li>
                    <li class="{{ request()->segment(1) == 'all-categories' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('all.category') }}">{{ __('Categories') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="background: none;" data-toggle="collapse" href="#hot-deal" aria-expanded="false" aria-controls="hot-deal">
                <span class="menu-title">{{ __('Hot Deal') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="hot-deal">
                <ul class="nav flex-column sub-menu">
                    <li class="{{ request()->segment(1) == 'add-hot-deal' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('add.hot.deal') }}">{{ __('Add a new Hot Deal') }}</a>
                    </li>
                    <li class="{{ request()->segment(1) == 'all-hot-deals' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('all.hot.deal') }}">{{ __('Hot Deals') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="background: none;" data-toggle="collapse" href="#seller" aria-expanded="false" aria-controls="seller">
                <span class="menu-title">{{ __('Seller') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="seller">
                <ul class="nav flex-column sub-menu">
                    <li class="{{ request()->segment(1) == 'approve-sellers' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('approve.seller') }}">{{ __('Approve Sellers') }}</a>
                    </li>
                    <li class="{{ request()->segment(1) == 'all-sellers' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('all.seller') }}">{{ __('Sellers') }}</a>
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
                    <li class="{{ request()->segment(1) == 'processing-withdraws' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('admin.processing.withdraw') }}">{{ __('Processing Withdraws') }}</a>
                    </li>
                    <li class="{{ request()->segment(1) == 'completed-withdraws' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('admin.completed.withdraw') }}">{{ __('Completed Withdraws') }}</a>
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
                        <a class="nav-link" href="{{ route('admin.change.email') }}">{{ __('Change Email') }}</a>
                    </li>
                    <li class="{{ request()->segment(2) == 'change-password' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('admin.change.password') }}">{{ __('Change Password') }}</a>
                    </li>
                    <li class="{{ request()->segment(2) == 'change-picture' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('admin.change.picture') }}">{{ __('Change Picture') }}</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>