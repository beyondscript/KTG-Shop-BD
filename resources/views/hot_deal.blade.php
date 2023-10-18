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
						<li class="active">{{ __('Hot Deal') }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

    <!-- Search Results -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">{{ __('Hot Deal Products') }}</h3>
                    </div>
                </div>
                <div id="store" class="col-md-12">
                	@if($product->count() == 0)
	                	<h5 class="title">{{ __('Sorry, no products are available right now. Please check back leter.') }}</h5>
	                @endif
               		<div class="row">
               			@foreach($product as $prdct)
               				<div class="col-md-3 col-xs-6">
                            	<div style="margin-bottom: 60px;" class="product">
                                    <div class="product-img">
                                        <img src="{{asset($prdct->coverimage)}}">
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
                        	</div>
                        @endforeach
                    </div>
					<div class="store-filter clearfix">
						<span class="store-qty">
	                		{{ __('Showing ') }}{{$product->count()}}{{ __(' of ') }}{{$product_all->count()}}{{ __(' products') }}
	            		</span>
						{{$product->links('partials.pagination')}}
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
    document.title = title + " - Hot Deal Products"
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
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
@endsection
