@extends('layouts.app')
@section('content')
    <!-- Register -->
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('custom.register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="login-form-head" style="padding-bottom: 0;">
                        <a class="logo" href="{{ URL::to('/') }}"><img style="max-width: 200px; margin-top: 15px;" src="{{ asset('images/icon/logo.webp') }}" alt="{{ config('app.name', 'Laravel') }}"></a>
                        <p style="margin-top: 10px; margin-bottom: 0;">{{ __('Please Sign up to the system') }}</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-group">
                            <label for="firstname">{{ __('First Name:') }}</label>
                            <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" placeholder="Please enter the first name" value="{{ old('firstname') }}" autocomplete="firstname" autofocus>
                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lastname">{{ __('Last Name:') }}</label>
                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" placeholder="Please enter the last name" value="{{ old('lastname') }}" autocomplete="lastname">
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">{{ __('Select Gender:') }}</label>
                            <select id="gender" name="gender" class="selectpicker @error('gender') is-invalid @enderror">
                                <option disabled selected>{{ __('Nothing selected') }}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dob">{{ __('Date of Birth:') }}</label>
                            <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob">
                            @error('dob')
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
                            <label for="phonenumber">{{ __('Phone Number:') }}</label>
                            <input id="phonenumber" type="text" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" placeholder="Please enter the phone number" value="{{ old('phonenumber') }}" autocomplete="phonenumber">
                            @error('phonenumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">{{ __('Profile Picture:') }}</label>
                            <input id="image" type="file" class="dropify @error('image') is-invalid @enderror" data-height="100" name="image" tabindex="-1">
                            @error('image')
                                <span class="invalid-feedback" style="display: block;" role="alert">
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
                            <button id="form_submit" type="submit">{{ __('Submit') }} <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted" style="margin-bottom: 0;">{{ __('Want to be a seller?') }}</p>
                            <a class="authlinks" href="{{ route('seller.register') }}">{{ __('Sign up') }}</a>
                            <p class="text-muted" style="margin-bottom: 0; margin-top: 10px;">{{ __('Already have an account?') }}</p>
                            <a class="authlinks" href="{{ route('login') }}">{{ __('Sign in') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        document.title = title + " - Register"
        window.onload = function(){
            $("meta[name='keywords']").remove()
            let meta_viewport = document.querySelector('meta[name="viewport"]')
            let meta_keywords = document.createElement('meta')
            meta_keywords.name = "keywords"
            meta_keywords.content = title + ", " + title + " - Register"
            function insertAfter(referenceNode, newNode) {
                referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling)
            }
            insertAfter(meta_viewport, meta_keywords)
        }
    </script>
@endsection
