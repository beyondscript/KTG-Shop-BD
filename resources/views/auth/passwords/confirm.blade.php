@extends('layouts.app')
@section('content')
    <!-- Verify -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="login-form-head" style="background: #ff422f;">
                        <a class="logo" href="{{ URL::to('/') }}"><img style="max-width: 200px; margin-top: 15px;" src="{{ asset('images/icon/logo.webp') }}"></a>
                        <p style="margin-top: 10px; margin-bottom: 0;">{{ __('Please confirm your password') }}</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-group">
                            <label for="password">{{ __('Password:') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Please enter the password" autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="height: 20px;">
                            <label class="switch">
                                <label style="padding-left: 40px; width: 145px; font-size: 14px;">Show Password</label>
                                <input type="checkbox" onclick="showLoginPassword()">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div id="auth_button" class="submit-btn-area">
                            <button id="form_submit" type="submit">{{ __('Confirm Password') }} <i class="ti-arrow-right"></i></button>
                        </div>
                        <div style="margin-top: 10px;">
                            @if (Route::has('password.request'))
                                <a class="authlinks" href="{{ route('password.request') }}">{{ __('Forgot Password') }}</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
