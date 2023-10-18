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
                        <h1 style="text-align: center;" class="page-title">{{ __('Withdraw Details') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <div id="view_withdraw" style="padding-left: 10px; padding-right: 10px;">
                                    <p><strong>{{ __('Amount:') }}</strong> BDT {{$withdraw->amount}}</p>
                                    <p><strong>{{ __('Payment Method:') }}</strong> {{$withdraw->method}}</p>
                                    <p><strong>{{ __('Status:') }}</strong> {{$withdraw->status}}</p>
                                    @if(!empty($withdraw->tran_id))
                                        <p><strong>{{ __('Transaction ID:') }}</strong> {{$withdraw->tran_id}}</p>
                                    @else
                                        <p><strong>{{ __('Transaction ID:') }}</strong> Transaction ID will show here once the withdraw is completed.</p>
                                    @endif
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
        document.title = title + " - Withdraw Details"
    </script>
@endsection
