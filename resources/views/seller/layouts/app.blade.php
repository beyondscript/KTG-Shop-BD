<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    <meta property="og:image" content="{{ asset('images/icon/fbicon.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('images/icon/favicon.webp') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.0.46/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.1/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="{{asset('node_modules/rickshaw/rickshaw.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.3/chartist.min.css" />

    @vite('public/css/style.css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.1/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">

    @vite('public/frontend/css/style.css')

    <style>
        html,
        body {
            overflow: hidden;
        }
        
        .ps__scrollbar-y-rail {
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px;
          z-index: 1031;
        }

        .ps__scrollbar-x-rail {
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px;
        }

        .card {
            border-radius: 0;
        }

        .table-responsive {
            overflow: hidden;
        }

        .card-body .form-control {
          border-radius: 0;
        }
        .card-body .form-control:focus {
          box-shadow: none;
        }

        .card-body .btn.btn-success.mr-2 {
            background-color: #28a745;
            color: #fff;
            border-radius: 0;
        }
        .card-body .btn.btn-success.mr-2:hover {
            background-color: #23923d;
        }
        .card-body .btn.btn-success.mr-2:focus {
          box-shadow: none;
        }

        #regularprice::-webkit-outer-spin-button,
        #discountedprice::-webkit-outer-spin-button,
        #productquantity::-webkit-outer-spin-button,
        #amount::-webkit-outer-spin-button,
        #regularprice::-webkit-inner-spin-button,
        #discountedprice::-webkit-inner-spin-button,
        #productquantity::-webkit-inner-spin-button,
        #amount::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        #regularprice[type=number],
        #discountedprice[type=number],
        #productquantity[type=number],
        #amount[type=number] {
            -moz-appearance:textfield;
        }

        .card-body .btn.btn-outline-danger{
            background-color: #dc3545;
            color: #fff;
            border-radius: 0;
        }
        .card-body .btn.btn-outline-danger:hover {
            background-color: #ca1f38;
        }
        .card-body .btn.btn-outline-danger:focus {
            box-shadow: none !important;
        }

        .card-body #order-listing_previous {
            margin-right: 5px;
        }
        .card-body #order-listing_previous a {
            border-radius: 0;
        }
        .card-body #order-listing_previous a:focus {
            box-shadow: none;
        }

        .card-body #order-listing_next {
            margin-left: 5px;
        }
        .card-body #order-listing_next a {
            border-radius: 0;
        }
        .card-body #order-listing_next a:focus {
            box-shadow: none;
        }

        .card-body .dropify-wrapper {
            border-radius: 0;
        }
        
        .fa.fa-edit:hover,
        .fa.fa-eye:hover,
        .fa.fa-gift:hover,
        .fa.fa-ship:hover,
        .fa.fa-check:hover,
        .fa.fa-bars:hover{
            color: blue !important;
        }
        .fa.fa-trash:hover,
        .fa.fa-power-off:hover{
            color: red !important;
        }

        #view_order_tabs p {
            margin-bottom: 0;
        }

        #pills-home p {
            margin-bottom: 10px;
        }

        #order_view_product:hover {
            background-color: #D41838 !important;
        }

        #view_withdraw p {
            margin-bottom: 5px;
        }

        .switch {
          position: relative;
          display: inline-block;
          width: 34px;
          height: 17px;
        }

        .switch input { 
          opacity: 0;
          width: 0;
          height: 0;
        }

        .slider {
          position: absolute;
          cursor: pointer;
          top: 4px;
          left: 0;
          right: 0;
          bottom: -4px;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
        }

        .slider:before {
          position: absolute;
          content: "";
          height: 17px;
          width: 16px;
          left: 0;
          bottom: 0;
          background-color: white;
          -webkit-transition: .4s;
          transition: .4s;
        }

        .switch input:checked + .slider {
          background-color: #2196F3;
        }

        .switch input:focus + .slider {
          box-shadow: 0 0 1px #2196F3;
        }

        .switch input:checked + .slider:before {
          -webkit-transform: translateX(18px);
          -ms-transform: translateX(18px);
          transform: translateX(18px);
        }

        .slider.round {
          border-radius: 34px;
        }

        .slider.round:before {
          border-radius: 50%;
        }

        .card-body .bootstrap-select .btn.dropdown-toggle.btn-light {
            border-radius: 0;
        }
        .card-body .bootstrap-select .btn.dropdown-toggle.btn-light:focus {
          outline: none !important;
        }
        .card-body .bootstrap-select .dropdown-menu.show {
          border-radius: 0;
        }
        .card-body .bootstrap-select .inner.show::-webkit-scrollbar {
            width: 8px;
        }
        .card-body .bootstrap-select .inner.show::-webkit-scrollbar-track {
            background-color: transparent;
            border-radius: 5px;
            -webkit-box-shadow: none;
        }
        .card-body .bootstrap-select .inner.show::-webkit-scrollbar-track:hover {
            background-color: #eee;
        }
        .card-body .bootstrap-select .inner.show::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 5px;
            outline: none;
        }
        .card-body .bootstrap-select .inner.show::-webkit-scrollbar-thumb:hover {
            background: #999;
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

        #cke_19,
        #cke_22,
        #cke_18:after,
        #cke_40,
        #cke_43,
        #cke_39:after {
            display: none;
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

        @media only screen and (max-width: 320px) {
            #toast-container > .toast {
              width: 258px;
            }
        }
    </style>
</head>
<body class="sidebar-dark">
    <!-- Contents -->
    @yield('content')

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.1/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-maxlength/1.6.0/bootstrap-maxlength.min.js"></script>

    <script src="{{ asset('node_modules/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('node_modules/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('node_modules/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('node_modules/rickshaw/vendor/d3.v3.js') }}"></script>
    <script src="{{asset('node_modules/rickshaw/rickshaw.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.3/chartist.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartist-plugin-legend/0.6.2/chartist-plugin-legend.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

    @vite('resources/js/app.js')
    @vite('public/js/off-canvas.js')
    @vite('public/js/hoverable-collapse.js')
    @vite('public/js/misc.js')
    @vite('public/js/settings.js')
    @vite('public/js/dashboard_1.js')
    @vite('public/js/bt-maxLength.js')

    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

    @vite('public/js/data-table.js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.1/js/dropify.min.js"></script>

    <script src="{{asset('js/dropify.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.20/jquery.zoom.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.2/basic/ckeditor.js"></script>

    @vite('public/frontend/js/main.js')

    <script>
        var widthLimit = 991;
        var windowWidth = window.innerWidth;
        if(windowWidth <= widthLimit) {
            document.getElementById('dashboard_logo').src = '/images/icon/logo_minimised.webp';
        }
        window.addEventListener('resize', function () {
            var currentWidth = window.innerWidth;
            if (currentWidth <= widthLimit) {
                document.getElementById('dashboard_logo').src = '/images/icon/logo_minimised.webp';
            }
            else {
                document.getElementById('dashboard_logo').src = '/images/icon/logo.webp';
            }
        });
    </script>

    <script>
        function showMenu(){
            var x = document.getElementsByClassName('row row-offcanvas row-offcanvas-right');
            if(x[0].classList.contains('active')){
                x[0].classList.remove('active');
            }
            else{
                x[0].classList.add('active');
            }
            $('#menu_button').tooltip('hide');
        }
    </script>

    @yield('scripts')

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
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

    <script>
        function showOldPassword() {
          var x = document.getElementById("old_password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
        
        function showAllPassword() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
          var y = document.getElementById("password-confirm");
          if (y.type === "password") {
            y.type = "text";
          } else {
            y.type = "password";
          }
          var z = document.getElementById("old_password");
          if (z.type === "password") {
            z.type = "text";
          } else {
            z.type = "password";
          }
        }
    </script>
</body>
</html>
