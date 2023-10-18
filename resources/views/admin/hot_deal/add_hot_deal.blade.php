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
                        <h1 style="text-align: center;" class="page-title">{{ __('Add a new Hot Deal') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('store.hot.deal') }}" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="discount">{{ __('Discount Percent:') }}</label>
                                        <input id="discount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" placeholder="Enter the discount percent" value="{{ old('discount') }}" autocomplete="discount" autofocus>
                                        @error('discount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="category">{{ __('Select Category:') }}</label>
                                        <select id="category" data-live-search="true" name="category" class="selectpicker @error('category') is-invalid @enderror">
                                            <option disabled selected>{{ __('Nothing selected') }}</option>
                                            @foreach($category as $ctgry)
                                                <option value="{{$ctgry->id}}">{{$ctgry->categoryname}}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="coverimage">{{ __('Cover Image:') }}</label>
                                        <input id="coverimage" type="file" class="dropify @error('coverimage') is-invalid @enderror" name="coverimage" data-height="150" tabindex="-1">
                                        @error('coverimage')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="date">{{ __('Expire Date:') }}</label>
                                        <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date">
                                        @error('date')
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
        document.title = title + " - Add Hot Deal"
    </script>
@endsection
