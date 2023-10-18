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
            <a class="nav-link" href="{{ route('not.approved.seller.home') }}">
                <i class="mdi mdi-file-document-box menu-icon"></i>
                <span class="menu-title">{{ __('Dashboard') }}</span>
            </a>
        </li>
    </ul>
</nav>