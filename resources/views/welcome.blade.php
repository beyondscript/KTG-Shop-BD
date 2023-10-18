@extends('layouts.frontend.app')
@section('content')

    <!-- Navbar -->
    @include('partials.frontend.navbar', ['brand' => $brand])

    <!-- Hot Deal -->
    @if(empty($hotdeal))
    <p id="days" style="display: none;"></p>
    <p id="hours" style="display: none;"></p>
    <p id="minutes" style="display: none;"></p>
    <p id="seconds" style="display: none;"></p>
    <a id="hotdealshopnow" style="display: none;"></a>
    @else
    <div id="hot-deal" class="section" style="aspect-ratio: 16/9; display: flex; align-items: center; background-image: url({{asset($hotdeal->image)}}); background-size: cover; margin-top: 0; margin-bottom: 0; padding: 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <h2 class="text-uppercase" style="color: #D10024; font-size: 48px; font-weight: 900; margin-bottom: 30px;">{{ __('Get') }} {{$hotdeal->discount}}% off on {{$hotdeal->categories->categoryname}} at {{config('app.name', 'Laravel')}}</h2>
                        @php
                            $newtime = strtotime($hotdeal->date);
                            $time = date('M d, Y',$newtime);
                        @endphp
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3 id="days"></h3>
                                    <span>{{ __('Days') }}</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3 id="hours"></h3>
                                    <span>{{ __('Hours') }}</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3 id="minutes"></h3>
                                    <span>{{ __('Mins') }}</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3 id="seconds"></h3>
                                    <span>{{ __('Secs') }}</span>
                                </div>
                            </li>
                        </ul>
                        <a id="hotdealshopnow" class="primary-btn cta-btn" style="border-radius: 0;" href="{{URL::to('/hot-deal/'.$hotdeal->id)}}">{{ __('Shop now') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Category -->
    @if($category->count() > 0)
    <div class="section">
        <div id="container" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">{{ __('Categories') }}</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-slick" data-nav="#slick-nav-cat">
                            @foreach($category as $ctgry)
                                <div class="col-md-4 col-xs-6">
                                    <div class="shop">
                                        <div class="shop-img">
                                            <img src="{{asset($ctgry->categoryimage)}}" alt="{{$ctgry->categoryname}}">
                                        </div>
                                        <div class="shop-body">
                                            <h3 style="margin-left: -15px;">{{$ctgry->categoryname}}<br>{{ __('Collection') }}</h3>
                                            <a style="margin-left: -15px;" href="{{URL::to('/products-for-category/'.$ctgry->id)}}" class="cta-btn">{{ __('Shop now') }} <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="slick-nav-cat" class="products-slick-nav"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Latest Products -->
    @if($product->count() > 0)
    <div class="section">
        <div id="container" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">{{ __('Latest Products') }}</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach($product as $prdct)
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="{{asset($prdct->coverimage)}}" alt="{{$prdct->productname}}">
                                                <div class="product-label">
                                                    @if($prdct->created_at > $latest_check)
                                                        <span class="new">{{ __('NEW') }}</span>
                                                    @endif
                                                    @if($prdct->productquantity > 0)
                                                        <span class="sale">In Stock</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div style="height: 180px;" class="product-body">
                                                <p class="product-category">{{ $prdct->categories->categoryname}}</p>
                                                <h3 class="product-name"><a href="{{URL::to('/product-details/'.$prdct->id)}}">{{ $prdct->productname }}</a></h3>
                                                <h4 class="product-price">
                                                    @if(empty($prdct->discountedprice))
                                                        {{ __('BDT') }} {{ $prdct->regularprice }}
                                                    @else
                                                        @if($prdct->regularprice == $prdct->discountedprice)
                                                            {{ __('BDT') }} {{ $prdct->regularprice }}
                                                        @else
                                                            {{ __('BDT') }} {{ $prdct->discountedprice }} <del class="product-old-price">{{ $prdct->regularprice }}</del>
                                                        @endif
                                                    @endif
                                                </h4>
                                                <div class="product-rating">
                                                    @php
                                                        $rated = floor($prdct->reviews->avg('rating'));
                                                        $unrated = 5-$rated;
                                                        while($rated > 0){
                                                            echo('<i class="fa fa-star"></i> ');
                                                            $rated--;
                                                        }
                                                        while($unrated > 0){
                                                            echo('<i class="fa fa-star-o"></i> ');
                                                            $unrated--;
                                                        }
                                                    @endphp
                                                </div>
                                                <div class="product-btns">
                                                    @auth
                                                        @if(Auth::user()->checkwishlists($prdct->id))
                                                            <form style="width: fit-content; display: inline-block; margin-right: 5px;" action="{{URL::to('/remove-from-wishlist/'.$prdct->id)}}" method="POST">
                                                                @method('delete')
                                                                @csrf

                                                                <button type="submit" data-toggle="tooltip" data-placement="top" title="Remove from Wishlist">
                                                                    <i style="color: red;" class="fa fa-heart"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form style="width: fit-content; display: inline-block; margin-right: 5px;" action="{{URL::to('/add-to-wishlist/'.$prdct->id)}}" method="POST">
                                                                @csrf

                                                                <button type="submit" data-toggle="tooltip" data-placement="top" title="Add to Wishlist">
                                                                    <i class="fa fa-heart-o"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        @if(Auth::user()->checkcarts($prdct->id))
                                                            <form style="width: fit-content; display: inline-block; margin-left: 5px;" action="{{URL::to('/remove-from-cart/'.$prdct->id)}}" method="POST">
                                                                @method('delete')
                                                                @csrf

                                                                <button type="submit" data-toggle="tooltip" data-placement="top" title="Remove from Cart">
                                                                    <i style="color: red;" class="fa fa-shopping-cart"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form style="width: fit-content; display: inline-block; margin-left: 5px;" action="{{URL::to('/add-to-cart/'.$prdct->id)}}" method="POST">
                                                                @csrf

                                                                <button type="submit" data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                                                    <i class="fa fa-cart-plus"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @else
                                                        <form style="width: fit-content; display: inline-block; margin-right: 5px;" action="{{URL::to('/add-to-wishlist/'.$prdct->id)}}" method="POST">
                                                            @csrf

                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="Add to Wishlist">
                                                                <i class="fa fa-heart-o"></i>
                                                            </button>
                                                        </form>
                                                        <form style="width: fit-content; display: inline-block; margin-left: 5px;" action="{{URL::to('/add-to-cart/'.$prdct->id)}}" method="POST">
                                                            @csrf

                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                                                <i class="fa fa-cart-plus"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <form action="{{route('order.checkout')}}" method="post">
                                                    @csrf

                                                    <input type="hidden" name="checkout_type" value="ProductCheckout">
                                                    <input type="hidden" name="product_id" value="{{$prdct->id}}">
                                                    <button type="submit" id="productaddtocart" class="add-to-cart-btn">
                                                        <i class="fa fa-handshake-o"></i> {{ __('Order Now') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Best Selling Products -->
    @if($product2->count() > 0)
    <div class="section">
        <div id="container" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">{{ __('Best Selling Products') }}</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    @foreach($product2 as $prdct)
                                        @if($prdct->sales > 0)
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="{{asset($prdct->coverimage)}}" alt="{{$prdct->productname}}">
                                                <div class="product-label">
                                                    @if($prdct->created_at > $latest_check)
                                                        <span class="new">{{ __('NEW') }}</span>
                                                    @endif
                                                    @if($prdct->productquantity > 0)
                                                        <span class="sale">In Stock</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div style="height: 180px;" class="product-body">
                                                <p class="product-category">{{ $prdct->categories->categoryname}}</p>
                                                <h3 class="product-name"><a href="{{URL::to('/product-details/'.$prdct->id)}}">{{ $prdct->productname }}</a></h3>
                                                <h4 class="product-price">
                                                    @if(empty($prdct->discountedprice))
                                                        {{ __('BDT') }} {{ $prdct->regularprice }}
                                                    @else
                                                        @if($prdct->regularprice == $prdct->discountedprice)
                                                            {{ __('BDT') }} {{ $prdct->regularprice }}
                                                        @else
                                                            {{ __('BDT') }} {{ $prdct->discountedprice }} <del class="product-old-price">{{ $prdct->regularprice }}</del>
                                                        @endif
                                                    @endif
                                                </h4>
                                                <div class="product-rating">
                                                    @php
                                                        $rated = floor($prdct->reviews->avg('rating'));
                                                        $unrated = 5-$rated;
                                                        while($rated > 0){
                                                            echo('<i class="fa fa-star"></i> ');
                                                            $rated--;
                                                        }
                                                        while($unrated > 0){
                                                            echo('<i class="fa fa-star-o"></i> ');
                                                            $unrated--;
                                                        }
                                                    @endphp
                                                </div>
                                                <div class="product-btns">
                                                    @auth
                                                        @if(Auth::user()->checkwishlists($prdct->id))
                                                            <form style="width: fit-content; display: inline-block; margin-right: 5px;" action="{{URL::to('/remove-from-wishlist/'.$prdct->id)}}" method="POST">
                                                                @method('delete')
                                                                @csrf

                                                                <button type="submit" data-toggle="tooltip" data-placement="top" title="Remove from Wishlist">
                                                                    <i style="color: red;" class="fa fa-heart"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form style="width: fit-content; display: inline-block; margin-right: 5px;" action="{{URL::to('/add-to-wishlist/'.$prdct->id)}}" method="POST">
                                                                @csrf

                                                                <button type="submit" data-toggle="tooltip" data-placement="top" title="Add to Wishlist">
                                                                    <i class="fa fa-heart-o"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        @if(Auth::user()->checkcarts($prdct->id))
                                                            <form style="width: fit-content; display: inline-block; margin-left: 5px;" action="{{URL::to('/remove-from-cart/'.$prdct->id)}}" method="POST">
                                                                @method('delete')
                                                                @csrf

                                                                <button type="submit" data-toggle="tooltip" data-placement="top" title="Remove from Cart">
                                                                    <i style="color: red;" class="fa fa-shopping-cart"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form style="width: fit-content; display: inline-block; margin-left: 5px;" action="{{URL::to('/add-to-cart/'.$prdct->id)}}" method="POST">
                                                                @csrf

                                                                <button type="submit" data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                                                    <i class="fa fa-cart-plus"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @else
                                                        <form style="width: fit-content; display: inline-block; margin-right: 5px;" action="{{URL::to('/add-to-wishlist/'.$prdct->id)}}" method="POST">
                                                            @csrf

                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="Add to Wishlist">
                                                                <i class="fa fa-heart-o"></i>
                                                            </button>
                                                        </form>
                                                        <form style="width: fit-content; display: inline-block; margin-left: 5px;" action="{{URL::to('/add-to-cart/'.$prdct->id)}}" method="POST">
                                                            @csrf

                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                                                <i class="fa fa-cart-plus"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <form action="{{route('order.checkout')}}" method="post">
                                                    @csrf

                                                    <input type="hidden" name="checkout_type" value="ProductCheckout">
                                                    <input type="hidden" name="product_id" value="{{$prdct->id}}">
                                                    <button type="submit" id="productaddtocart" class="add-to-cart-btn">
                                                        <i class="fa fa-handshake-o"></i> {{ __('Order Now') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Top Rated Products -->
    @if($product3->count() > 0)
    <div class="section">
        <div id="container" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">{{ __('Top Rated Products') }}</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-3">
                                    @foreach($product3 as $prdct)
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="{{asset($prdct->coverimage)}}" alt="{{$prdct->productname}}">
                                                <div class="product-label">
                                                    @if($prdct->created_at > $latest_check)
                                                        <span class="new">{{ __('NEW') }}</span>
                                                    @endif
                                                    @if($prdct->productquantity > 0)
                                                        <span class="sale">In Stock</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div style="height: 180px;" class="product-body">
                                                <p class="product-category">{{ $prdct->categories->categoryname}}</p>
                                                <h3 class="product-name"><a href="{{URL::to('/product-details/'.$prdct->id)}}">{{ $prdct->productname }}</a></h3>
                                                <h4 class="product-price">
                                                    @if(empty($prdct->discountedprice))
                                                        {{ __('BDT') }} {{ $prdct->regularprice }}
                                                    @else
                                                        @if($prdct->regularprice == $prdct->discountedprice)
                                                            {{ __('BDT') }} {{ $prdct->regularprice }}
                                                        @else
                                                            {{ __('BDT') }} {{ $prdct->discountedprice }} <del class="product-old-price">{{ $prdct->regularprice }}</del>
                                                        @endif
                                                    @endif
                                                </h4>
                                                <div class="product-rating">
                                                    @php
                                                        $rated = floor($prdct->reviews->avg('rating'));
                                                        $unrated = 5-$rated;
                                                        while($rated > 0){
                                                            echo('<i class="fa fa-star"></i> ');
                                                            $rated--;
                                                        }
                                                        while($unrated > 0){
                                                            echo('<i class="fa fa-star-o"></i> ');
                                                            $unrated--;
                                                        }
                                                    @endphp
                                                </div>
                                                <div class="product-btns">
                                                    @auth
                                                        @if(Auth::user()->checkwishlists($prdct->id))
                                                            <form style="width: fit-content; display: inline-block; margin-right: 5px;" action="{{URL::to('/remove-from-wishlist/'.$prdct->id)}}" method="POST">
                                                                @method('delete')
                                                                @csrf

                                                                <button type="submit" data-toggle="tooltip" data-placement="top" title="Remove from Wishlist">
                                                                    <i style="color: red;" class="fa fa-heart"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form style="width: fit-content; display: inline-block; margin-right: 5px;" action="{{URL::to('/add-to-wishlist/'.$prdct->id)}}" method="POST">
                                                                @csrf

                                                                <button type="submit" data-toggle="tooltip" data-placement="top" title="Add to Wishlist">
                                                                    <i class="fa fa-heart-o"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        @if(Auth::user()->checkcarts($prdct->id))
                                                            <form style="width: fit-content; display: inline-block; margin-left: 5px;" action="{{URL::to('/remove-from-cart/'.$prdct->id)}}" method="POST">
                                                                @method('delete')
                                                                @csrf

                                                                <button type="submit" data-toggle="tooltip" data-placement="top" title="Remove from Cart">
                                                                    <i style="color: red;" class="fa fa-shopping-cart"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form style="width: fit-content; display: inline-block; margin-left: 5px;" action="{{URL::to('/add-to-cart/'.$prdct->id)}}" method="POST">
                                                                @csrf

                                                                <button type="submit" data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                                                    <i class="fa fa-cart-plus"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @else
                                                        <form style="width: fit-content; display: inline-block; margin-right: 5px;" action="{{URL::to('/add-to-wishlist/'.$prdct->id)}}" method="POST">
                                                            @csrf

                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="Add to Wishlist">
                                                                <i class="fa fa-heart-o"></i>
                                                            </button>
                                                        </form>
                                                        <form style="width: fit-content; display: inline-block; margin-left: 5px;" action="{{URL::to('/add-to-cart/'.$prdct->id)}}" method="POST">
                                                            @csrf

                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                                                <i class="fa fa-cart-plus"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <form action="{{route('order.checkout')}}" method="post">
                                                    @csrf

                                                    <input type="hidden" name="checkout_type" value="ProductCheckout">
                                                    <input type="hidden" name="product_id" value="{{$prdct->id}}">
                                                    <button type="submit" id="productaddtocart" class="add-to-cart-btn">
                                                        <i class="fa fa-handshake-o"></i> {{ __('Order Now') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="slick-nav-3" class="products-slick-nav"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Other -->
    @include('partials.frontend.other')

    <!-- Footer -->
    @include('partials.frontend.footer', ['products' => $best_selling_product])

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
<script>
    @php
        if($hotdeal === NULL){
            $date = date('Y-m-d H:i:s');
        }
        else{
            $date = $hotdeal->date;
        }
    @endphp
    var count_id = "@php echo $date; @endphp";
    var countDownDate = new Date(count_id).getTime();
    var x = setInterval(function(){
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var days = Math.floor(distance/(1000 * 60 * 60 * 24));
        var hours = Math.floor((distance%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
        var minutes = Math.floor((distance%(1000 * 60 * 60))/(1000 * 60));
        var seconds = Math.floor((distance%(1000 * 60))/1000);
        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;
        if(distance < 1000){
            var y = document.getElementById("hotdealshopnow");
            y.setAttribute("onclick", "return false;");
            y.style.cursor = "not-allowed";
            clearInterval(x);
            var days = 0;
            var hours = 0;
            var minutes = 0;
            var seconds = 0;
            document.getElementById("days").innerHTML = days;
            document.getElementById("hours").innerHTML = hours;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("seconds").innerHTML = seconds;
        }
    },1000);
</script>
@endsection
