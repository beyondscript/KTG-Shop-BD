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
                        <h1 style="text-align: center;" class="page-title">{{ __('Request a Withdraw') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                @php
                                    $subearning = array();
                                    foreach ($earnings as $earning) {
                                        array_push($subearning, $earning->earnings);
                                    }
                                    $totalearning = array_sum($subearning);
                                    $subwithdraw = array();
                                    foreach ($withdraws as $withdraw) {
                                        array_push($subwithdraw, $withdraw->amount);
                                    }
                                    $totalwithdraw = array_sum($subwithdraw);
                                    $availableamount = round($totalearning - $totalwithdraw);
                                @endphp
                                <div style="padding-left: 10px; padding-right: 10px;">
                                    <h4 style="text-align: center; margin-bottom: 20px;">{{ __('Available Amount:') }} BDT {{$availableamount}}</h4>
                                </div>
                                <form method="POST" action="{{ route('request.withdraw', $availableamount) }}">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="amount">{{ __('Withdraw Amount:') }}</label>
                                        <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" placeholder="Enter the withdraw amount" value="{{ old('amount') }}" autocomplete="amount" autofocus>
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="method">{{ __('Select Payment Method:') }}</label>
                                        <select id="method" name="method" class="selectpicker @error('method') is-invalid @enderror">
                                            <option disabled selected>{{ __('Nothing selected') }}</option>
                                            <option value="Bkash">{{ __('Bkash') }}</option>
                                            <option value="Nagad">{{ __('Nagad') }}</option>
                                        </select>
                                        @error('method')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-success mr-2">{{ __('Request') }}</button>
                                    </div>
                                </form>
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
        document.title = title + " - Request Withdraw"
    </script>
@endsection
