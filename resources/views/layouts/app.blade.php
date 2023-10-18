<!doctype html>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.1/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.8/metisMenu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/slicknav.min.css">
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" media="all" />

    @vite('public/css/typography.css')
    @vite('public/css/default-css.css')
    @vite('public/css/styles.css')
    @vite('public/css/responsive.css')
    @vite('public/css/app.css')
    @vite('public/css/logo.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.1/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">
    <style>
        #main {
          position: relative;
          max-height: 100vh;
          overflow: hidden;
        }

        .ps__scrollbar-y-rail {
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px;
          z-index: 2;
        }

        .login-form-body .form-control {
          border-radius: 0;
        }
        .login-form-body .form-control:focus {
          box-shadow: none;
        }
        .login-form-body .bootstrap-select .btn.dropdown-toggle.btn-light {
          border-radius: 0;
        }
        .login-form-body .bootstrap-select .btn.dropdown-toggle.btn-light:focus {
          outline: none !important;
          box-shadow: none;
        }
        .login-form-body .bootstrap-select .dropdown-menu.show {
          border-radius: 0;
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
          top: 2px;
          left: 0;
          right: 0;
          bottom: -2px;
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

        #auth_button button {
          background: #2C71DA;
          color: #fff;
          box-shadow: none;
          border-radius: 0;
        }

        #auth_button button:hover {
          background: #D10024 !important;
        }

        .authlinks{
          display: flex;
          width: 100%;
          height: 50px;
          text-decoration: none;
          background-color: #2C71DA;
          color: #fff;
          font-weight: 600;
          text-transform: uppercase;
          font-size: 12px;
          margin-left: 0 !important;
          align-items: center;
          justify-content: center;
        }
        .authlinks:hover{
          text-decoration: none;
          background-color: #D10024;
          color: #fff;
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
<body>
  <main id="main">
    <!-- Contents -->
    @yield('content')
  </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.1/js/perfect-scrollbar.jquery.min.js"></script>

    <script>
      var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;
      if(isWindows){
        $('#main').perfectScrollbar();
      }
      else{
        document.getElementById('main').style.overflow = "auto";
      }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.8/metisMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/jquery.slicknav.min.js"></script>

    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.1/js/dropify.min.js"></script>

    <script src="{{ asset('js/dropify.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/js/bootstrap-select.min.js"></script>

    <script>
        function showRegisterPassword() {
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
        }

        function showLoginPassword() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
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
