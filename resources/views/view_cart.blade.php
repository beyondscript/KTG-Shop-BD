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
                        <li class="active">{{ __('Cart') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Your carts -->
    <div class="section">
        <div id="container" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">{{ __('Your Cart') }}</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    @if(Auth::user()->carts->count() == 0)
                        <h5 class="title">{{ __('Your cart is empty. Please add some products in your cart.') }}</h5>
                    @endif
                    <div class="row">
                        <div class="products-tabs">
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach(Auth::user()->carts as $crt)
                                        <div class="product" id="view_cart_product">
                                            <div class="product-img">
                                                <img src="{{asset($crt->products->coverimage)}}">
                                            </div>
                                            <div id="product-cart" style="height: 200px;" class="product-body">
                                                <h3 class="product-name"><a href="{{URL::to('/product-details/'.$crt->products->id)}}">{{ $crt->products->productname }}</a></h3>
                                                <h4 class="product-price" style="margin-top: 2px;">
                                                    {{ __('Sub-Total:') }} {{ __('BDT') }}
                                                    @php
                                                        if(is_null($crt->products->discountedprice)){
                                                            $quantity = $crt->quantity;
                                                            $price = $crt->products->regularprice;
                                                            $new_price = $quantity * $price;
                                                            echo $new_price;
                                                        }
                                                        else{
                                                            if($crt->products->regularprice == $crt->products->discountedprice){
                                                                $quantity = $crt->quantity;
                                                                $price = $crt->products->regularprice;
                                                                $new_price = $quantity * $price;
                                                                echo $new_price;
                                                            }
                                                            else{
                                                                $quantity = $crt->quantity;
                                                                $price = $crt->products->discountedprice;
                                                                $new_price = $quantity * $price;
                                                                echo $new_price;
                                                            }
                                                        }
                                                    @endphp
                                                </h4>
                                                <div class="product-rating"></div>
                                                <div style="margin-bottom: 5px;">
                                                    <form method="POST" action="{{ URL::to('/update-cart/'.$crt->id) }}">
                                                        @method('patch')
                                                        @csrf

                                                        <label for="quantity">{{ __('QTY') }}</label>
                                                        <fieldset style="display: inline-block; position: relative; width: 102px; margin-right: 5px; margin-left: 5px;">
                                                            <span class="view_cart_quantity_buttons" style="left: 1px;" onclick="minus()">-</span>
                                                            <input style="width: 48px; border: 1px solid #E4E7ED !important; padding: 5px;" value="{{$crt->quantity}}" type="text" id="quantity" name="quantity">
                                                            <span class="view_cart_quantity_buttons" style="right: 1px;" onclick="plus()">+</span>
                                                        </fieldset>
                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="Update Cart">
                                                            <i style="color: green;" class="fa fa-refresh"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="product-btns">
                                                    <a data-toggle="tooltip" data-placement="top" title="Remove from Cart" href="{{'/remove-from-cart/'.$crt->products->id}}" onclick="destroy(event)">
                                                        <i style="color: blue;" class="fa fa-trash">
                                                            <form style="display: none;" action="{{URL::to('/remove-from-cart/'.$crt->products->id)}}" method="POST">
                                                                @method('delete')
                                                                @csrf
                                                            </form>
                                                        </i>
                                                    </a>
                                                </div>
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
    @if(Auth::user()->carts->count() > 0)
        <hr>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div style="text-align: center;">
                            <h4 style="font-size: 24px; color: red; margin-bottom: 10px;">{{ __('Total:') }} {{ __('BDT') }}
                                @php
                                    $subtotal = array();
                                    foreach (Auth::user()->carts as $crt) {
                                        $quantity = $crt->quantity;
                                        if($crt->products->discountedprice){
                                            $price = $crt->products->discountedprice;
                                        }
                                        else{
                                            $price = $crt->products->regularprice;
                                        }
                                        $new_price = $quantity * $price;
                                        array_push($subtotal, $new_price);
                                    }
                                    $total = array_sum($subtotal);
                                    echo $total;
                                @endphp
                            </h4>
                            <form action="{{route('order.checkout')}}" method="post">
                                @csrf

                                <input type="hidden" name="checkout_type" value="CartCheckout">
                                <button id="cart_checkout_button" type="submit" class="primary-btn order-submit" style="border-radius: 0;">{{ __('Procced To Checkout') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Footer -->
    @include('partials.frontend.footer', ['products' => $best_selling_product])

@endsection

@section('scripts')
<script>
    let title = "@php echo config('app.name', 'Laravel'); @endphp"
    document.title = title + " - Your Cart"
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
    function plus() {
        var value = parseInt(document.getElementById("quantity").value);
        value = value + 1;
        document.getElementById("quantity").value = value;
    }
    function minus() {
        var value = parseInt(document.getElementById("quantity").value);
        if (value > 1) {
            value = value - 1;
            document.getElementById("quantity").value = value;
        }
        else{
            document.getElementById("quantity").value = value;
        }
    }
</script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
@endsection
