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
                        <h1 style="text-align: center;" class="page-title">{{ __('All Products') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="order-listing" class="table table-striped" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Name') }}</th>
                                                        <th>{{ __('Quantity') }}</th>
                                                        <th>{{ __('Brand') }}</th>
                                                        <th>{{ __('Category') }}</th>
                                                        <th>{{ __('Price') }}</th>
                                                        <th>{{ __('Actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($product as $prdct)
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                <img style="height: 80px; width: 80px; border-radius: 5px;" src="{{asset($prdct->coverimage)}}">
                                                                <br>
                                                                <p>{{ $prdct->productname }}</p>
                                                            </td>
                                                            <td>{{ $prdct->productquantity }}</td>
                                                            <td>{{ $prdct->brands->brandname}}</td>
                                                            <td>{{ $prdct->categories->categoryname}}</td>
                                                            <td>
                                                                @if(empty($prdct->discountedprice))
                                                                    {{ __('BDT') }} {{ $prdct->regularprice }}
                                                                @else
                                                                    @if($prdct->regularprice == $prdct->discountedprice)
                                                                        {{ __('BDT') }} {{ $prdct->regularprice }}
                                                                    @else
                                                                        {{ __('BDT') }} {{ $prdct->discountedprice }}
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a class="fa fa-eye" style="color: green; text-decoration: none; padding-right: 5px;" data-toggle="tooltip" data-placement="top" title="View Product" href="{{URL::to('/product-details/'.$prdct->id)}}"></a>
                                                                <a class="fa fa-edit" style="color: green; text-decoration: none;" data-toggle="tooltip" data-placement="top" title="Edit Product" href="{{URL::to('/edit-product/'.$prdct->id)}}"></a>
                                                                <a class="fa fa-trash" style="color: blue; text-decoration: none; padding-left: 5px;" data-toggle="tooltip" data-placement="top" title="Delete Product" href="{{URL::to('/delete-product/'.$prdct->id)}}" onclick="destroy(event)">
                                                                    <form style="display: none;" method="post" action="{{URL::to('/delete-product/'.$prdct->id)}}">
                                                                        @method('delete')
                                                                        @csrf
                                                                    </form>
                                                                </a>
                                                            </td>
                                                        </tr>
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
        document.title = title + " - All Products"
    </script>
@endsection
