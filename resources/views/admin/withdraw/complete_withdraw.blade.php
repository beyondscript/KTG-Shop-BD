@extends('admin.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('admin.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('admin.partials.sidebar')

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center;" class="page-title">{{ __('Complete the Withdraw') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{URL::to('/complete-withdraw/'.$withdraw->id)}}">
                                    @method('patch')
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="tran_id">{{ __('Transaction ID:') }}</label>
                                        <input id="tran_id" type="text" class="form-control @error('tran_id') is-invalid @enderror" name="tran_id" placeholder="Enter the transaction id" value="{{ old('tran_id') }}" autocomplete="tran_id">
                                        @error('tran_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-success mr-2">{{ __('Complete') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <!-- Footer -->
                @include('admin.partials.footer')
        
            </div>
        </div>
    </div>

    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        document.title = title + " - Complete Withdraw"
    </script>
@endsection
