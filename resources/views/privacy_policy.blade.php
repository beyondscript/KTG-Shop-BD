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
						<li class="active">{{ __('Privacy Policy') }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

    <!-- Search Results -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title" style="margin-bottom: 20px; margin-top: 0;">
                        <h5 class="title" style="margin-bottom: 10px;"><i class="fa fa-play" aria-hidden="true"></i> {{ __('Who we are') }}</h5>
                        <p style="text-align: justify;">Our website address is: <a class="privacy-a" href="{{ route('index') }}">{{ config('app.url', 'Laravel') }}</a>.</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="section-title" style="margin-bottom: 20px; margin-top: 0;">
                        <h5 class="title" style="margin-bottom: 10px;"><i class="fa fa-play" aria-hidden="true"></i> {{ __('Reviews') }}</h5>
                        <p style="text-align: justify;">When any user leave reviews on our site we collect the data. If any user submit any review then their profile picture will be visible to the public in the context of his/her review.</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="section-title" style="margin-bottom: 20px; margin-top: 0;">
                        <h5 class="title" style="margin-bottom: 10px;"><i class="fa fa-play" aria-hidden="true"></i> {{ __('Media') }}</h5>
                        <p style="text-align: justify;">If you upload images to our website then you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="section-title" style="margin-bottom: 20px; margin-top: 0;">
                        <h5 class="title" style="margin-bottom: 10px;"><i class="fa fa-play" aria-hidden="true"></i> {{ __('Cookies') }}</h5>
                        <p style="text-align: justify;">When you login if you select “Remember Me” we will set up a cookie to persist your login for thirty three days. If you logout of your account then the cookie will be removed.</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="section-title" style="margin-bottom: 20px; margin-top: 0;">
                        <h5 class="title" style="margin-bottom: 10px;"><i class="fa fa-play" aria-hidden="true"></i> {{ __('Embedded content from other websites') }}</h5>
                        <p style="text-align: justify;">
                            Contents on this site may include embedded content like videos, images etc. Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.
                            <br>
                            <br>
                            These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.
                        </p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="section-title" style="margin-bottom: 20px; margin-top: 0;">
                        <h5 class="title" style="margin-bottom: 10px;"><i class="fa fa-play" aria-hidden="true"></i> {{ __('How long we retain your data') }}</h5>
                        <p style="text-align: justify;">
                            If any user leave a review then the review and it's metadata are retained indefinitely.
                            <br>
                            <br>
                            If any user register on our website then we store the personal information he/she provide in their user profile. All users can see, edit or delete their personal information at any time. Website administrators can also see and edit that information.
                        </p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="section-title" style="margin-bottom: 20px; margin-top: 0;">
                        <h5 class="title" style="margin-bottom: 10px;"><i class="fa fa-play" aria-hidden="true"></i> {{ __('Where your data is sent') }}</h5>
                        <p style="text-align: justify;">User reviews may be checked through an automated spam detection service.</p>
                    </div>
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
        document.title = title + " - Privacy Policy"
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
