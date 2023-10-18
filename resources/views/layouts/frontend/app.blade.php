<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="KTG Shop BD">
    <meta name="description" content="KTG Shop BD is an online store in Bangladesh that features so many products at affordable prices.">
    <meta property="og:image" content="{{ asset('images/icon/fbicon.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/icon/favicon.webp') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.1/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.0.0/nouislider.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    @vite('public/frontend/css/style.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">

    @vite('public/frontend/css/main.css')

    <style>
        #main {
            position: relative;
            max-height: 100vh;
            overflow: hidden;
        }
        
        #responsive-nav {
            overflow: visible;
        }

        .ps__scrollbar-y-rail {
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px;
          z-index: 2;
        }

        .search-btn:hover,
        .newsletter-btn:hover {
            background-color: #D41838 !important;
        }

        #show_wishlist:hover,
        #show_cart:hover,
        #open_menu:hover,
        .fa.fa-times:hover,
        .fa.fa-heart:hover,
        .fa.fa-shopping-cart:hover,
        .fa.fa-heart-o:hover,
        .fa.fa-cart-plus:hover,
        .fa.fa-trash:hover {
            color: #D10024 !important;
        }

        .fa.fa-refresh:hover {
            color: blue !important;
        }

        .hidden {
            display: none;
        }

        .aside .bootstrap-select .btn.dropdown-toggle.btn-default,
        .product-details .bootstrap-select .btn.dropdown-toggle.btn-default {
            border: 1px solid #E4E7ED;
            border-radius: 0;
        }
        .aside .bootstrap-select .btn.dropdown-toggle.btn-default:focus,
        .product-details .bootstrap-select .btn.dropdown-toggle.btn-default:focus {
            outline: none !important;
        }
        .aside .bootstrap-select .dropdown-menu.open,
        .product-details .bootstrap-select .dropdown-menu.open {
            border: 1px solid #E4E7ED;
            border-radius: 0;
        }
        .aside .bootstrap-select .inner.open::-webkit-scrollbar {
            width: 8px;
        }
        .aside .bootstrap-select .inner.open::-webkit-scrollbar-track {
            background-color: transparent;
            border-radius: 5px;
            -webkit-box-shadow: none;
        }
        .aside .bootstrap-select .inner.open::-webkit-scrollbar-track:hover {
            background-color: #eee;
        }
        .aside .bootstrap-select .inner.open::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 5px;
            outline: none;
        }
        .aside .bootstrap-select .inner.open::-webkit-scrollbar-thumb:hover {
            background: #999;
        }

        #view_cart_product:hover {
            -webkit-box-shadow: 0px 0px 0px 0px #E4E7ED, 0px 0px 0px 1px #E4E7ED;
            box-shadow: 0px 0px 0px 0px #E4E7ED, 0px 0px 0px 1px #E4E7ED;
        }

        #quantity::-webkit-outer-spin-button,
        #quantity::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        #quantity[type=number] {
            -moz-appearance:textfield;
        }

        .view_cart_quantity_buttons {
            display: flex;
            position: absolute;
            width: 27px;
            height: 32px;
            font-weight: 700;
            border: 1px solid #E4E7ED;
            justify-content: center;
            align-items: center;
            top: 0;
        }
        .view_cart_quantity_buttons:hover {
            background-color: #E4E7ED;
            color: #ef233c;
            cursor: pointer;
        }

        .map2{
            overflow:hidden;
            padding-bottom:40%;
            position:relative;
            height:0;
        }
        .map2 iframe{
            left:0;
            top:0;
            height:100%;
            width:100%;
            position:absolute;
        }

        #contact_us_input {
            border-radius: 0;
        }

        .invalid-feedback {
            color: red;
        }

        #navigation ul li ul{
            max-height: 216px;
        }
        #navigation ul li ul.dropdown{
            background: #1E1F29;
            display: none;
            position: absolute;
            top: 47px;
            z-index: 3;
        }
        #navigation ul li:hover ul.dropdown{
            display: block;
        }
        #navigation ul li ul.dropdown li{
            display: block;
            padding-left: 5px;
            padding-right: 20px;
        }
        #navigation ul li ul.dropdown li a{
            color: white;
        }
        #navigation ul li ul.dropdown li a:hover{
            color: #D10024;
        }

        .add_wishlist:hover {
            color: #D10024 !important;
        }
        .remove_wishlist{
            color: red;
        }
        .remove_wishlist:hover {
            color: #D10024 !important;
        }

        .add-to-cart-btn {
            border-radius: 0 !important;
        }

        #pagination a {
            line-height: unset;
        }
        #pagination a:hover {
            color: #D10024;
        }

        #notfoundlink:hover{
            background-color: #D10024;
            color: #ffffff !important;
        }

        #product-tab .tab-content #tab1 ul,
        #product-tab .tab-content #tab2 ul{
            list-style: disc;
            margin-left: 30px;
        }
        #product-tab .tab-content #tab1 ol,
        #product-tab .tab-content #tab2 ol {
            list-style: decimal;
            margin-left: 30px;
        }
        #product-tab .tab-content #tab1 li,
        #product-tab .tab-content #tab2 li {
            list-style-type: inherit;
        }

        .swal-modal {
            border-radius: 0;
        }
        .swal-button.swal-button--cancel {
            background-color: #28a745;
            color: #fff;
            border-radius: 0;
            box-shadow: none;
        }
        .swal-button.swal-button--cancel:hover {
            background-color: #23923d;
        }
        .swal-button.swal-button--confirm.swal-button--danger {
            background-color: #dc3545;
            color: #fff;
            border-radius: 0;
            box-shadow: none;
        }
        .swal-button.swal-button--confirm.swal-button--danger:hover {
            background-color: #ca1f38;
        }

        #toast-container .toast.toast-success,
        #toast-container .toast.toast-error,
        #toast-container .toast.toast-info,
        #toast-container .toast.toast-warning
        {
            border-radius: 0 !important;
            background-image: none !important;
            padding: 15px 15px 15px 7px !important;
            box-shadow: none;
        }

        @media only screen and (min-width: 992px) {
            #close-menu {
                display: none;
            }
        }

        @media only screen and (max-width: 910px) {
            #hot-deal {
              padding: 106px 0 !important;
            }
        }

        @media only screen and (max-width: 455px) {
            #hot-deal {
              padding: 53px 0 !important;
            }
        }

        @media only screen and (max-width: 400px) {
            #product-tab .tab-nav li+li {
                margin-left: 5px;
            }
            #product-tab .tab-nav li {
                padding: 0 5px;
            }
        }

        @media only screen and (max-width: 320px) {
            .hot-deal h2 {
                font-size: 32px !important;
            }
            
            #toast-container > .toast {
              width: 258px;
            }
        }

        @media only screen and (max-width: 310px) {
            #product-tab .tab-nav li a {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <main id="main">
        <!-- Contents -->
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.1/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.0.0/nouislider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.20/jquery.zoom.min.js"></script>

    @vite('public/frontend/js/main.js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/js/bootstrap-select.min.js"></script>

    @yield('scripts')

    <script>
        var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;
        if(isWindows){
            $('#main').perfectScrollbar();
        }
        else{
            document.getElementById('main').style.overflow = "auto";
        }
    </script>

    <script>
        var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;
        if(isWindows){
            $('#frontend_menu_dropdowns').perfectScrollbar();
        }
        else{
            document.getElementById('frontend_menu_dropdowns').style.overflow = "auto";
        }
    </script>

    <script>
        var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;
        if(isWindows){
            var widthLimit = 991;
            var windowWidth = window.innerWidth;
            if(windowWidth <= widthLimit) {
                $('#responsive-nav').perfectScrollbar();
            }
            window.addEventListener('resize', function () {
                var currentWidth = window.innerWidth;
                if (currentWidth <= widthLimit) {
                    $('#responsive-nav').perfectScrollbar();
                }
                else {
                    $('#responsive-nav').perfectScrollbar('destroy');
                    document.getElementById('responsive-nav').removeAttribute('class');
                }
            });
        }
        else{
            document.getElementById('responsive-nav').style.overflow = "auto";
        }
    </script>

    <script>
        function destroy(event){
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true
            })
            .then((willDelete) => {
                if (willDelete){
                    event.target.querySelector('form').submit();
                }
            });
        }
    </script>

    <script>
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                break;
            }
        @endif
    </script>
</body>

</html>