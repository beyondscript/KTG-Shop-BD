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
                        <h1 style="text-align: center;" class="page-title">{{ __('Add a new Product') }}</h1>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('store.product') }}" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="productname">{{ __('Product Name:') }}</label>
                                        <input id="productname" type="text" class="form-control @error('productname') is-invalid @enderror" name="productname" placeholder="Enter the product name" value="{{ old('productname') }}" autocomplete="productname" autofocus>
                                        @error('productname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productmodel">{{ __('Product Model:') }}</label>
                                        <input id="productmodel" type="text" class="form-control @error('productmodel') is-invalid @enderror" name="productmodel" placeholder="Enter the product model" value="{{ old('productmodel') }}" autocomplete="productmodel">
                                        @error('productmodel')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="brand">{{ __('Select Brand:') }}</label>
                                        <select id="brand" data-live-search="true" name="brand" class="selectpicker @error('brand') is-invalid @enderror">
                                            <option disabled selected>{{ __('Nothing selected') }}</option>
                                            @foreach($brand as $brnd)
                                                <option value="{{$brnd->id}}">{{$brnd->brandname}}</option>
                                            @endforeach
                                        </select>
                                        @error('brand')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="category">{{ __('Select Category:') }}</label>
                                        <select id="category" data-live-search="true" name="category" class="selectpicker @error('category') is-invalid @enderror">
                                            <option disabled selected>{{ __('Nothing selected') }}</option>
                                            @foreach($category as $ctgry)
                                                <option value="{{$ctgry->id}}">{{$ctgry->categoryname}}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="shop">{{ __('Select Shop:') }}</label>
                                        <select id="shop" name="shop" class="selectpicker @error('shop') is-invalid @enderror">
                                            <option disabled selected>{{ __('Nothing selected') }}</option>
                                            @foreach($shop as $shp)
                                                <option value="{{$shp->id}}">{{$shp->shopname}}</option>
                                            @endforeach
                                        </select>
                                        @error('shop')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="coverimage">{{ __('Cover Image:') }}</label>
                                        <input id="coverimage" type="file" class="dropify @error('coverimage') is-invalid @enderror" data-height="150" name="coverimage" tabindex="-1">
                                        @error('coverimage')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div id="otherimage" class="form-group">
                                        <label for="otherimages">{{ __('Other Images (Optional):') }}</label>
                                        <input id="otherimages" type="file" class="dropify @error('otherimages') is-invalid @enderror" data-height="150" name="otherimages[]" multiple tabindex="-1">
                                        @error('otherimages')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="regularprice">{{ __('Regular Price:') }}</label>
                                        <input id="regularprice" type="text" class="form-control @error('regularprice') is-invalid @enderror" name="regularprice" placeholder="Enter the regular price" value="{{ old('regularprice') }}" autocomplete="regularprice">
                                        @error('regularprice')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="discountedprice">{{ __('Discounted Price (Optional):') }}</label>
                                        <input id="discountedprice" type="text" class="form-control @error('discountedprice') is-invalid @enderror" name="discountedprice" placeholder="Enter the discounted price" value="{{ old('discountedprice') }}" autocomplete="discountedprice">
                                        @error('discountedprice')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="colors">{{ __('Select Colors (Optional):') }}</label>
                                        <select id="colors" name="colors[]" class="selectpicker @error('colors') is-invalid @enderror" multiple>
                                            <option value="Black">{{ __('Black') }}</option>
                                            <option value="Red">{{ __('Red') }}</option>
                                            <option value="Green">{{ __('Green') }}</option>
                                            <option value="Yellow">{{ __('Yellow') }}</option>
                                            <option value="Blue">{{ __('Blue') }}</option>
                                            <option value="White">{{ __('White') }}</option>
                                        </select>
                                        @error('colors')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="sizes">{{ __('Select Sizes (Optional):') }}</label>
                                        <select id="sizes" name="sizes[]" class="selectpicker @error('sizes') is-invalid @enderror" multiple>
                                            <option value="M">{{ __('M') }}</option>
                                            <option value="L">{{ __('L') }}</option>
                                            <option value="XL">{{ __('XL') }}</option>
                                            <option value="28">{{ __('28') }}</option>
                                            <option value="30">{{ __('30') }}</option>
                                            <option value="32">{{ __('32') }}</option>
                                        </select>
                                        @error('sizes')
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productquantity">{{ __('Product Quantity:') }}</label>
                                        <input id="productquantity" type="text" class="form-control @error('productquantity') is-invalid @enderror" name="productquantity" placeholder="Enter the product quantity" value="{{ old('productquantity') }}" autocomplete="productquantity">
                                        @error('productquantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productdetail">{{ __('Product Details:') }}</label>
                                        <textarea class="form-control p-input @error('productdetail') is-invalid @enderror" id="productdetail" type="text" name="productdetail" rows="5" placeholder="Enter the product details">{{ old('productdetail') }}</textarea>
                                        @error('productdetail')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productdescription">{{ __('Product Specifications:') }}</label>
                                        <textarea class="form-control p-input @error('productdescription') is-invalid @enderror" id="productdescription" type="text" name="productdescription" rows="5" placeholder="Enter the product specifications">{{ old('productdescription') }}</textarea>
                                        @error('productdescription')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-success mr-2">{{ __('Add') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <!-- Footer -->
                @include('seller.partials.footer')
        
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    let title = "@php echo config('app.name', 'Laravel'); @endphp"
    document.title = title + " - Add Product"
</script>
<script>
    var limit = 3;
    $(document).ready(function(){
        $('#otherimages').change(function(){
            var files = $(this)[0].files;
            if(files.length > limit){
                swal({
                    title: "Oops...",
                    text: "You can not select more than 3 images!",
                    icon: "error",
                    dangerMode: true
                })
                .then(() => {
                    document.getElementById('otherimage').querySelector('button').click();
                    return false;
                });
            }else{
                return true;
            }
        });
    });
</script>
<script>
    CKEDITOR.replace( 'productdetail', {
        contentsCss: ["/css/ckeditor.css"]
    });
    CKEDITOR.replace( 'productdescription', {
        contentsCss: ["/css/ckeditor.css"]
    });
</script>
@endsection
