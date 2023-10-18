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
                        <h1 style="text-align: center;" class="page-title">{{ __('Add a new Brand') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('store.brand') }}">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="brandname">{{ __('Brand Name:') }}</label>
                                        <input id="brandname" type="text" class="form-control @error('brandname') is-invalid @enderror" name="brandname" placeholder="Enter the brand name" value="{{ old('brandname') }}" autocomplete="brandname" autofocus>
                                        @error('brandname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-success mr-2">{{ __('Add') }}</button>
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
        document.title = title + " - Add Brand"
    </script>
@endsection
