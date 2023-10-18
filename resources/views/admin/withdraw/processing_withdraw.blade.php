@extends('admin.layouts.app')
@section('content')
    <div class="container-scroller">

        <!-- Navbar -->
        @include('admin.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- Sidebar -->
                @include('admin.partials.sidebar')

                    <!-- Main -->
                    <div class="content-wrapper">
                        <h1 style="text-align: center;" class="page-title">{{ __('Processing Withdraws') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="order-listing" class="table table-striped" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Amount') }}</th>
                                                        <th>{{ __('Payment Method') }}</th>
                                                        <th>{{ __('Number') }}</th>
                                                        <th>{{ __('Status') }}</th>
                                                        <th>{{ __('Actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($withdraws as $withdraw)
                                                        <tr>
                                                            <td>BDT {{$withdraw->amount}}</td>
                                                            <td>{{$withdraw->method}}</td>
                                                            @if($withdraw->method == 'Bkash')
                                                                <td>{{$withdraw->users->sellerdetails->bkashnumber}}</td>
                                                            @elseif($withdraw->method == 'Nagad')
                                                                <td>{{$withdraw->users->sellerdetails->nagadnumber}}</td>
                                                            @endif
                                                            <td>{{$withdraw->status}}</td>
                                                            <td>
                                                                <a class="fa fa-eye" style="color: green; text-decoration: none; padding-right: 5px;" data-toggle="tooltip" data-placement="top" title="View Withdraw" href="{{URL::to('/admin/view-withdraw/'.$withdraw->id)}}"></a>
                                                                <a class="fa fa-check" style="color: green; text-decoration: none; padding-left: 5px;" data-toggle="tooltip" data-placement="top" title="Complete Withdraw" href="{{URL::to('/complete-withdraw/'.$withdraw->id)}}"></a>
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
                @include('admin.partials.footer')
        
            </div>
        </div>
    </div>

    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        document.title = title + " - Processing Withdraws"
    </script>
@endsection
