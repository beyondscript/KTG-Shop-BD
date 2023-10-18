<!-- Header -->
<header>
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left" style="color: white;">
                <li><a href="tel:{{ config('app.phone', 'Laravel') }}"><i class="fa fa-phone"></i> {{ config('app.phone', 'Laravel') }}</a></li>
                <li><a href="mailto:{{ config('app.email', 'Laravel') }}"><i class="fa fa-envelope-o"></i> {{ config('app.email', 'Laravel') }}</a></li>
                <li style="font-size: 14px; font-weight: 500;"><i class="fa fa-map-marker"></i> {{ config('app.address', 'Laravel') }}</li>
            </ul>
            <ul class="header-links pull-right">
                @if (Route::has('login'))
                    @auth
                        @if(Auth::user()->type == 'Buyer')
                            <li><a href="{{ url('/home') }}"><i class="fa fa-user"></i> {{ __('Dashboard') }}</a></li>
                        @elseif(Auth::user()->type == 'Seller')
                            <li><a href="{{ url('/seller-home') }}"><i class="fa fa-user"></i> {{ __('Dashboard') }}</a></li>
                        @elseif(Auth::user()->type == 'Admin')
                            <li><a href="{{ url('/admin-home') }}"><i class="fa fa-user"></i> {{ __('Dashboard') }}</a></li>
                        @endif
                        <li>
                            <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i>
                                 {{ __('Logout') }}
                                <form id="logout-form" action="{{ route('custom_logout') }}" method="POST">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> {{ __('Login') }}</a></li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
    <div id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="{{ URL::to('/') }}" class="logo">
                                <img style="max-width: 200px; margin-top: 15px;" src="{{ asset('images/icon/logo.webp') }}" alt="{{ config('app.name', 'Laravel') }}">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="text-align: center;" class="header-search">
                            <form method="GET" action="{{ route('search.result') }}">

                                <input name="keyword" class="input" placeholder="Enter Keyword">
                                <button type="submit" class="search-btn" style="border-radius: 0;">{{ __('Search') }}</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <div>
                                @auth
                                    @if(Auth::user()->type == 'Buyer')
                                        <a id="show_wishlist" href="{{ route('show.wishlist') }}">
                                            <i class="fa fa-heart"></i>
                                            <span>{{ __('Wishlist') }}</span>
                                            <div class="qty">{{Auth::user()->wishlists->count()}}</div>
                                        </a>
                                    @else
                                        <a id="show_wishlist" href="{{ route('show.wishlist') }}">
                                            <i class="fa fa-heart"></i>
                                            <span>{{ __('Wishlist') }}</span>
                                        </a>
                                    @endif
                                @else
                                    <a id="show_wishlist" href="{{ route('show.wishlist') }}">
                                        <i class="fa fa-heart"></i>
                                        <span>{{ __('Wishlist') }}</span>
                                    </a>
                                @endif
                            </div>
                            <div class="dropdown">
                                @auth
                                    @if(Auth::user()->type == 'Buyer')
                                        <a id="show_cart" style="cursor: pointer;" href="{{ route('view.cart') }}">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>{{ __('Cart') }}</span>
                                            <div class="qty">{{Auth::user()->carts->count()}}</div>
                                        </a>
                                    @else
                                        <a id="show_cart" style="cursor: pointer;" href="{{ route('view.cart') }}">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>{{ __('Cart') }}</span>
                                        </a>
                                    @endif
                                    
                                @else
                                    <a id="show_cart" style="cursor: pointer;" href="{{ route('view.cart') }}">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>{{ __('Cart') }}</span>
                                    </a>
                                @endif
                            </div>
                            <div class="menu-toggle">
                                <a id="open_menu" href="/open-menu" onclick="event.preventDefault();">
                                    <i class="fa fa-bars"></i>
                                    <span>{{ __('Menu') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</header>

<!-- Navigation -->
<nav id="navigation" style="border-bottom: 0;">
    <div class="container">
        <div id="responsive-nav">
            <a id="close-menu" style="position: fixed; color: white; right: 25px; top: 15px;" href="/close-menu" onclick="closeMenu(event)"><i class="fa fa-times"></i></a>
            <ul class="main-nav nav navbar-nav">
                <li class="{{ '/' == request()->path() ? 'active' : '' }}"><a href="{{ URL::to('/') }}">{{ __('Home') }}</a></li>
                <li class="{{ request()->segment(1) == 'products-for-brand' ? 'active' : '' }}"><a href="/brands" onclick="event.preventDefault();">{{ __('Brands') }}</a>
                    <ul id="frontend_menu_dropdowns" class="dropdown" style="width: 125px;">
                        @foreach($brand as $brnd)
                            <li><a href="{{URL::to('/products-for-brand/'.$brnd->id)}}">{{ $brnd->brandname }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="{{ request()->segment(1) == 'products-store' ? 'active' : '' }}"><a href="{{ route('product.store') }}">{{ __('Store') }}</a></li>
                <li class="{{ request()->segment(1) == 'contact-us' ? 'active' : '' }}"><a href="{{ route('contact.us') }}">{{ __('Contact Us') }}</a></li>
                <li class="{{ request()->segment(1) == 'about-us' ? 'active' : '' }}"><a href="{{ route('about.us') }}">{{ __('About Us') }}</a></li>
                <li class="{{ request()->segment(1) == 'privacy-policy' ? 'active' : '' }}"><a href="{{ route('privacy.policy') }}">{{ __('Privacy Policy') }}</a></li>
            </ul>
        </div>
    </div>
</nav>

<script>
    function closeMenu(event){
        event.preventDefault();
        document.getElementById('responsive-nav').setAttribute('class', 'ps ps--theme_default ps--active-x ps--active-y');
    }
</script>