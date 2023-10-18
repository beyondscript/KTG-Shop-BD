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
                        <h1 style="text-align: center;" class="page-title">{{ __('Add a new Category') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('store.category') }}" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="categoryname">{{ __('Category Name:') }}</label>
                                        <input id="categoryname" type="text" class="form-control @error('categoryname') is-invalid @enderror" name="categoryname" placeholder="Enter the category name" value="{{ old('categoryname') }}" autocomplete="categoryname" autofocus>
                                        @error('categoryname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="categoryimage">{{ __('Category Image:') }}</label>
                                        <input id="categoryimage" type="file" class="dropify @error('categoryimage') is-invalid @enderror" name="categoryimage" data-height="150" tabindex="-1">
                                        @error('categoryimage')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
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
        document.title = title + " - Add Category"
    </script>
@endsection
