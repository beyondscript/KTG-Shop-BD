<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Review;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\Hotdeal;
use Carbon\Carbon;
use Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriberWelcomeEmail2;
use App\Mail\SendMessageEmail;

class FrontendController extends Controller
{
    public function welcome()
    {
    	$brand=Brand::orderBy('brandname', 'ASC')->get();
    	$category=Category::orderBy('categoryname', 'ASC')->get();
        $best_selling_product=Product::where('sales', '>=', 1)->orderBy('sales', 'DESC')->take(3)->get();
    	$product=Product::whereDate('created_at', '>', Carbon::now()->subMonth(6)->toDateTimeString())->orderBy('created_at', 'DESC')->get();
        $product2=Product::where('sales', '>=', 1)->orderBy('sales', 'DESC')->take(100)->get();
        $avg_rated_products=Review::select('product_id', Review::raw('AVG(rating) as rating'))->groupBy('product_id')->orderBy('rating', 'DESC')->get();
        $product_ids=[];
        $latest_check = Carbon::now()->subMonth(6)->toDateTimeString();
        $hotdeal = Hotdeal::where('expired', false)->first();
        foreach ($avg_rated_products as $avg_rated_product) {
            array_push($product_ids, $avg_rated_product->product_id);
        }
        $unsorted_product_ids = implode(',', $product_ids);
        if ($unsorted_product_ids) {
            $product3=Product::WhereIn('id', $product_ids)->orderBy(Product::raw("FIELD(id, $unsorted_product_ids)"))->get();
            return view('welcome', compact('brand', 'best_selling_product', 'category', 'product', 'product2', 'product3', 'latest_check', 'hotdeal'));
            
        }
        else{
            $product3=Product::WhereIn('id', $product_ids)->get();
            return view('welcome', compact('brand', 'best_selling_product', 'category', 'product', 'product2', 'product3', 'latest_check', 'hotdeal'));
        }
    }

    public function searchresult(Request $request)
    {
        Paginator::useBootstrap();
        $search_product=$request->input('keyword');
        $brand_id=Brand::where('brandname', 'like', '%' . $search_product . '%')->pluck('id');
        $category_id=Category::where('categoryname', 'like', '%' . $search_product. '%')->pluck('id');
        $latest_check = Carbon::now()->subMonth(6)->toDateTimeString();
        if (isset($search_product) && !$brand_id->isEmpty()) {
            $product=Product::where('brand_id', $brand_id)->orWhere('productname', 'like', '%' . $search_product . '%')->orWhere('productmodel', 'like', '%' . $search_product . '%')->orderBy('productname', 'ASC')->paginate(12);
            $product_all=Product::where('brand_id', $brand_id)->orWhere('productname', 'like', '%' . $search_product . '%')->orWhere('productmodel', 'like', '%' . $search_product . '%')->orderBy('productname', 'ASC')->get();
            $product->appends(['product' => $search_product]);
            $brand=Brand::orderBy('brandname', 'ASC')->get();
            $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
            return view('searchproduct', compact('product', 'brand', 'best_selling_product', 'search_product', 'product_all', 'latest_check'));
        }
        elseif (isset($search_product) && !$category_id->isEmpty()) {
            $product=Product::where('category_id', $category_id)->orWhere('productname', 'like', '%' . $search_product . '%')->orWhere('productmodel', 'like', '%' . $search_product . '%')->orderBy('productname', 'ASC')->paginate(12);
            $product_all=Product::where('category_id', $category_id)->orWhere('productname', 'like', '%' . $search_product . '%')->orWhere('productmodel', 'like', '%' . $search_product . '%')->orderBy('productname', 'ASC')->get();
            $product->appends(['product' => $search_product]);
            $brand=Brand::orderBy('brandname', 'ASC')->get();
            $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
            return view('searchproduct', compact('product', 'brand', 'best_selling_product', 'search_product', 'product_all', 'latest_check'));
        }
        elseif(isset($search_product)) {
            $product=Product::where('productname', 'like', '%' . $search_product . '%')->orWhere('productmodel', 'like', '%' . $search_product . '%')->orderBy('productname', 'ASC')->paginate(12);
            $product_all=Product::where('productname', 'like', '%' . $search_product . '%')->orWhere('productmodel', 'like', '%' . $search_product . '%')->orderBy('productname', 'ASC')->get();
            $product->appends(['product' => $search_product]);
            $brand=Brand::orderBy('brandname', 'ASC')->get();
            $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
            return view('searchproduct', compact('product', 'brand', 'best_selling_product', 'search_product', 'product_all', 'latest_check'));
        }
        else{
            $notification = array(
                'message' => 'Please insert a keyword',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function addtowishlist($id){
        $wishlist = new Wishlist;
        $wishlist->product_id=$id;
        $wishlist->user_id=Auth::user()->id;
        $wishlist->save();

        $notification = array(
            'message' => 'Product successfully added to wishlist',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function showwishlist(){
        Paginator::useBootstrap();
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
        $user_id=Auth::user()->id;
        $product_id=Wishlist::where('user_id', $user_id)->pluck('product_id');
        $product=Product::whereIn('id', $product_id)->paginate(12);
        $product_all=Product::whereIn('id', $product_id)->get();
        $latest_check = Carbon::now()->subMonth(6)->toDateTimeString();
        return view('wishlist', compact('brand', 'best_selling_product', 'product', 'product_all', 'latest_check'));
    }

    public function removefromwishlist($id)
    {
        $user_id=Auth::user()->id;
        $wishlist=Wishlist::where('product_id', $id)->where('user_id', $user_id);
        $wishlist->delete();

        $notification = array(
            'message' => 'Product successfully removed from wishlist',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function categorywiseproduct($id){
        Paginator::useBootstrap();
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
        $category=Category::findorfail($id);
        $product=Product::where('category_id', $id)->paginate(9);
        $product_all=Product::where('category_id', $id)->get();
        $latest_check = Carbon::now()->subMonth(6)->toDateTimeString();
        return view('category_wise', compact('brand', 'best_selling_product', 'category', 'product', 'product_all', 'latest_check'));
    }

    public function categorywisebrandproduct(Request $request){
        Paginator::useBootstrap();
        $brand_id=$request->brand_id;
        $cat_id=$request->cat_id;
        $latest_check = Carbon::now()->subMonth(6)->toDateTimeString();
        if ($brand_id == 0) {
            $product=Product::where('category_id', $cat_id)->paginate(9);
            $product_all=Product::where('category_id', $cat_id)->get();
            return view('category_wise_brand', compact('product', 'product_all', 'latest_check'));
        }
        else{
            $product=Product::where('category_id', $cat_id)->where('brand_id', $brand_id)->paginate(9);
            $product_all=Product::where('category_id', $cat_id)->where('brand_id', $brand_id)->get();
            return view('category_wise_brand', compact('product', 'product_all', 'latest_check'));
        }
    }

    public function brandwiseproduct($id){
        Paginator::useBootstrap();
        $category=Category::orderBy('categoryname', 'ASC')->get();
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
        $brand2=Brand::findorfail($id);
        $product=Product::where('brand_id', $id)->paginate(9);
        $product_all=Product::where('brand_id', $id)->get();
        $latest_check = Carbon::now()->subMonth(6)->toDateTimeString();
        return view('brand_wise', compact('category', 'brand', 'best_selling_product', 'brand2', 'product', 'product_all', 'latest_check'));
    }

    public function brandwisecategoryproduct(Request $request){
        Paginator::useBootstrap();
        $cat_id=$request->cat_id;
        $brand_id=$request->brand_id;
        $latest_check = Carbon::now()->subMonth(6)->toDateTimeString();
        if ($cat_id == 0) {
            $product=Product::where('brand_id', $brand_id)->paginate(9);
            $product_all=Product::where('brand_id', $brand_id)->get();
            return view('brand_wise_category', compact('product', 'product_all', 'latest_check'));
        }
        else{
            $product=Product::where('brand_id', $brand_id)->where('category_id', $cat_id)->paginate(9);
            $product_all=Product::where('brand_id', $brand_id)->where('category_id', $cat_id)->get();
            return view('brand_wise_category', compact('product', 'product_all', 'latest_check'));
        }
    }

    public function productstore(){
        Paginator::useBootstrap();
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
        $product=Product::orderBy('productname', 'ASC')->paginate(12);
        $product_all=Product::orderBy('productname', 'ASC')->get();
        $latest_check = Carbon::now()->subMonth(6)->toDateTimeString();
        return view('product_store', compact('brand', 'best_selling_product', 'product', 'product_all', 'latest_check'));
    }

    public function contactus(){
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
        return view('contact_us', compact('brand', 'best_selling_product'));
    }

    public function aboutus(){
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
        return view('about_us', compact('brand', 'best_selling_product'));
    }

    public function productdetail($id){
        Paginator::useBootstrap();
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
        $product=Product::findorfail($id);
        $review=Review::where('product_id', $id)->orderBy('id', 'ASC')->paginate(3);
        $category_id=$product->category_id;
        $related_product=Product::where('id', '!=', $id)->where('category_id', $category_id)->get();
        $latest_check = Carbon::now()->subMonth(6)->toDateTimeString();
        return view('product_detail', compact('brand', 'best_selling_product', 'product', 'review', 'related_product', 'latest_check'));
    }

    public function subscribeus(Request $request){
        $email_regex = '/([a-zA-Z0-9!#$%&’?^_`~-])+@([a-zA-Z0-9-])+(.com)+/';
        if(!$request->email){
            $notification = array(
                'message' => 'Please insert an email',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }

        if(!preg_match($email_regex, $request->email)){
            $notification = array(
                'message' => 'Please insert a valid email',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }

        $email = $request->email;
        $subscribed = Subscriber::where('email', $email)->pluck('email');
        if (!$subscribed->isEmpty()) {
            $notification = array(
                'message' => 'You have already Subscribed',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
        else{
            $subscriber = new Subscriber;
            $subscriber->email = $email;
            $subscriber->save();
            Mail::to($email)->send(new SubscriberWelcomeEmail2($email));
            $notification = array(
                'message' => 'Thank you for Subscribing to us',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function unsubscribeus($email){
        $subscribed = Subscriber::where('email', $email)->pluck('email');
        if (!$subscribed->isEmpty()) {
            $subscribed = Subscriber::where('email', $email)->delete();
            $notification = array(
                'message' => 'You have successfully Unsubscribed',
                'alert-type' => 'error'
            );
            return redirect()->route('index')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'You have already Unsubscribed',
                'alert-type' => 'error'
            );
            return redirect()->route('index')->with($notification);
        }
    }

    public function addtocart(Request $request, $id){
        $product = Product::where('id', $id)->first();

        if ($request->quantity) {
            if (filter_var($request->quantity, FILTER_VALIDATE_INT) === false){
                $notification = array(
                    'message' => 'Product quantity must be an integer',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }

            if($request->quantity < 1){
                $notification = array(
                    'message' => 'Product quantity must be at least 1',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }

            $quantity = $request->quantity;
        }
        else{
            if($request->type == 'Required'){
                if($request->quantity == '0'){
                    $notification = array(
                        'message' => 'Product quantity must be at least 1',
                        'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }

                $notification = array(
                    'message' => 'Product quantity is required',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }

            if($product->colors->count() > 0 || $product->sizes->count() > 0){
                return Redirect()->to('/product-details/'.$id);
            }

            $quantity = 1;
        }
        
        $product_quantity=$product->productquantity;
        if ($quantity > $product_quantity) {
            $notification = array(
                'message' => 'Your requested product quantity is not available',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
        else if($quantity <= $product_quantity){
            $user_id=Auth::user()->id;
            $cart_already=Cart::where('product_id', $id)->where('user_id', $user_id)->get();
            if (count($cart_already) > 0) {
                $notification = array(
                    'message' => 'Product is already added to cart',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
            else{
                $wishlist = Wishlist::where('product_id', $id)->where('user_id', $user_id);
                $wishlist->delete();

                $cart = new Cart;
                $cart->quantity=$quantity;
                if($request->color){
                    $cart->color = $request->color;
                }
                if($request->size){
                    $cart->size = $request->size;
                }
                $cart->product_id=$id;
                $cart->user_id=Auth::user()->id;
                $cart->save();

                $notification = array(
                    'message' => 'Product successfully added to cart',
                    'alert-type' => 'success'
                );
                return Redirect()->back()->with($notification);
            }
        }
    }

    public function viewcart(){
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
        return view('view_cart', compact('brand', 'best_selling_product'));
    }

    public function updatecart(Request $request, $id){
        if ($request->quantity) {
            if (filter_var($request->quantity, FILTER_VALIDATE_INT) === false){
                $notification = array(
                    'message' => 'Product quantity must be an integer',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
            
            if($request->quantity < 1){
                $notification = array(
                    'message' => 'Product quantity must be at least 1',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }

            $quantity = $request->quantity;
        }
        else{
            if($request->quantity == '0'){
                $notification = array(
                    'message' => 'Product quantity must be at least 1',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }

            $notification = array(
                'message' => 'Product quantity is required',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }

        $cart=Cart::findorfail($id);

        $product_quantity=Product::where('id', $cart->product_id)->value('productquantity');
        if ($quantity > $product_quantity) {
            $notification = array(
                'message' => 'Your requested product quantity is not available',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
        else if($quantity <= $product_quantity){
            if ($cart->quantity == $quantity) {
                $notification = array(
                    'message' => 'You have not updated the quantity',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
            else{
                $cart->quantity=$quantity;
                $cart->save();

                $notification = array(
                    'message' => 'Cart successfully updated',
                    'alert-type' => 'success'
                );
                return Redirect()->back()->with($notification);
            }
        }
    }

    public function removefromcart($id)
    {
        $user_id=Auth::user()->id;
        $cart=Cart::where('product_id', $id)->where('user_id', $user_id);
        $cart->delete();

        $notification = array(
            'message' => 'Product successfully removed from cart',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function ordercheckout(Request $request){
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
        $user_id = Auth::user()->id;
        if($request->checkout_type == 'CartCheckout'){
            $carts=Cart::where('user_id', $user_id)->get();
            $subtotal = array();
            foreach ($carts as $cart) {
                $quantity = $cart->quantity;
                if($cart->products->discountedprice){
                    $price = $cart->products->discountedprice;
                }
                else{
                    $price = $cart->products->regularprice;
                }
                $new_price = $quantity * $price;
                array_push($subtotal, $new_price);
            }
            $total = array_sum($subtotal);
            $type = $request->checkout_type;

            return view('order_checkout', compact('brand', 'best_selling_product', 'total', 'type'));
        }
        elseif($request->checkout_type == 'ProductCheckout') {
            $product = Product::where('id', $request->product_id)->first();

            if ($request->quantity) {
                if (filter_var($request->quantity, FILTER_VALIDATE_INT) === false){
                    $notification = array(
                        'message' => 'Product quantity must be an integer',
                        'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }

                if($request->quantity < 1){
                    $notification = array(
                        'message' => 'Product quantity must be at least 1',
                        'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }

                $quantity = $request->quantity;
            }
            else{
                if($request->type == 'Required'){
                    if($request->quantity == '0'){
                        $notification = array(
                            'message' => 'Product quantity must be at least 1',
                            'alert-type' => 'error'
                        );
                        return Redirect()->back()->with($notification);
                    }

                    $notification = array(
                        'message' => 'Product quantity is required',
                        'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }

                if($product->colors->count() > 0 || $product->sizes->count() > 0){
                    return Redirect()->to('/product-details/'.$request->product_id);
                }

                $quantity = 1;
            }
            
            $product_quantity=$product->productquantity;
            if ($quantity > $product_quantity) {
                $notification = array(
                    'message' => 'Your requested product quantity is not available',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
            else if($quantity <= $product_quantity){
                if($product->discountedprice){
                    $price = $product->discountedprice;
                }
                else{
                    $price = $product->regularprice;
                }
                $total = $quantity * $price;
                $type = $request->checkout_type;
                $size_and_color = array();
                if($request->color){
                    $size_and_color['size'] = $request->color;
                }
                else{
                    $size_and_color['size'] = null;
                }
                if($request->size){
                    $size_and_color['color'] = $request->size;
                }
                else{
                    $size_and_color['color'] = null;
                }
            }

            return view('order_checkout', compact('brand', 'best_selling_product', 'total', 'type', 'product', 'size_and_color', 'quantity'));
        }
    }

    public function buyerprocessingorder(){
        $user_id = Auth::user()->id;
        $order_id=Order::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('order_id', $order_id)->get();
        return view('user.order.processing_order', compact('orderdetail'));
    }

    public function buyercompletedorder(){
        $user_id = Auth::user()->id;
        $order_id=Order::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('order_id', $order_id)->get();
        return view('user.order.completed_order', compact('orderdetail'));
    }

    public function buyercanceledorder(){
        $user_id = Auth::user()->id;
        $order_id=Order::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('order_id', $order_id)->get();
        return view('user.order.canceled_order', compact('orderdetail'));
    }

    public function buyervieworder($id){
        $orderdetail=Orderdetail::findorfail($id);
        return view('user.order.view_order', compact('orderdetail'));
    }

    public function cancelorder($id){
        $orderdetail=Orderdetail::findorfail($id);
        $quantity = $orderdetail->quantity;
        $product_id = $orderdetail->product_id;

        $product = Product::findorfail($product_id);
        $productquantity = $product->productquantity;
        $sales = $product->sales;
        $productquantity2 = $quantity + $productquantity;
        $sales2 = $sales - $quantity;
        if ($orderdetail->status == 'Shipped') {
            $notification = array(
                'message' => 'Sorry, this product has already shipped',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
        else{
            $orderdetail->status = 'Cancelled';
            $orderdetail->save();
            
            $product->productquantity = $productquantity2;
            $product->sales = $sales2;
            $product->save();

            $notification = array(
                'message' => 'Order successfully cancelled',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function buyerpendingreview(){
        $user_id = Auth::user()->id;
        $order_id=Order::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('order_id', $order_id)->get();
        return view('user.review.pending_review', compact('orderdetail'));
    }

    public function submitreview(Request $request, $id){
        $sub_review = $request->review;
        $sub_rating = $request->rating;
        if (isset($sub_review) && isset($sub_rating)) {
            $orderdetail=Orderdetail::findorfail($id);
            $review = new Review;
            $review->rating = $sub_rating;
            $review->comment = $sub_review;
            $review->user_id = Auth::user()->id;
            $review->product_id = $orderdetail->product_id;
            $review->orderdetail_id = $id;
            $review->save();
            $notification = array(
                'message' => 'Product review successfully submitted',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
        elseif(isset($sub_review)){
            $notification = array(
                'message' => 'Product rating is required',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
        elseif(isset($sub_rating)){
            $notification = array(
                'message' => 'Product review is required',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Product review and rating both are required',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function buyerreviewedorder(){
        $user_id = Auth::user()->id;
        $order_id=Order::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('order_id', $order_id)->get();
        return view('user.review.reviewed_order', compact('orderdetail'));
    }

    public function sendmessage(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $information = array();
        $information['name'] = $request->name;
        $information['email'] = $request->email;
        $information['phone'] = $request->phone;
        $information['message'] = $request->message;

        $admin = User::where('type', 'admin')->first();
        Mail::to($admin->email)->send(new SendMessageEmail($admin, $information));

        $notification = array(
            'message' => 'Your message has successfully sent',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function privacypolicy(){
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
        return view('privacy_policy', compact('brand', 'best_selling_product'));
    }

    public function hotdeal($id){
        Paginator::useBootstrap();
        $hotdeal = Hotdeal::findorfail($id);
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $best_selling_product=Product::orderBy('sales', 'DESC')->take(3)->get();
        $product=Product::where('category_id', $hotdeal->category_id)->paginate(12);
        $product_all=Product::where('category_id', $hotdeal->category_id)->get();
        $latest_check = Carbon::now()->subMonth(6)->toDateTimeString();
        return view('hot_deal', compact('brand', 'best_selling_product', 'product', 'product_all', 'latest_check'));
    }

    public function pagenotfound(){
        $brand = Brand::orderBy('brandname', 'ASC')->get();
        $best_selling_product = Product::orderBy('sales', 'DESC')->take(3)->get();
        return response()->view('errors.404', [
            'brand' => $brand,
            'best_selling_product' => $best_selling_product
        ], 404);
    }
}
