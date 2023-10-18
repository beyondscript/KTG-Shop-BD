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
                        <li class="active">{{ __('Order Checkout') }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

    <!-- Order Checkout -->
    <div class="section">
        <div class="container">
            @php
                $x = count(Auth::user()->carts);
                if($type == 'CartCheckout'){
                    $shippingcost = 60 * $x;
                }
                elseif($type == 'ProductCheckout'){
                    $shippingcost = 60;
                }
                $total = $total + $shippingcost;
            @endphp
            <form method="POST" action="{{ URL::to('/pay-order/'.$total) }}">
                @csrf

                <div class="row">
                    <div id="ordercheckoutform" class="col-md-7">
                        <div class="billing-details" style="margin-bottom: 0;">
                            <div class="section-title">
                                <h3 class="title">{{ __('Shipping Address') }}</h3>
                            </div>
                            <input type="hidden" name="type" value="{{$type}}">
                            @if($type == 'ProductCheckout')
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" name="size" value="{{$size_and_color['size']}}">
                                <input type="hidden" name="color" value="{{$size_and_color['color']}}">
                                <input type="hidden" name="quantity" value="{{$quantity}}">
                            @endif
                            <div class="form-group">
                                <input style="border: 1px solid #E4E7ED !important;" class="input @error('firstname') is-invalid @enderror" type="text" name="firstname" placeholder="Please enter the first name" value="{{Auth::user()->firstname}}" autofocus>
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert" style="color: red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input style="border: 1px solid #E4E7ED !important;" class="input @error('lastname') is-invalid @enderror" type="text" name="lastname" placeholder="Please enter the last name" value="{{Auth::user()->lastname}}">
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert" style="color: red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input style="border: 1px solid #E4E7ED !important;" class="input @error('email') is-invalid @enderror" type="email" name="email" placeholder="Please enter the e-mail address" value="{{Auth::user()->email}}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert" style="color: red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input style="border: 1px solid #E4E7ED !important;" class="input @error('shippingaddress') is-invalid @enderror" type="text" name="shippingaddress" placeholder="Please enter the shipping address">
                                @error('shippingaddress')
                                    <span class="invalid-feedback" role="alert" style="color: red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input style="border: 1px solid #E4E7ED !important;" class="input @error('phonenumber') is-invalid @enderror" type="text" name="phonenumber" placeholder="Please enter the phone number" value="{{Auth::user()->phonenumber}}">
                                @error('phonenumber')
                                    <span class="invalid-feedback" role="alert" style="color: red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="order-notes">
                            <textarea style="border: 1px solid #E4E7ED !important; margin-bottom: 15px;" class="input @error('note') is-invalid @enderror" name="note" placeholder="Please enter the order note (Optional)"></textarea>
                            @error('note')
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">{{ __('Your Order') }}</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>{{ __('PRODUCT') }}</strong></div>
                                <div><strong>{{ __('SUB-TOTAL') }}</strong></div>
                            </div>
                            <div class="order-products">
                                @if($type == 'CartCheckout')
                                    @foreach(Auth::user()->carts as $crt)
                                        <div class="order-col">
                                            <div>{{$crt->quantity}}{{ __('x') }} {{ $crt->products->productname }}</div>
                                            <div>
                                                {{ __('BDT') }}
                                                @php
                                                    if(is_null($crt->products->discountedprice)){
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
                                                @endphp
                                            </div>
                                        </div>
                                    @endforeach
                                @elseif($type == 'ProductCheckout')
                                    <div class="order-col">
                                        <div>{{$quantity}}{{ __('x') }} {{ $product->productname }}</div>
                                        <div>
                                            {{ __('BDT') }}
                                            @php
                                                if(is_null($product->discountedprice)){
                                                    $price = $product->regularprice;
                                                    $new_price = $quantity * $price;
                                                    echo $new_price;
                                                }
                                                else{
                                                    $price = $product->discountedprice;
                                                    $new_price = $quantity * $price;
                                                    echo $new_price;
                                                }
                                            @endphp
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="order-col">
                                <div>Shipping cost</div>
                                <div>BDT {{$shippingcost}}</div>
                            </div>
                            <div id="addBkashOrNagadCharge" class="order-col"></div>
                            <div class="order-col">
                                <div><strong>{{ __('TOTAL') }}</strong></div>
                                <div>
                                    <strong id="order_total" class="order-total">
                                        {{ __('BDT') }}
                                        {{$total}}
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="payment-method">
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-1" value="COD" onclick="cashOnDeliveryTotal()">
                                <label for="payment-1">
                                    <span></span>
                                    {{ __('Cash On Delivery') }}
                                </label>
                                <div class="caption">
                                    <p>In Cash On Delivery you do not need to make the payment now.</p>
                                    <p style="margin-bottom: 10px;">Please make the payment at the time of the delivery.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-2" value="Bkash" onclick="addBkashCharge()">
                                <label for="payment-2">
                                    <span></span>
                                    {{ __('Bkash') }}
                                </label>
                                <div class="caption">
                                    <p>To make the payment through Bkash please follow below steps:</p>
                                    <p>Step - 1: Go to Bkash mobile menu or Bkash app.</p>
                                    <p>Step - 2: Select the Send Money option.</p>
                                    <p>Step - 3: Now enter this number: 01701896663.</p>
                                    <p>Step - 4: Now enter the exact total amount.</p>
                                    <p>Step - 5: Now enter this as reference: ktgshopbd.</p>
                                    <p>Step - 6: Now enter your Bkash pin and complete the transaction.</p>
                                    <p>Step - 6: Now enter the Transaction ID in the below field.</p>
                                    <div style="margin-top: 10px; margin-bottom: 10px;">
                                        <input style="border: 1px solid #E4E7ED !important;" class="input @error('bkash_tran_id') is-invalid @enderror" type="text" name="bkash_tran_id" placeholder="Please enter the Transaction ID">
                                        @error('bkash_tran_id')
                                            <span class="invalid-feedback" role="alert" style="color: red;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <p style="margin-bottom: 10px;">Note: Bkash charge will not be included on your order details.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-3" value="Nagad" onclick="addNagadCharge()">
                                <label for="payment-3">
                                    <span></span>
                                    {{ __('Nagad') }}
                                </label>
                                <div class="caption">
                                    <p>To make the payment through Nagad please follow below steps:</p>
                                    <p>Step - 1: Go to Nagad mobile menu or Nagad app.</p>
                                    <p>Step - 2: Select the Send Money option.</p>
                                    <p>Step - 3: Now enter this number: 01701896663.</p>
                                    <p>Step - 4: Now enter the exact total amount.</p>
                                    <p>Step - 5: Now enter this as reference: ktgshopbd.</p>
                                    <p>Step - 6: Now enter your Nagad pin and complete the transaction.</p>
                                    <p>Step - 6: Now enter the Transaction ID in the below field.</p>
                                    <div style="margin-top: 10px;">
                                        <input style="border: 1px solid #E4E7ED !important;" class="input @error('nagad_tran_id') is-invalid @enderror" type="text" name="nagad_tran_id" placeholder="Please enter the Transaction ID">
                                        @error('nagad_tran_id')
                                            <span class="invalid-feedback" role="alert" style="color: red;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <p>Note: Nagad charge will not be included on your order details.</p>
                                </div>
                            </div>
                        </div>
                        <button style="width: 100%; border-radius: 0;" class="primary-btn order-submit" type="submit">{{ __('Place Order') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.frontend.footer', ['products' => $best_selling_product])

@endsection

@section('scripts')
<script>
    let title = "@php echo config('app.name', 'Laravel'); @endphp"
    document.title = title + " - Order Checkout"
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
    function cashOnDeliveryTotal() {
        var total = parseInt("@php echo $total; @endphp")
        document.getElementById('order_total').innerHTML = "BDT " + total
        document.getElementById('addBkashOrNagadCharge').innerHTML = ""
    }
    function addBkashCharge() {
        var total = parseInt("@php echo $total; @endphp")
        var bkashCharge = Math.round((total / 1000) * 15)
        var bkashChargedTotal = bkashCharge + total
        document.getElementById('order_total').innerHTML = "BDT " + bkashChargedTotal
        document.getElementById('addBkashOrNagadCharge').innerHTML = "<div>Bkash charge</div><div>BDT " + bkashCharge + "</div>"
    }
    function addNagadCharge() {
        var total = parseInt("@php echo $total; @endphp")
        var nagadCharge = Math.round((total / 1000) * 10)
        var nagadChargedTotal = nagadCharge + total
        document.getElementById('order_total').innerHTML = "BDT " + nagadChargedTotal
        document.getElementById('addBkashOrNagadCharge').innerHTML = "<div>Nagad charge</div><div>BDT " + nagadCharge + "</div>"
    }
</script>
@endsection
