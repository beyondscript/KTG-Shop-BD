    <!-- Footer -->
    <footer id="footer">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <a href="{{ URL::to('/') }}" class="logo">
                                <img style="max-width: 200px; margin-top: -5px; margin-bottom: 15px;" src="{{ asset('images/icon/logo.webp') }}" alt="{{ config('app.name', 'Laravel') }}">
                            </a>
                            <p style="text-align: justify; font-size: 12px; color: #B9BABC">{{ config('app.name', 'Laravel') }} is an online store in Bangladesh that features so many products at affordable prices. {{ config('app.name', 'Laravel') }} is among the best online store that promises fast, reliable and convenient delivery of products to your doorstep. {{ config('app.name', 'Laravel') }} being the trusted online store that aims to provide a trouble-free shopping experience.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">{{ __('Contact Us') }}</h3>
                            <ul class="footer-links">
                                <li><a href="tel:{{ config('app.phone', 'Laravel') }}"><i class="fa fa-phone"></i> {{ config('app.phone', 'Laravel') }}</a></li>
                                <li><a href="mailto:{{ config('app.email', 'Laravel') }}"><i class="fa fa-envelope-o"></i> {{ config('app.email', 'Laravel') }}</a></li>
                                <li><i class="fa fa-map-marker"></i> {{ config('app.address', 'Laravel') }}</li>
                            </ul>
                            <ul class="footer-ul">
                                <li class="footer-ul-li">
                                    <a href="/facebook" class="footer-ul-li-a" onclick="event.preventDefault();"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li class="footer-ul-li">
                                    <a href="/twitter" class="footer-ul-li-a" onclick="event.preventDefault();"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li class="footer-ul-li">
                                    <a href="/instagram" class="footer-ul-li-a" onclick="event.preventDefault();"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li class="footer-ul-li">
                                    <a href="/pinterest" class="footer-ul-li-a" onclick="event.preventDefault();"><i class="fa fa-pinterest"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix visible-xs"></div>
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">{{ __('Useful Links') }}</h3>
                            <ul class="footer-links">
                                <li><a href="{{ route('product.store') }}">{{ __('Store') }}</a></li>
                                <li><a href="{{ route('contact.us') }}">{{ __('Contact Us') }}</a></li>
                                <li><a href="{{ route('about.us') }}">{{ __('About Us') }}</a></li>
                                <li><a href="{{ route('privacy.policy') }}">{{ __('Privacy Policy') }}</a></li>
                                <li><a href="{{ url('/home') }}">{{ __('My Account') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    @if($products->count() > 0)
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">{{ __('Best Selling Products') }}</h3>
                            <ul class="footer-links">
                                @foreach($products as $product)
                                    @if($product->sales > 0)
                                    <li style="display: flex; align-items: center;">
                                        
                                        <img style="height: 50px; width: 50px; margin-right: 5px;" src="{{asset($product->coverimage)}}">
                                        <a href="{{URL::to('/product-details/'.$product->id)}}">{{$product->productname}}</a>
                                        
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div id="bottom-footer" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <span class="copyright">
                            &copy;{{ now()->year }} All rights reserved | {{ config('app.name', 'Laravel') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>