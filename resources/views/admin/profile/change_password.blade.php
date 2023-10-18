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
                        <h1 style="text-align: center;" class="page-title">{{ __('Change your Password') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                @php
                                    $type = strtolower(auth()->user()->type);
                                @endphp
                                <form method="POST" action="{{ route('update.password', $type) }}">
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
                                        <label for="password">{{ __('New Password:') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter the new password" value="{{ old('password') }}" autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirm New Password:') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm the new password" autocomplete="new-password">
                                    </div>
                                    <div class="form-group">
                                        <label class="switch">
                                            <label style="padding-left: 40px; width: 145px; font-size: 14px;">Show Password</label>
                                            <input type="checkbox" onclick="showAllPassword()">
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
                @include('admin.partials.footer')
        
            </div>
        </div>
    </div>

    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        document.title = title + " - Change Password"
    </script>
@endsection
