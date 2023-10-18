@extends('user.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('user.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('user.partials.sidebar')

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center;" class="page-title">{{ __('Pending Reviews') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="order-listing" class="table table-striped" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Product') }}</th>
                                                        <th>{{ __('Quantity') }}</th>
                                                        <th>{{ __('Sub-Total') }}</th>
                                                        <th>{{ __('Shipping cost') }}</th>
                                                        <th>{{ __('Total') }}</th>
                                                        <th>{{ __('Status') }}</th>
                                                        <th>{{ __('Actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($orderdetail as $ordrdtl)
                                                        @if($ordrdtl->status == 'Delivered')
                                                        	@if(!$ordrdtl->reviews)
	                                                            <tr>
	                                                                <td style="text-align: center;">
	                                                                    <img style="height: 80px; width: 80px; border-radius: 5px;" src="{{asset($ordrdtl->products->coverimage)}}">
	                                                                    <br>
	                                                                    <p>{{ $ordrdtl->products->productname }}</p>
	                                                                </td>
	                                                                <td>{{ $ordrdtl->quantity }}</td>
	                                                                <td>{{ __(' BDT') }} {{ $ordrdtl->total }}</td>
	                                                                <td>BDT {{ $ordrdtl->shippingcost }}</td>
	                                                                @php $total = $ordrdtl->total + $ordrdtl->shippingcost; @endphp
	                                                                <td>BDT {{ $total }}</td>
	                                                                <td>{{ $ordrdtl->status }}</td>
	                                                                <td>
	                                                                    <a class="fa fa-comments" style="color: green; text-decoration: none; padding-right: 5px;" data-toggle="tooltip" data-placement="top" title="Review Order" href="{{URL::to('/view-order/'.$ordrdtl->id)}}"></a>
	                                                                </td>
	                                                            </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Footer -->
                @include('user.partials.footer')
        
            </div>
        </div>
    </div>

    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        document.title = title + " - Pending Reviews"
    </script>
@endsection
