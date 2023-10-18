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
                        <li class="active">{{ __('Page Not Found') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Results -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div id="store" class="col-md-12" style="text-align: center;">
                    <img id="notfoundimg" style="width: 366px; height: 206px;" src="{{asset('images/404-not-found.webp')}}">
                    <h3 style="text-transform: uppercase;">Page Not Found</h3>
                    <p style="padding-bottom: 10px; padding-top: 5px;">The page you are looking for might have been removed or temporarily unavailable.</p>
                    <a id="notfoundlink" style="text-transform: uppercase; color: #D10024; padding: 5px; border: 1px solid #D10024; border-radius: 5px;" href="{{route('index')}}">Go To Home</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Other -->
    @include('partials.frontend.other')

    <!-- Footer -->
    @include('partials.frontend.footer', ['products' => $best_selling_product])

@endsection

@section('scripts')
<script>
    let title = "@php echo config('app.name', 'Laravel'); @endphp"
    document.title = title + " - 404 Error"
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
@endsection
