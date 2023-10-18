@extends('layouts.app')
@section('content')
    <!-- Verify -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf

                    <div class="login-form-head" style="background: #ff422f;">
                        <a class="logo" href="{{ URL::to('/') }}"><img style="max-width: 200px; margin-top: 15px;" src="{{ asset('images/icon/logo.webp') }}"></a>
                        <p style="margin-top: 10px; margin-bottom: 0;">{{ __('Please verify your e-mail address') }}</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email, click the below button to request another.') }}
                        </div>
                        <div id="auth_button" class="submit-btn-area">
                            <button id="form_submit" type="submit">{{ __('Send Link') }} <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        document.title = title + " - Verify Email"
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
