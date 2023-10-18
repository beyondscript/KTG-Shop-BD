@extends('user.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('user.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('user.partials.sidebar')

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center;" class="page-title">{{ __('Dashboard') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <h2 style="text-align: center;" class="card-title">{{ __('Instructions') }}</h2>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4>{{ __('1. Dashboard:') }}</h4>
                                    <div style="padding-left: 10px;">
                                        <p>{{ __('i. Dashboard menu contains all the instructions for controlling the application.') }}</p>
                                        <p>{{ __('ii. Please read all the instructions for controlling the application.') }}</p>
                                    </div>
                                </div>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4>{{ __('2. Order:') }}</h4>
                                    <div style="padding-left: 10px;">
                                        <p>{{ __('i. It shows all the processing orders stored in the database.') }}</p>
                                        <p>{{ __('ii. It shows all the completed orders stored in the database.') }}</p>
                                        <p>{{ __('iii. It shows all the cancelled orders stored in the database.') }}</p>
                                        <p>{{ __('iv. It also contains the functionality for viewing all the stored orders and cancelling a processing order.') }}</p>
                                    </div>
                                </div>
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4>{{ __('3. Profile:') }}</h4>
                                    <div style="padding-left: 10px;">
                                        <p>{{ __('Profile menu contains the functionality for changing the current password and the profile picture.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Footer -->
                @include('user.partials.footer')
        
            </div>
        </div>
    </div>

    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        document.title = title + " - Dashboard"
    </script>
@endsection
