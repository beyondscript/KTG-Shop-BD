<nav class="navbar navbar-light col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div style="position: relative;" class="text-center navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="{{ URL::to('/') }}"><img id="dashboard_logo" style="position: absolute; width: 80%; height: 80%; top: 10%; left: 10%;" src="{{ asset('images/icon/logo.webp') }}"></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator" style="margin-left: 0; margin-right: 10px; padding-top: 4px; padding-bottom: 0;" data-toggle="tooltip" data-placement="bottom" title="Logout" href="/logout" onmouseover="document.getElementById('logout_icon').style.color = 'red';" onmouseout="document.getElementById('logout_icon').style.color = '#7F7F7F';"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i id="logout_icon" class="fa fa-power-off" style="color: #7F7F7F;" aria-hidden="true"></i>
                    <form id="logout-form" action="{{ route('custom_logout') }}" method="POST">
                        @csrf
                    </form>
                </a>
            </li>
        </ul>
        <button id="menu_button" class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" style="margin-left: 10px; margin-right: 10px; padding-left: 0; padding-right: 0; padding-bottom: 0; padding-top: 0;" type="button" data-toggle="tooltip" data-placement="bottom" title="Menu" onmouseover="document.getElementById('menu_icon').style.color = 'blue';" onmouseout="document.getElementById('menu_icon').style.color = '#7F7F7F';" onclick="showMenu(event)">
            <i id="menu_icon" class="fa fa-bars"></i>
        </button>
    </div>
</nav>