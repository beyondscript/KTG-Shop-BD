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
						<li class="active">{{ __('About Us') }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

    <!-- Search Results -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div id="store" class="col-md-6">
                    <h3 class="title" style="margin-bottom: 15px;">{{ __('Who We Are') }}</h3>
	                <p class="title" style="text-align: justify;">{{ config('app.name', 'Laravel') }} is an online store in Bangladesh that features so many products at affordable prices. As Bangaldesh's online shopping landscape is expanding every year, online shopping in big cities are also gaining momentum. {{ config('app.name', 'Laravel') }} is among best websites for online shopping in bangladesh that promises fast, reliable and convenient delivery of products to your doorstep. {{ config('app.name', 'Laravel') }} being the trusted online store in Bangladesh that aims to provide a trouble-free shopping experience for the people of Bangladesh. Everyone is encouraged to shop with confidence at {{ config('app.name', 'Laravel') }} as our strict buyer’s protection policies ensure no risks while shopping online. Among tons of online stores in Bangladesh, {{ config('app.name', 'Laravel') }} aims to strictly adhere to international quality standards ensuring trust and reliability in customer service and originality in product delivery.</p>
                </div>
                <div id="store" class="col-md-6">
                    <img class="about-us" style="width: 100%; height: 340px;" src="{{asset('images/about-us.webp')}}">
                </div>
            </div>
        </div>
    </div>

    <!-- Other -->
    @include('partials.frontend.other')

    <!-- Footer -->
    @include('partials.frontend.footer', ['products' => $best_selling_product])

    <script>
        let title = "@php echo config('app.name', 'Laravel'); @endphp"
        document.title = title + " - About Us"
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
