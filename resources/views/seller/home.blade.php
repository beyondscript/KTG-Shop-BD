@extends('seller.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('seller.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('seller.partials.sidebar')

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center;" class="page-title">{{ __('Seller Dashboard') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <h2 style="text-align: center;" class="card-title">{{ __('Instructions') }}</h2>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4>{{ __('1. Seller Dashboard:') }}</h4>
                                    <div style="padding-left: 10px;">
                                        <p>{{ __('i. Dashboard menu contains all the instructions for controlling the application.') }}</p>
                                        <p>{{ __('ii. Please read all the instructions for controlling the application.') }}</p>
                                    </div>
                                </div>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4>{{ __('2. Shop:') }}</h4>
                                    <div style="padding-left: 10px;">
                                        <p>{{ __('i. Shop menu contains the functionality for adding a new shop.') }}</p>
                                        <p>{{ __('ii. It shows all the shops stored in the database.') }}</p>
                                        <p>{{ __('iii. It also contains the functionality for editing and deleting a stored shop.') }}</p>
                                    </div>
                                </div>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4>{{ __('3. Product:') }}</h4>
                                    <div style="padding-left: 10px;">
                                        <p>{{ __('i. Product menu contains the functionality for adding a new product.') }}</p>
                                        <p>{{ __('ii. It shows all the products stored in the database.') }}</p>
                                        <p>{{ __('iii. It also contains the functionality for editing and deleting a stored product.') }}</p>
                                    </div>
                                </div>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4>{{ __('4. Order:') }}</h4>
                                    <div style="padding-left: 10px;">
                                        <p>{{ __('i. It shows all the processing orders stored in the database.') }}</p>
                                        <p>{{ __('ii. It shows all the completed orders stored in the database.') }}</p>
                                        <p>{{ __('iii. It shows all the cancelled orders stored in the database.') }}</p>
                                        <p>{{ __('iv. It also contains the functionality for viewing all the stored orders and packaging, shipping and delivering a processing order.') }}</p>
                                    </div>
                                </div>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4>{{ __('5. Withdraw:') }}</h4>
                                    <div style="padding-left: 10px;">
                                        <p>{{ __('i. Withdraw menu contains the functionality for requesting a withdraw.') }}</p>
                                        <p>{{ __('ii. It shows all the withdraws stored in the database.') }}</p>
                                    </div>
                                </div>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4>{{ __('6. Profile:') }}</h4>
                                    <div style="padding-left: 10px;">
                                        <p>{{ __('Profile menu contains the functionality for changing the current password and the profile picture.') }}</p>
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
