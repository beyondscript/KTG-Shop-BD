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
                        <h1 style="text-align: center;" class="page-title">{{ __('Processing Orders') }}</h1>
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
                                                        @if($ordrdtl->status != 'Delivered' && $ordrdtl->status != 'Cancelled')
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
                                                                    <a class="fa fa-eye" style="color: green; text-decoration: none; padding-right: 5px;" data-toggle="tooltip" data-placement="top" title="View Order" href="{{URL::to('/seller/view-order/'.$ordrdtl->id)}}"></a>
                                                                    @if($ordrdtl->status == 'Pending')
                                                                        <form style="display: inline;" action="{{URL::to('/process-order/'.$ordrdtl->id)}}" method="POST">
                                                                            @method('patch')
                                                                            @csrf

                                                                            <button class="fa fa-spinner" style="color: green; text-decoration: none; padding-left: 5px; padding-right: 0; border: 0; background-color: transparent; cursor: pointer;" type="submit" data-toggle="tooltip" data-placement="top" title="Process Order"></button>
                                                                        </form>
                                                                    @elseif($ordrdtl->status == 'Processing')
                                                                        <form style="display: inline;" action="{{URL::to('/package-order/'.$ordrdtl->id)}}" method="POST">
                                                                            @method('patch')
                                                                            @csrf

                                                                            <button class="fa fa-gift" style="color: green; text-decoration: none; padding-left: 5px; padding-right: 0; border: 0; background-color: transparent; cursor: pointer;" type="submit" data-toggle="tooltip" data-placement="top" title="Package Order"></button>
                                                                        </form>
                                                                    @elseif($ordrdtl->status == 'Packaged')
                                                                        <form style="display: inline;" action="{{URL::to('/ship-order/'.$ordrdtl->id)}}" method="POST">
                                                                            @method('patch')
                                                                            @csrf

                                                                            <button class="fa fa-ship" style="color: green; text-decoration: none; padding-left: 5px; padding-right: 0; border: 0; background-color: transparent; cursor: pointer;" type="submit" data-toggle="tooltip" data-placement="top" title="Ship Order"></button>
                                                                        </form>
                                                                    @elseif($ordrdtl->status == 'Shipped')
                                                                    <form style="display: inline;" action="{{URL::to('/deliver-order/'.$ordrdtl->id)}}" method="POST">
                                                                            @method('patch')
                                                                            @csrf

                                                                            <button class="fa fa-check" style="color: green; text-decoration: none; padding-left: 5px; padding-right: 0; border: 0; background-color: transparent; cursor: pointer;" type="submit" data-toggle="tooltip" data-placement="top" title="Delever Order"></button>
                                                                        </form>
                                                                    @endif
                                                                </td>
                                                            </tr>
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
                @include('seller.partials.footer')
        
            </div>
        </div>
    </div>

    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        document.title = title + " - Processing Orders"
    </script>
@endsection
