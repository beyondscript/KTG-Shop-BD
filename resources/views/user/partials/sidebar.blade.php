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
            <a class="nav-link" href="{{ route('buyer.home') }}">
                <span class="menu-title">{{ __('Dashboard') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="background: none;" data-toggle="collapse" href="#order" aria-expanded="false" aria-controls="order">
                <span class="menu-title">{{ __('Order') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="order">
                <ul class="nav flex-column sub-menu">
                    <li class="{{ request()->segment(1) == 'processing-orders' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('buyer.processing.order') }}">{{ __('Processing Orders') }}</a>
                    </li>
                    <li class="{{ request()->segment(1) == 'completed-orders' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('buyer.completed.order') }}">{{ __('Completed Orders') }}</a>
                    </li>
                    <li class="{{ request()->segment(1) == 'cancelled-orders' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('buyer.canceled.order') }}">{{ __('Cancelled Orders') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="background: none;" data-toggle="collapse" href="#review" aria-expanded="false" aria-controls="review">
                <span class="menu-title">{{ __('Review') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="review">
                <ul class="nav flex-column sub-menu">
                    <li class="{{ request()->segment(1) == 'pending-reviews' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('buyer.pending.review') }}">{{ __('Pending Reviews') }}</a>
                    </li>
                    <li class="{{ request()->segment(1) == 'reviewed-orders' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('buyer.reviewed.order') }}">{{ __('Reviewed Orders') }}</a>
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
                    <li class="{{ request()->segment(1) == 'change-email' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('buyer.change.email') }}">{{ __('Change Email') }}</a>
                    </li>
                    <li class="{{ request()->segment(1) == 'change-password' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('buyer.change.password') }}">{{ __('Change Password') }}</a>
                    </li>
                    <li class="{{ request()->segment(1) == 'change-picture' ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ route('buyer.change.picture') }}">{{ __('Change Picture') }}</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>