@extends('seller.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('seller.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('seller.partials.sidebar')

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center; margin-bottom: 0;" class="page-title">{{ __('Order Details') }}</h1>
                        <div class="section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="product-main-img" style="margin-bottom: 10px;">
                                            <div class="product-preview">
                                                <img src="{{asset($orderdetail->products->coverimage)}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="product-details">
                                            <h2 class="product-name">{{$orderdetail->products->productname}}</h2>
                                            <p style="font-weight: bold;"><span>&#183;</span> {{ __('Shop:') }} {{$orderdetail->products->shops->shopname}}</p>
                                            <p style="font-weight: bold;"><span>&#183;</span> {{ __('Category:') }} {{$orderdetail->products->categories->categoryname}}</p>
                                            <p style="font-weight: bold;"><span>&#183;</span> {{ __('Brand:') }} {{$orderdetail->products->brands->brandname}}</p>
                                            <p style="font-weight: bold;"><span>&#183;</span> {{ __('Model:') }} {{$orderdetail->products->productmodel}}</p>
                                        </div>
                                        <div id="review-form">
                                            @if(!$orderdetail->reviews()->exists())
                                                @if($orderdetail->status == 'Delivered')
                                                    <h4 style="color: #DA0024;">{{ __('Buyer has not rated this product yet.') }}</h4>
                                                @elseif($orderdetail->status == 'Cancelled')
                                                    <h4 style="color: #DA0024;">{{ __('Sorry, this order is cancelled. Buyer can not rate this product.') }}</h4>
                                                @else
                                                    <h4 style="color: #DA0024;">{{ __('Buyer can rate this product once the delivery is completed.') }}</h4>
                                                @endif
                                            @elseif($orderdetail->reviews()->exists())
                                                <h4 style="color: #DA0024;">{{ __('Buyer review for this order:') }}</h4>
                                                <div id="reviews">
                                                    <ul class="reviews">
                                                        <li>
                                                            <div class="review-heading">
                                                                <h5 class="name">{{$orderdetail->reviews->users->firstname}} {{$orderdetail->reviews->users->lastname}}</h5>
                                                                <p class="date">{{$orderdetail->reviews->created_at}}</p>
                                                                <div class="review-rating">
                                                                    @php
                                                                        $rated = floor($orderdetail->reviews->rating);
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
                                                            <div class="review-body" style="min-height: 91px;">
                                                                <p style="text-align: justify;">{{$orderdetail->reviews->comment}}</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <div style="margin-top: 30px; margin-bottom: 30px;">
                                            <a id="order_view_product" href="{{URL::to('/product-details/'.$orderdetail->products->id)}}" style="padding: 15px 18px; color: #FEFEFE; background-color: #D10024; font-weight: 700; text-transform: uppercase;">View Product</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-5" style="margin-top: 0 !important;" id="view_order_tabs">
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" style="border: 1px solid; margin: 2.5px; width: 120px; text-align: center; border-radius: 0;" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{ __('Info') }}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" style="border: 1px solid; margin: 2.5px; width: 120px; text-align: center; border-radius: 0;" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Details') }}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" style="border: 1px solid; margin: 2.5px; width: 120px; text-align: center; border-radius: 0;" id="pills-profile-tab" data-toggle="pill" href="#pills-profile2" role="tab" aria-controls="pills-profile2" aria-selected="false">{{ __('Description') }}</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="pills-tabContent">
                                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                        @php
                                                            $newtime = strtotime($orderdetail->created_at);
                                                            $time = date('M d, Y',$newtime);
                                                        @endphp
                                                        <p>{{ __('Order Date:') }} {{ $time }}</p>
                                                        <p>{{ __('Transaction ID:') }} {{$orderdetail->orders->trx_id}}</p>
                                                        <p>{{ __('Shipping Address:') }} {{$orderdetail->shippingaddress}}</p>
                                                        @if($orderdetail->orders->type == 'COD')
                                                            <p>{{ __('Payment Method: Cash on Delivery') }}</p>
                                                            
                                                        @else
                                                            <p>{{ __('Payment Method: ') }}{{$orderdetail->orders->type}}</p>
                                                        @endif
                                                        <p>{{ __('Status:') }} {{$orderdetail->status}}</p>
                                                        @if($orderdetail->color)
                                                            <p>{{ __('Product Color:') }} {{$orderdetail->color}}</p>
                                                        @endif
                                                        @if($orderdetail->size)
                                                            <p>{{ __('Product Size:') }} {{$orderdetail->size}}</p>
                                                        @endif
                                                        <p>{{ __('Product Quantity:') }} {{$orderdetail->quantity}}</p>
                                                        <p>{{ __('Sub-Total:') }} BDT {{$orderdetail->total}}</p>
                                                        <p>{{ __('Shipping cost:') }} BDT {{$orderdetail->shippingcost}}</p>
                                                        @php $total = $orderdetail->total + $orderdetail->shippingcost; @endphp
                                                        <p>Total: BDT {{$total}}</p>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                        {!! $orderdetail->products->productdetail !!}
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-profile2" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                        {!! $orderdetail->products->productdescription !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Footer -->
                @include('seller.partials.footer')
        
            </div>
        </div>
    </div>

    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        document.title = title + " - Order Details"
    </script>
@endsection
