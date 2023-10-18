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
						<li class="active">{{ __('Contact Us') }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

    <!-- Search Results -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div id="store" class="col-md-12">
               		<div class="row">
                        <div class="col-md-6">
                            <span class="contact1-form-title">
                                {{ __('Find us on map') }}
                            </span>
                            <div class="map2" style="height: 425px;">
                                <iframe src="https://maps.google.com/maps?q=ktg shop bd&t=&z=10&ie=UTF8&iwloc=&output=embed" width="600" height="450" frameborder="0" style="border: 0;" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form class="contact1-form validate-form" method="POST" action="{{route('send.message')}}">
                                @csrf

                                <span class="contact1-form-title">
                                    {{ __('Send us a message') }}
                                </span>
                                <div class="wrap-input1 validate-input">
                                    <input id="contact_us_input" class="input1 @error('name') is-invalid @enderror" type="text" name="name" placeholder="Name" autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="wrap-input1 validate-input">
                                    <input id="contact_us_input" class="input1 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Email" autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="wrap-input1 validate-input">
                                    <input id="contact_us_input" class="input1 @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="Phone" autocomplete="phone">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="wrap-input1 validate-input">
                                    <textarea id="contact_us_input" class="input1 @error('message') is-invalid @enderror" type="text" name="message" placeholder="Message"></textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="container-contact1-form-btn">
                                    <button class="contact1-form-btn" type="submit" style="border-radius: 0;">
                                        <span>
                                            {{ __('Send') }}
                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
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
        document.title = title + " - Contact Us"
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
