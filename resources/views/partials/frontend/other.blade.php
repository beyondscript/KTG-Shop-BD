    <div id="fset-section" class="section">
        <div class="container">
            <div class="row">
                <div id="fset" class="col-md-3">
                    <img src="{{ asset('images/icon/delivery.webp') }}" style="justify-self: center; align-self: flex-end;">
                    <h3 style="margin-top: 10px; text-align: center; align-self: flex-start;">Fast Delivery</h3>
                </div>
                <div id="fset" class="col-md-3">
                    <img src="{{ asset('images/icon/payment.webp') }}" style="justify-self: center; align-self: flex-end;">
                    <h3 style="margin-top: 10px; text-align: center; align-self: flex-start;">Secure Payment</h3>
                </div>
                <div id="fset" class="col-md-3">
                    <img src="{{ asset('images/icon/return.webp') }}" style="justify-self: center; align-self: flex-end;">
                    <h3 style="margin-top: 10px; text-align: center; align-self: flex-start;">Easy Return</h3>
                </div>
                <div id="fset" class="col-md-3">
                    <img src="{{ asset('images/icon/support.webp') }}" style="justify-self: center; align-self: flex-end;">
                    <h3 style="margin-top: 10px; text-align: center; align-self: flex-start;">24/7 Support</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter -->
    <div id="newsletter" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>{{ __('Sign Up for the ') }}<strong>{{ __('NEWSLETTER') }}</strong></p>
                        <form method="POST" action="{{route('subscribe.us')}}" enctype="multipart/form-data">
                            @csrf
                            <input id="email" name="email" class="input" style="border-radius: 0;" type="text" placeholder="Enter Your Email" value="{{ old('email') }}" autocomplete="email">
                            <button class="newsletter-btn" style="border-radius: 0;" type="submit">{{ __(' Subscribe') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>