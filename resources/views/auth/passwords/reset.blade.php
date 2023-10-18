@extends('layouts.app')
@section('content')
    <!-- Verify -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <div class="login-form-head" style="background: #ff422f;">
                        <a class="logo" href="{{ URL::to('/') }}"><img style="max-width: 200px; margin-top: 15px;" src="{{ asset('images/icon/logo.webp') }}"></a>
                        <p style="margin-top: 10px; margin-bottom: 0;">{{ __('Please reset your password') }}</p>
                    </div>
                    <div class="login-form-body">
                        <input type="hidden" name="token" value="{{ $token }}">
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
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password:') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Please confirm the password" autocomplete="new-password">
                        </div>
                        <div class="form-group" style="height: 20px;">
                            <label class="switch">
                                <label style="padding-left: 40px; width: 145px; font-size: 14px;">Show Password</label>
                                <input type="checkbox" onclick="showRegisterPassword()">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div id="auth_button" class="submit-btn-area">
                            <button id="form_submit" type="submit">{{ __('Reset Password') }} <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        document.title = title + " - Reset Password"
        window.onload = function(){
            $("meta[name='keywords']").remove()
            $("meta[name='description']").remove()
            let meta_viewport = document.querySelector('meta[name="viewport"]')
            let meta_robots = document.createElement('meta')
            meta_robots.name = "robots"
            meta_robots.content = "noindex, nofollow"
            function insertAfter(referenceNode, newNode) {
                referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling)
            }
            insertAfter(meta_viewport, meta_robots)
        }
    </script>
@endsection
