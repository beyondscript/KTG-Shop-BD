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
                        <h1 style="text-align: center;" class="page-title">{{ __('All Sellers') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="order-listing" class="table table-striped" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Name') }}</th>
                                                        <th>{{ __('E-mail') }}</th>
                                                        <th>{{ __('Phone') }}</th>
                                                        <th>{{ __('Earnings') }}</th>
                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($seller as $slr)
                                                        <tr>
                                                            <td>{{$slr->firstname}} {{$slr->lastname}}</td>
                                                            <td>{{$slr->email}}</td>
                                                            <td>{{$slr->phonenumber}}</td>
                                                            <td>
                                                                @php
                                                                    $subearning = array();
                                                                    foreach ($slr->earnings as $earning) {
                                                                        array_push($subearning, $earning->earnings);
                                                                    }
                                                                    $totalearning = array_sum($subearning);
                                                                @endphp
                                                                BDT {{$totalearning}}
                                                            </td>
                                                            <td>
                                                                <form method="post" action="{{URL::to('/disapprove-seller/'.$slr->id)}}">
                                                                    @method('patch')
                                                                    @csrf

                                                                    <button type="submit" class="fa fa-times" style="color: blue; cursor: pointer; border: 0; padding: 0;" data-toggle="tooltip" data-placement="top" title="Disapprove Seller"></button>
                                                                </form>
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
        document.title = title + " - All Sellers"
    </script>
@endsection
