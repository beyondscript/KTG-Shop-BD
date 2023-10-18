@extends('layouts.app')
@section('content')
    <!-- Login -->
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('custom.login') }}">
                    @csrf
                    
                    <div class="login-form-head" style="padding-bottom: 0;">
                        <a class="logo" href="{{ URL::to('/') }}"><img style="max-width: 200px; margin-top: 15px;" src="{{ asset('images/icon/logo.webp') }}" alt="{{ config('app.name', 'Laravel') }}"></a>
                        <p style="margin-top: 10px; margin-bottom: 0;">{{ __('Please Sign in to the system') }}</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address:') }}</label>
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Please enter the e-mail address" value="{{ old('email') }}" autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
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
                        <div class="row mb-4 rmber-area">
                            <div class="col-12" style="margin-bottom: -38px;">
                                <label class="switch">
                                    <label style="padding-left: 40px; width: 135px; font-size: 14px;" for="remember">{{ __('Remember Me') }}</label>
                                    <input type="checkbox" checked="checked" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div id="auth_button" class="submit-btn-area">
                            <button id="form_submit" type="submit" style="">{{ __('Submit') }} <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5" style="margin-top: 10px !important;">
                            @if (Route::has('password.request'))
                                <a class="authlinks" href="{{ route('password.request') }}">{{ __('Forgot Password') }}</a>
                            @endif
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted" style="margin-bottom: 0;">{{ __('Do not have an account?') }}</p>
                            <a class="authlinks" href="{{ route('register') }}">{{ __('Sign up') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        document.title = title + " - Login"
        window.onload = function(){
            $("meta[name='keywords']").remove()
            let meta_viewport = document.querySelector('meta[name="viewport"]')
            let meta_keywords = document.createElement('meta')
            meta_keywords.name = "keywords"
            meta_keywords.content = title + ", " + title + " - Login"
            function insertAfter(referenceNode, newNode) {
                referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling)
            }
            insertAfter(meta_viewport, meta_keywords)
        }
    </script>
@endsection
