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
                        <h1 style="text-align: center;" class="page-title">{{ __('Change your Email') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                @php
                                    $type = strtolower(auth()->user()->type);
                                @endphp
                                <form method="POST" action="{{ route('update.email', $type) }}">
                                    @method('patch')
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="old_password">{{ __('Old Password:') }}</label>
                                        <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="Enter the current password" value="{{ old('old_password') }}" autocomplete="old_password" autofocus>
                                        @error('old_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('E-Mail Address:') }}</label>
                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Please enter the e-mail address" value="{{ old('email') }}" autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="switch">
                                            <label style="padding-left: 40px; width: 145px; font-size: 14px;">Show Password</label>
                                            <input type="checkbox" onclick="showOldPassword()">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="form-group mt-5" style="margin-top: 0 !important;">
                                        <button type="submit" class="btn btn-success mr-2">{{ __('Change') }}</button>
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
        document.title = title + " - Change Email"
    </script>
@endsection
