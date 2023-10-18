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
                        <h1 style="text-align: center;" class="page-title">{{ __('Change your Picture') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                @php
                                    $type = strtolower(auth()->user()->type);
                                @endphp
                                <form method="POST" action="{{ route('update.picture', $type) }}" enctype="multipart/form-data">
                                    @method('patch')
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="profilepicture">{{ __('Profile Picture:') }}</label>
                                        <input id="profilepicture" type="file" class="dropify @error('profilepicture') is-invalid @enderror" name="profilepicture" data-height="150" tabindex="-1">
                                        @error('profilepicture')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-success mr-2">{{ __('Change') }}</button>
                                    </div>
                                </form>
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
        document.title = title + " - Change Picture"
    </script>
@endsection
