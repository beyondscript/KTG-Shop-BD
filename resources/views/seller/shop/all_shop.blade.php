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
                        <h1 style="text-align: center;" class="page-title">{{ __('All Shops') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="order-listing" class="table table-striped" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Serial') }}</th>
                                                        <th>{{ __('Name') }}</th>
                                                        <th>{{ __('Actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($shop as $shp)
                                                        <tr>
                                                            <td>{{$shp->id}}</td>
                                                            <td>{{$shp->shopname}}</td>
                                                            <td>
                                                                <a class="fa fa-edit" style="color: green; text-decoration: none; padding-right: 5px;" data-toggle="tooltip" data-placement="top" title="Edit Shop" href="{{URL::to('/edit-shop/'.$shp->id)}}"></a>
                                                                <a class="fa fa-trash" style="color: blue; text-decoration: none; padding-left: 5px;" data-toggle="tooltip" data-placement="top" title="Delete Shop" href="{{'/delete-shop/'.$shp->id}}" onclick="destroy(event)">
                                                                    <form style="display: none;" method="post" action="{{URL::to('/delete-shop/'.$shp->id)}}">
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
        document.title = title + " - All Shops"
    </script>
@endsection
