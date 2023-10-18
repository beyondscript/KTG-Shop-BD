@extends('seller.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('seller.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('seller.partials.not_approved_sidebar')

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center;" class="page-title">{{ __('Seller Dashboard') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <div style="text-align: center;">
                                    <p>{{ __('Your account is currently under review.') }}</p>
                                    <p>{{ __('Please check back later.') }}</p>
                                    <p>You can also contact the admin for approving your account.</p>
                                    <div style="margin-top: 30px; margin-bottom: 35px;">
                                        <a id="order_view_product" href="mailto:{{ config('app.email', 'Laravel') }}" style="padding: 15px 10px; color: #FEFEFE; background-color: #D10024; font-weight: 700; text-transform: uppercase;">Send Email</a>
                                    </div>
                                    <div style="margin-bottom: 15px;">
                                        <a id="order_view_product" href="tel:{{ config('app.phone', 'Laravel') }}" style="padding: 15px 32px; color: #FEFEFE; background-color: #D10024; font-weight: 700; text-transform: uppercase;">Call</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Footer -->
                @include('seller.partials.footer')
        
            </div>
        </div>
    </div>

    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        document.title = title + " - Seller Dashboard"
    </script>
@endsection
