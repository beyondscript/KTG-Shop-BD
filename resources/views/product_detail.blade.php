@extends('layouts.frontend.app')
@section('content')

    <!-- Navbar -->
    @include('partials.frontend.navbar', ['brand' => $brand])

    <!-- Breadcrumb -->
	<div id="breadcrumb" class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb-tree">
						<li><a href="{{ URL::to('/') }}">{{ __('Home') }}</a></li>
                        <li class="active">{{ __('Product Detail') }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

    <!-- Product -->
    <div class="section">
        <div class="container">
            <div class="row">

                <!-- Product images -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="{{asset($product->coverimage)}}" alt="{{$product->productname}}">
                        </div>
                        @foreach($product->otherimages as $othrimgs)
                            <div class="product-preview">
                                <img src="{{asset($othrimgs->otherimage)}}" alt="{{$product->productname}}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        <div class="product-preview">
                            <img src="{{asset($product->coverimage)}}" alt="{{$product->productname}}">
                        </div>
                        @foreach($product->otherimages as $othrimgs)
                            <div class="product-preview">
                                <img src="{{asset($othrimgs->otherimage)}}" alt="{{$product->productname}}">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{$product->productname}}</h2>
                        <div>
                            <div class="product-rating">
                                @php
                                    $rated = floor($product->reviews->avg('rating'));
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
                            <p>{{$product->reviews->count()}} {{ __('Review(s)') }}</p>
                        </div>
                        <div>
                            <h3 class="product-price" style="margin-bottom: 10px;">
                                @if(empty($product->discountedprice))
                                    {{ __('BDT') }} {{ $product->regularprice }}
                                @else
                                    @if($product->regularprice == $product->discountedprice)
                                        {{ __('BDT') }} {{ $product->regularprice }}
                                    @else
                                        {{ __('BDT') }} {{ $product->discountedprice }} <del class="product-old-price">{{ $product->regularprice }}</del>
                                    @endif
                                @endif
                            </h3>
                        </div>
                        @if($product->productquantity == 0)
                            <span class="product-available" style="margin-left: 0;">{{ __('Out of Stock') }}</span>
                        @elseif($product->productquantity > 0)
                            <span class="product-available" style="margin-left: 0;">{{ __('In Stock') }}</span>
                        @endif
                        <p style="font-weight: bold; margin-top: 10px;"><span>&#183;</span> {{ __('Shop:') }} {{$product->shops->shopname}}</p>
                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Category:') }} {{$product->categories->categoryname}}</p>
                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Brand:') }} {{$product->brands->brandname}}</p>
                        <p style="font-weight: bold;"><span>&#183;</span> {{ __('Model:') }} {{$product->productmodel}}</p>
                        <form method="POST" action="{{route('order.checkout')}}">
                            @csrf

                            @if($product->colors->count() > 0 || $product->sizes->count() > 0)
                                <div style="margin-top: 15px;">
                                @if($product->colors->count() > 0)
                                    <div style="display: inline-block; margin-right: 15px; margin-bottom: 0;">
                                        <label style="font-size: 12px; font-weight: 500; text-transform: uppercase;" for="color">{{ __('Color') }}</label>
                                        <select id="color" name="color" class="selectpicker" data-width="90px">
                                            @foreach($product->colors as $color)
                                                <option value="{{$color->colorname}}">{{ $color->colorname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if($product->sizes->count() > 0)
                                    <div style="display: inline-block; margin-bottom: 0;">
                                        <label style="font-size: 12px; font-weight: 500; text-transform: uppercase;" for="size">{{ __('Size') }}</label>
                                        <select id="size" name="size" class="selectpicker" data-width="60px">
                                            @foreach($product->sizes as $size)
                                                <option value="{{$size->sizename}}">{{ $size->sizename }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                </div>
                            @endif
                            <div class="add-to-cart" style="margin-top: 15px; margin-bottom: 15px;">
                                <div class="qty-label">
                                        {{ __('Qty') }}
                                    <div class="input-number">
                                        <input id="prdctqty" style="border: 1px solid #E4E7ED !important;" type="text" name="quantity" value="1">
                                        <span class="qty-up" onclick="plus()">+</span>
                                        <span class="qty-down" onclick="minus()">-</span>
                                    </div>
                                </div>
                                <input type="hidden" name="checkout_type" value="ProductCheckout">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" name="type" value="Required">
                                <button type="submit" class="add-to-cart-btn"><i class="fa fa-handshake-o"></i> {{ __('Order Now') }}</button>
                            </div>
                        </form>
                        <ul class="product-btns" style="display: flex;">
                            @auth
                                @if(Auth::user()->checkwishlists($product->id))
                                    <form action="{{URL::to('/remove-from-wishlist/'.$product->id)}}" method="POST">
                                        @method('delete')
                                        @csrf

                                        <button class="remove_wishlist" type="submit" style="margin-right: 10px;" data-toggle="tooltip" data-placement="top" title="Remove from Wishlist">
                                            <i class="fa fa-heart fa-2x" style="color: red;"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{URL::to('/add-to-wishlist/'.$product->id)}}" method="POST">
                                        @csrf
                                                        
                                        <button class="add_wishlist" type="submit" style="margin-right: 10px;" data-toggle="tooltip" data-placement="top" title="Add to Wishlist">
                                            <i class="fa fa-heart-o fa-2x" style="color: #4e4e4c;"></i>
                                        </button>
                                    </form>
                                @endif
                                @if(Auth::user()->checkcarts($product->id))
                                    <form action="{{URL::to('/remove-from-cart/'.$product->id)}}" method="POST">
                                        @method('delete')
                                        @csrf

                                        <button type="submit" class="add_wishlist" style="margin-left: 10px;" data-toggle="tooltip" data-placement="top" title="Remove from Cart">
                                            <i style="color: red;" class="fa fa-shopping-cart fa-2x"></i>
                                        </button>
                                    </form>
                                @else
                                    <form id="addtocartform" action="{{URL::to('/add-to-cart/'.$product->id)}}" method="POST">
                                        @csrf

                                        <input id="crtprdctcolor" type="hidden" name="color">
                                        <input id="crtprdctsize" type="hidden" name="size">
                                        <input id="crtprdctqty" type="hidden" name="quantity">
                                        <input type="hidden" name="type" value="Required">
                                        <button type="button" class="add_wishlist" style="margin-left: 10px;" data-toggle="tooltip" data-placement="top" title="Add to Cart" onclick="addToCart()">
                                            <i class="fa fa-cart-plus fa-2x" style="color: #4e4e4c;"></i>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <form action="{{URL::to('/add-to-wishlist/'.$product->id)}}" method="POST">
                                    @csrf

                                    <button class="add_wishlist" type="submit" style="margin-right: 10px;" data-toggle="tooltip" data-placement="top" title="Add to Wishlist">
                                        <i class="fa fa-heart-o fa-2x" style="color: #4e4e4c;"></i>
                                    </button>
                                </form>
                                <form id="addtocartform" action="{{URL::to('/add-to-cart/'.$product->id)}}" method="POST">
                                    @csrf

                                    <input id="crtprdctcolor" type="hidden" name="color">
                                    <input id="crtprdctsize" type="hidden" name="size">
                                    <input id="crtprdctqty" type="hidden" name="quantity">
                                    <input type="hidden" name="type" value="Required">
                                    <button type="button" class="add_wishlist" style="margin-left: 10px;" data-toggle="tooltip" data-placement="top" title="Add to Cart" onclick="addToCart()">
                                        <i class="fa fa-cart-plus fa-2x" style="color: #4e4e4c;"></i>
                                    </button>
                                </form>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Product tabs -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">{{ __('Details') }}</a></li>
                            <li><a data-toggle="tab" href="#tab2">{{ __('Specification') }}</a></li>
                            <li><a data-toggle="tab" href="#tab3">{{ __('Reviews') }} {{ __('(') }}{{$product->reviews->count()}}{{ __(')') }}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! $product->productdetail !!}
                                    </div>
                                </div>
                            </div>
                            <div id="tab2" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! $product->productdescription !!}
                                    </div>
                                </div>
                            </div>
                            <div id="tab3" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="rating">
                                            <div class="rating-avg">
                                                @if(empty($product->reviews->avg('rating')))
                                                    <span>{{ __('0.00') }}</span>
                                                @else
                                                    @php
                                                        $rated = $product->reviews->avg('rating');
                                                        $show = number_format($rated, 2);
                                                        echo $show;
                                                    @endphp
                                                @endif
                                                <div class="rating-stars">
                                                    @php
                                                        $rated = floor($product->reviews->avg('rating'));
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
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <div class="rating-stars">
                                                        @php
                                                            $rated = 0;
                                                            while($rated < 5){
                                                                echo('<i class="fa fa-star"></i> ');
                                                                $rated++;
                                                            }
                                                        @endphp
                                                    </div>
                                                    <div class="rating-progress">
                                                        @php
                                                            $five = floor($product->reviews()->where('rating', 5)->count());
                                                            $all = floor($product->reviews->count('rating'));
                                                            if($all == 0){
                                                                echo ('<div></div>');
                                                            }
                                                            else{
                                                                $progress = ($five / $all) * 100;
                                                                if($progress == 0){
                                                                    echo ('<div></div>');
                                                                }
                                                                elseif($progress > 0 && $progress < 6){
                                                                    echo ('<div style="width: 5%;"></div>');
                                                                }
                                                                elseif($progress > 5 && $progress < 11){
                                                                    echo ('<div style="width: 10%;"></div>');
                                                                }
                                                                elseif($progress > 10 && $progress < 16){
                                                                    echo ('<div style="width: 15%;"></div>');
                                                                }
                                                                elseif($progress > 15 && $progress < 21){
                                                                    echo ('<div style="width: 20%;"></div>');
                                                                }
                                                                elseif($progress > 20 && $progress < 26){
                                                                    echo ('<div style="width: 25%;"></div>');
                                                                }
                                                                elseif($progress > 25 && $progress < 31){
                                                                    echo ('<div style="width: 30%;"></div>');
                                                                }
                                                                elseif($progress > 30 && $progress < 36){
                                                                    echo ('<div style="width: 35%;"></div>');
                                                                }
                                                                elseif($progress > 35 && $progress < 41){
                                                                    echo ('<div style="width: 40%;"></div>');
                                                                }
                                                                elseif($progress > 40 && $progress < 46){
                                                                    echo ('<div style="width: 45%;"></div>');
                                                                }
                                                                elseif($progress > 45 && $progress < 51){
                                                                    echo ('<div style="width: 50%;"></div>');
                                                                }
                                                                elseif($progress > 50 && $progress < 56){
                                                                    echo ('<div style="width: 55%;"></div>');
                                                                }
                                                                elseif($progress > 55 && $progress < 61){
                                                                    echo ('<div style="width: 60%;"></div>');
                                                                }
                                                                elseif($progress > 60 && $progress < 66){
                                                                    echo ('<div style="width: 65%;"></div>');
                                                                }
                                                                elseif($progress > 65 && $progress < 71){
                                                                    echo ('<div style="width: 70%;"></div>');
                                                                }
                                                                elseif($progress > 70 && $progress < 76){
                                                                    echo ('<div style="width: 75%;"></div>');
                                                                }
                                                                elseif($progress > 75 && $progress < 81){
                                                                    echo ('<div style="width: 80%;"></div>');
                                                                }
                                                                elseif($progress > 80 && $progress < 86){
                                                                    echo ('<div style="width: 85%;"></div>');
                                                                }
                                                                elseif($progress > 85 && $progress < 91){
                                                                    echo ('<div style="width: 90%;"></div>');
                                                                }
                                                                elseif($progress > 90 && $progress < 96){
                                                                    echo ('<div style="width: 95%;"></div>');
                                                                }
                                                                else{
                                                                    echo ('<div style="width: 100%;"></div>');
                                                                }
                                                            }
                                                        @endphp
                                                    </div>
                                                    <span class="sum">
                                                        @php
                                                            $five = floor($product->reviews()->where('rating', 5)->count());
                                                            echo $five;
                                                        @endphp
                                                    </span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        @php
                                                            $rated = 0;
                                                            while($rated < 4){
                                                                echo('<i class="fa fa-star"></i> ');
                                                                $rated++;
                                                            }
                                                            echo('<i class="fa fa-star-o"></i> ');
                                                        @endphp
                                                    </div>
                                                    <div class="rating-progress">
                                                        @php
                                                            $four = floor($product->reviews()->where('rating', 4)->count());
                                                            $all = floor($product->reviews->count('rating'));
                                                            if($all == 0){
                                                                echo ('<div></div>');
                                                            }
                                                            else{
                                                                $progress = ($four / $all) * 100;
                                                                if($progress == 0){
                                                                    echo ('<div></div>');
                                                                }
                                                                elseif($progress > 0 && $progress < 6){
                                                                    echo ('<div style="width: 5%;"></div>');
                                                                }
                                                                elseif($progress > 5 && $progress < 11){
                                                                    echo ('<div style="width: 10%;"></div>');
                                                                }
                                                                elseif($progress > 10 && $progress < 16){
                                                                    echo ('<div style="width: 15%;"></div>');
                                                                }
                                                                elseif($progress > 15 && $progress < 21){
                                                                    echo ('<div style="width: 20%;"></div>');
                                                                }
                                                                elseif($progress > 20 && $progress < 26){
                                                                    echo ('<div style="width: 25%;"></div>');
                                                                }
                                                                elseif($progress > 25 && $progress < 31){
                                                                    echo ('<div style="width: 30%;"></div>');
                                                                }
                                                                elseif($progress > 30 && $progress < 36){
                                                                    echo ('<div style="width: 35%;"></div>');
                                                                }
                                                                elseif($progress > 35 && $progress < 41){
                                                                    echo ('<div style="width: 40%;"></div>');
                                                                }
                                                                elseif($progress > 40 && $progress < 46){
                                                                    echo ('<div style="width: 45%;"></div>');
                                                                }
                                                                elseif($progress > 45 && $progress < 51){
                                                                    echo ('<div style="width: 50%;"></div>');
                                                                }
                                                                elseif($progress > 50 && $progress < 56){
                                                                    echo ('<div style="width: 55%;"></div>');
                                                                }
                                                                elseif($progress > 55 && $progress < 61){
                                                                    echo ('<div style="width: 60%;"></div>');
                                                                }
                                                                elseif($progress > 60 && $progress < 66){
                                                                    echo ('<div style="width: 65%;"></div>');
                                                                }
                                                                elseif($progress > 65 && $progress < 71){
                                                                    echo ('<div style="width: 70%;"></div>');
                                                                }
                                                                elseif($progress > 70 && $progress < 76){
                                                                    echo ('<div style="width: 75%;"></div>');
                                                                }
                                                                elseif($progress > 75 && $progress < 81){
                                                                    echo ('<div style="width: 80%;"></div>');
                                                                }
                                                                elseif($progress > 80 && $progress < 86){
                                                                    echo ('<div style="width: 85%;"></div>');
                                                                }
                                                                elseif($progress > 85 && $progress < 91){
                                                                    echo ('<div style="width: 90%;"></div>');
                                                                }
                                                                elseif($progress > 90 && $progress < 96){
                                                                    echo ('<div style="width: 95%;"></div>');
                                                                }
                                                                else{
                                                                    echo ('<div style="width: 100%;"></div>');
                                                                }
                                                            }
                                                        @endphp
                                                    </div>
                                                    <span class="sum">
                                                        @php
                                                            $four = floor($product->reviews()->where('rating', 4)->count());
                                                            echo $four;
                                                        @endphp
                                                    </span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        @php
                                                            $rated = 0;
                                                            while($rated < 3){
                                                                echo('<i class="fa fa-star"></i> ');
                                                                $rated++;
                                                            }
                                                            echo('<i class="fa fa-star-o"></i> ');
                                                            echo('<i class="fa fa-star-o"></i> ');
                                                        @endphp
                                                    </div>
                                                    <div class="rating-progress">
                                                        @php
                                                            $three = floor($product->reviews()->where('rating', 3)->count());
                                                            $all = floor($product->reviews->count('rating'));
                                                            if($all == 0){
                                                                echo ('<div></div>');
                                                            }
                                                            else{
                                                                $progress = ($three / $all) * 100;
                                                                if($progress == 0){
                                                                    echo ('<div></div>');
                                                                }
                                                                elseif($progress > 0 && $progress < 6){
                                                                    echo ('<div style="width: 5%;"></div>');
                                                                }
                                                                elseif($progress > 5 && $progress < 11){
                                                                    echo ('<div style="width: 10%;"></div>');
                                                                }
                                                                elseif($progress > 10 && $progress < 16){
                                                                    echo ('<div style="width: 15%;"></div>');
                                                                }
                                                                elseif($progress > 15 && $progress < 21){
                                                                    echo ('<div style="width: 20%;"></div>');
                                                                }
                                                                elseif($progress > 20 && $progress < 26){
                                                                    echo ('<div style="width: 25%;"></div>');
                                                                }
                                                                elseif($progress > 25 && $progress < 31){
                                                                    echo ('<div style="width: 30%;"></div>');
                                                                }
                                                                elseif($progress > 30 && $progress < 36){
                                                                    echo ('<div style="width: 35%;"></div>');
                                                                }
                                                                elseif($progress > 35 && $progress < 41){
                                                                    echo ('<div style="width: 40%;"></div>');
                                                                }
                                                                elseif($progress > 40 && $progress < 46){
                                                                    echo ('<div style="width: 45%;"></div>');
                                                                }
                                                                elseif($progress > 45 && $progress < 51){
                                                                    echo ('<div style="width: 50%;"></div>');
                                                                }
                                                                elseif($progress > 50 && $progress < 56){
                                                                    echo ('<div style="width: 55%;"></div>');
                                                                }
                                                                elseif($progress > 55 && $progress < 61){
                                                                    echo ('<div style="width: 60%;"></div>');
                                                                }
                                                                elseif($progress > 60 && $progress < 66){
                                                                    echo ('<div style="width: 65%;"></div>');
                                                                }
                                                                elseif($progress > 65 && $progress < 71){
                                                                    echo ('<div style="width: 70%;"></div>');
                                                                }
                                                                elseif($progress > 70 && $progress < 76){
                                                                    echo ('<div style="width: 75%;"></div>');
                                                                }
                                                                elseif($progress > 75 && $progress < 81){
                                                                    echo ('<div style="width: 80%;"></div>');
                                                                }
                                                                elseif($progress > 80 && $progress < 86){
                                                                    echo ('<div style="width: 85%;"></div>');
                                                                }
                                                                elseif($progress > 85 && $progress < 91){
                                                                    echo ('<div style="width: 90%;"></div>');
                                                                }
                                                                elseif($progress > 90 && $progress < 96){
                                                                    echo ('<div style="width: 95%;"></div>');
                                                                }
                                                                else{
                                                                    echo ('<div style="width: 100%;"></div>');
                                                                }
                                                            }
                                                        @endphp
                                                    </div>
                                                    <span class="sum">
                                                        @php
                                                            $three = floor($product->reviews()->where('rating', 3)->count());
                                                            echo $three;
                                                        @endphp
                                                    </span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        @php
                                                            echo('<i class="fa fa-star"></i> ');
                                                            echo('<i class="fa fa-star"></i> ');
                                                            $rated = 5;
                                                            while($rated > 2){
                                                                echo('<i class="fa fa-star-o"></i> ');
                                                                $rated--;
                                                            }
                                                        @endphp
                                                    </div>
                                                    <div class="rating-progress">
                                                        @php
                                                            $two = floor($product->reviews()->where('rating', 2)->count());
                                                            $all = floor($product->reviews->count('rating'));
                                                            if($all == 0){
                                                                echo ('<div></div>');
                                                            }
                                                            else{
                                                                $progress = ($two / $all) * 100;
                                                                if($progress == 0){
                                                                    echo ('<div></div>');
                                                                }
                                                                elseif($progress > 0 && $progress < 6){
                                                                    echo ('<div style="width: 5%;"></div>');
                                                                }
                                                                elseif($progress > 5 && $progress < 11){
                                                                    echo ('<div style="width: 10%;"></div>');
                                                                }
                                                                elseif($progress > 10 && $progress < 16){
                                                                    echo ('<div style="width: 15%;"></div>');
                                                                }
                                                                elseif($progress > 15 && $progress < 21){
                                                                    echo ('<div style="width: 20%;"></div>');
                                                                }
                                                                elseif($progress > 20 && $progress < 26){
                                                                    echo ('<div style="width: 25%;"></div>');
                                                                }
                                                                elseif($progress > 25 && $progress < 31){
                                                                    echo ('<div style="width: 30%;"></div>');
                                                                }
                                                                elseif($progress > 30 && $progress < 36){
                                                                    echo ('<div style="width: 35%;"></div>');
                                                                }
                                                                elseif($progress > 35 && $progress < 41){
                                                                    echo ('<div style="width: 40%;"></div>');
                                                                }
                                                                elseif($progress > 40 && $progress < 46){
                                                                    echo ('<div style="width: 45%;"></div>');
                                                                }
                                                                elseif($progress > 45 && $progress < 51){
                                                                    echo ('<div style="width: 50%;"></div>');
                                                                }
                                                                elseif($progress > 50 && $progress < 56){
                                                                    echo ('<div style="width: 55%;"></div>');
                                                                }
                                                                elseif($progress > 55 && $progress < 61){
                                                                    echo ('<div style="width: 60%;"></div>');
                                                                }
                                                                elseif($progress > 60 && $progress < 66){
                                                                    echo ('<div style="width: 65%;"></div>');
                                                                }
                                                                elseif($progress > 65 && $progress < 71){
                                                                    echo ('<div style="width: 70%;"></div>');
                                                                }
                                                                elseif($progress > 70 && $progress < 76){
                                                                    echo ('<div style="width: 75%;"></div>');
                                                                }
                                                                elseif($progress > 75 && $progress < 81){
                                                                    echo ('<div style="width: 80%;"></div>');
                                                                }
                                                                elseif($progress > 80 && $progress < 86){
                                                                    echo ('<div style="width: 85%;"></div>');
                                                                }
                                                                elseif($progress > 85 && $progress < 91){
                                                                    echo ('<div style="width: 90%;"></div>');
                                                                }
                                                                elseif($progress > 90 && $progress < 96){
                                                                    echo ('<div style="width: 95%;"></div>');
                                                                }
                                                                else{
                                                                    echo ('<div style="width: 100%;"></div>');
                                                                }
                                                            }
                                                        @endphp
                                                    </div>
                                                    <span class="sum">
                                                        @php
                                                            $two = floor($product->reviews()->where('rating', 2)->count());
                                                            echo $two;
                                                        @endphp
                                                    </span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        @php
                                                            echo('<i class="fa fa-star"></i> ');
                                                            $rated = 5;
                                                            while($rated > 1){
                                                                echo('<i class="fa fa-star-o"></i> ');
                                                                $rated--;
                                                            }
                                                        @endphp
                                                    </div>
                                                    <div class="rating-progress">
                                                        @php
                                                            $one = floor($product->reviews()->where('rating', 1)->count());
                                                            $all = floor($product->reviews->count('rating'));
                                                            if($all == 0){
                                                                echo ('<div></div>');
                                                            }
                                                            else{
                                                                $progress = ($one / $all) * 100;
                                                                if($progress == 0){
                                                                    echo ('<div></div>');
                                                                }
                                                                elseif($progress > 0 && $progress < 6){
                                                                    echo ('<div style="width: 5%;"></div>');
                                                                }
                                                                elseif($progress > 5 && $progress < 11){
                                                                    echo ('<div style="width: 10%;"></div>');
                                                                }
                                                                elseif($progress > 10 && $progress < 16){
                                                                    echo ('<div style="width: 15%;"></div>');
                                                                }
                                                                elseif($progress > 15 && $progress < 21){
                                                                    echo ('<div style="width: 20%;"></div>');
                                                                }
                                                                elseif($progress > 20 && $progress < 26){
                                                                    echo ('<div style="width: 25%;"></div>');
                                                                }
                                                                elseif($progress > 25 && $progress < 31){
                                                                    echo ('<div style="width: 30%;"></div>');
                                                                }
                                                                elseif($progress > 30 && $progress < 36){
                                                                    echo ('<div style="width: 35%;"></div>');
                                                                }
                                                                elseif($progress > 35 && $progress < 41){
                                                                    echo ('<div style="width: 40%;"></div>');
                                                                }
                                                                elseif($progress > 40 && $progress < 46){
                                                                    echo ('<div style="width: 45%;"></div>');
                                                                }
                                                                elseif($progress > 45 && $progress < 51){
                                                                    echo ('<div style="width: 50%;"></div>');
                                                                }
                                                                elseif($progress > 50 && $progress < 56){
                                                                    echo ('<div style="width: 55%;"></div>');
                                                                }
                                                                elseif($progress > 55 && $progress < 61){
                                                                    echo ('<div style="width: 60%;"></div>');
                                                                }
                                                                elseif($progress > 60 && $progress < 66){
                                                                    echo ('<div style="width: 65%;"></div>');
                                                                }
                                                                elseif($progress > 65 && $progress < 71){
                                                                    echo ('<div style="width: 70%;"></div>');
                                                                }
                                                                elseif($progress > 70 && $progress < 76){
                                                                    echo ('<div style="width: 75%;"></div>');
                                                                }
                                                                elseif($progress > 75 && $progress < 81){
                                                                    echo ('<div style="width: 80%;"></div>');
                                                                }
                                                                elseif($progress > 80 && $progress < 86){
                                                                    echo ('<div style="width: 85%;"></div>');
                                                                }
                                                                elseif($progress > 85 && $progress < 91){
                                                                    echo ('<div style="width: 90%;"></div>');
                                                                }
                                                                elseif($progress > 90 && $progress < 96){
                                                                    echo ('<div style="width: 95%;"></div>');
                                                                }
                                                                else{
                                                                    echo ('<div style="width: 100%;"></div>');
                                                                }
                                                            }
                                                        @endphp
                                                    </div>
                                                    <span class="sum">
                                                        @php
                                                            $one = floor($product->reviews()->where('rating', 1)->count());
                                                            echo $one;
                                                        @endphp
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Product reviews -->
                                    <div class="col-md-6">
                                        <div id="reviews">
                                            <ul class="reviews">
                                                @if($product->reviews->count() == 0)
                                                    <p style="font-weight: bold; text-align: center;">{{ __('This product has no reviews yet.') }}</p>
                                                @endif
                                                @foreach($review as $revw)
                                                    <li>
                                                        <div class="review-heading">
                                                            <h5 class="name">{{$revw->users->firstname}} {{$revw->users->lastname}}</h5>
                                                            <p class="date">{{$revw->created_at}}</p>
                                                            <div class="review-rating">
                                                                @php
                                                                    $rated = floor($revw->rating);
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
                                                        </div>
                                                        <div class="review-body">
                                                            <p style="text-align: justify;">{{$revw->comment}}</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <ul class="reviews-pagination">
                                                {{$review->links('partials.review_pagination')}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="section" style="margin-bottom: 30px;">
        <div id="container" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title" style="text-align: center; width: 100%">{{ __('Related Products') }}</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    @if($related_product->count() == 0)
                        <h3 style="color: red; text-align: center;">{{ __('There are no related products available for this product.') }}</h3>
                    @endif
                    <div class="row">
                        <div class="products-tabs">
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-4">
                                    @foreach($related_product as $prdct)
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
                                <div id="slick-nav-4" class="products-slick-nav"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.frontend.footer', ['products' => $best_selling_product])

@endsection

@section('scripts')
    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        let product = "@php echo $product->productname; @endphp"
        document.title = title + " - " + product
        window.onload = function(){
            $("meta[name='keywords']").remove()
            let meta_viewport = document.querySelector('meta[name="viewport"]')
            let meta_keywords = document.createElement('meta')
            meta_keywords.name = "keywords"
            meta_keywords.content = title + " - " + product + ", " + product
            function insertAfter(referenceNode, newNode) {
                referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling)
            }
            insertAfter(meta_viewport, meta_keywords)
        }
    </script>
    <script>
        var value = parseInt(document.getElementById("prdctqty").value);
        function plus() {
            value = value + 1;
            document.getElementById("prdctqty").value = value;
        }
        function minus() {
            if (value > 1) {
                value = value - 1;
                document.getElementById("prdctqty").value = value;
            }
            else{
                document.getElementById("prdctqty").value = value;
            }
        }
    </script>
    <script>
        function addToCart() {
            var productColors = "@php echo $product->colors->count(); @endphp"
            var productSizes = "@php echo $product->sizes->count(); @endphp"
            if(productColors > 0) {
                document.getElementById('crtprdctcolor').value = document.getElementById('color').value
            }
            if(productSizes > 0) {
                document.getElementById('crtprdctsize').value = document.getElementById('size').value
            }
            document.getElementById('crtprdctqty').value = document.getElementById('prdctqty').value
            document.getElementById('addtocartform').submit()
        }
    </script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
@endsection