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
                        <h1 style="text-align: center;" class="page-title">{{ __('Update this Category') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{URL::to('/update-category/'.$category->id)}}" enctype="multipart/form-data">
                                    @method('patch')
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="categoryname">{{ __('Category Name:') }}</label>
                                        <input id="categoryname" type="text" class="form-control @error('categoryname') is-invalid @enderror" name="categoryname" placeholder="Enter the category name" value="{{ $category->categoryname }}" autocomplete="categoryname" autofocus>
                                        @error('categoryname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="categoryimage">{{ __('Category Image (Optional):') }}</label>
                                        <input id="categoryimage" type="file" class="dropify @error('categoryimage') is-invalid @enderror" name="categoryimage" data-height="150" tabindex="-1">
                                        @error('categoryimage')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-success mr-2">{{ __('Update') }}</button>
                                        <a class="btn btn-outline-danger" href="{{ route('all.category') }}">{{ __('Cancel') }}</a>
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
        document.title = title + " - Edit Category"
    </script>
@endsection
