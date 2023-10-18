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
                        <h1 style="text-align: center;" class="page-title">{{ __('All Hot Deals') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="order-listing" class="table table-striped" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Image') }}</th>
                                                        <th>{{ __('Category') }}</th>
                                                        <th>{{ __('Discount Percent') }}</th>
                                                        <th>{{ __('Expire Date') }}</th>
                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($hotdeal as $htdl)
                                                        <tr>
                                                            <td>
                                                                <img style="height: 80px; width: 100px; border-radius: 5px;" src="{{asset($htdl->image)}}">
                                                            </td>
                                                            <td>{{$htdl->categories->categoryname}}</td>
                                                            <td>{{$htdl->discount}}</td>
                                                            <td>
                                                                @php
                                                                    $newtime = strtotime($htdl->date);
                                                                    $time = date('M d, Y',$newtime);
                                                                @endphp
                                                                {{$time}}
                                                            </td>
                                                            <td>
                                                                <a class="fa fa-edit" style="color: green; text-decoration: none;" data-toggle="tooltip" data-placement="top" title="Edit Hot Deal" href="{{URL::to('/edit-hot-deal/'.$htdl->id)}}"></a>
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
        document.title = title + " - All Hot Deals"
    </script>
@endsection
