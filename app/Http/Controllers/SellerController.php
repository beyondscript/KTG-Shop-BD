<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\Otherimage;
use App\Models\Orderdetail;
use App\Models\Earning;
use App\Models\Withdraw;
use App\Models\User;
use Image;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawRequestEmail;

class SellerController extends Controller
{
    public function addshop()
    {
        return view('seller.shop.add_shop');
    }

    public function storeshop(Request $request){
        $validatedData = $request->validate([
            'shopname' => ['required', 'string', 'max:255', 'unique:shops'],
        ]);

        $shop=Shop::where('user_id', Auth::user()->id)->get();
        if (count($shop) < 2) {
        	$shop = new Shop;
	        $shop->shopname=$request->shopname;
	        $shop->user_id=Auth::user()->id;
	        $shop->save();

	        $notification = array(
	            'message' => 'Shop successfully added',
	            'alert-type' => 'success'
	        );
	        return Redirect()->back()->with($notification);
        }
        else{
        	$notification = array(
	            'message' => 'Only two shops can be added',
	            'alert-type' => 'error'
	        );
	        return Redirect()->back()->with($notification);
        }
    }

    public function allshop()
    {
        $shop=Shop::where('user_id', Auth::user()->id)->get();
        return view('seller.shop.all_shop', compact('shop'));
    }

    public function editshop($id){
        $shop = Shop::findorfail($id);
        return view('seller.shop.edit_shop', compact('shop'));
    }

    public function updateshop(Request $request, $id){
        $validatedData = $request->validate([
            'shopname' => ['required', 'string', 'max:255'],
        ]);

        $shop = Shop::findorfail($id);
        $shop->shopname=$request->shopname;
        $shop->save();

        $notification = array(
            'message' => 'Shop successfully updated',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.shop')->with($notification);
    }

    public function deleteshop($id){
        $shop=Shop::findorfail($id);
        $shop->delete();

        $notification = array(
            'message' => 'Shop successfully deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function addproduct()
    {
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $category=Category::orderBy('categoryname', 'ASC')->get();
        $shop=Shop::where('user_id', Auth::user()->id)->orderBy('shopname', 'ASC')->get();
        return view('seller.product.add_product', compact('brand', 'category', 'shop'));
    }

    public function storeproduct(Request $request){
        $validatedData = $request->validate([
            'productname' => ['required', 'string', 'max:255'],
            'productmodel' => ['required', 'string', 'max:255'],
            'brand' => ['required'],
            'category' => ['required'],
            'shop' => ['required'],
            'coverimage' => ['required', 'image'],
            'otherimages' => ['array'],
            'otherimages.*' => ['image'],
            'regularprice' => ['required', 'integer', 'min:1'],
            'discountedprice' => ['integer', 'min:1', 'nullable'],
            'colors' => ['array'],
            'colors.*' => ['string', 'max:255'],
            'sizes' => ['array'],
            'sizes.*' => ['string', 'max:255'],
            'productquantity' => ['required', 'integer', 'min:1'],
            'productdetail' => ['required', 'string'],
            'productdescription' => ['required', 'string'],
        ]);

        $product = new Product;
        $product->productname=$request->productname;
        $product->productmodel=$request->productmodel;
        $image = $request->file('coverimage');
        $name = hexdec(uniqid());
        $fullname = $name.'.webp';
        $path = 'images/products/images/';
        $url = $path.$fullname;
        $resize_image=Image::make($image->getRealPath());
        $resize_image->resize(500,500);
        $resize_image->save('images/products/images/'.$fullname);
        $product->coverimage = $url;
        $product->productdetail=$request->productdetail;
        $product->productdescription=$request->productdescription;
        $product->regularprice=$request->regularprice;

        if($request->discountedprice){
            $product->discountedprice=$request->discountedprice;
        }

        $product->productquantity=$request->productquantity;
        $product->user_id=Auth::user()->id;
        $product->brand_id=$request->brand;
        $product->category_id=$request->category;
        $product->shop_id=$request->shop;
        $product->save();

        $filepath = $url;
        try {
            \Tinify\setKey(env("TINIFY_API_KEY"));
            $source = \Tinify\fromFile($filepath);
            $source->toFile($filepath);
        } catch(\Tinify\AccountException $e) {
            return redirect('upload')->with('error', $e->getMessage());
        } catch(\Tinify\ClientException $e) {
            return redirect('upload')->with('error', $e->getMessage());
        } catch(\Tinify\ServerException $e) {
            return redirect('upload')->with('error', $e->getMessage());
        } catch(\Tinify\ConnectionException $e) {
            return redirect('upload')->with('error', $e->getMessage());
        } catch(Exception $e) {
            return redirect('upload')->with('error', $e->getMessage());
        }

        if($request->colors){
            foreach ($request->colors as $color) {
                Color::create([
                    'colorname' => $color,
                    'product_id' => $product->id,
                ]);
            }
        }

        if($request->sizes){
            foreach ($request->sizes as $size) {
                Size::create([
                    'sizename' => $size,
                    'product_id' => $product->id,
                ]);
            }
        }

        $images = $request->file('otherimages');
        if($images){
            foreach ($images as $img) {
                $name = hexdec(uniqid());
                $fullname = $name.'.webp';
                $path = 'images/products/images/otherimages/';
                $url = $path.$fullname;
                $resize_image=Image::make($img->getRealPath());
                $resize_image->resize(500,500);
                $resize_image->save('images/products/images/otherimages/'.$fullname);
                Otherimage::create([
                    'otherimage' => $url,
                    'product_id' => $product->id,
                ]);

                $filepath = $url;
                try {
                    \Tinify\setKey(env("TINIFY_API_KEY"));
                    $source = \Tinify\fromFile($filepath);
                    $source->toFile($filepath);
                } catch(\Tinify\AccountException $e) {
                    return redirect('upload')->with('error', $e->getMessage());
                } catch(\Tinify\ClientException $e) {
                    return redirect('upload')->with('error', $e->getMessage());
                } catch(\Tinify\ServerException $e) {
                    return redirect('upload')->with('error', $e->getMessage());
                } catch(\Tinify\ConnectionException $e) {
                    return redirect('upload')->with('error', $e->getMessage());
                } catch(Exception $e) {
                    return redirect('upload')->with('error', $e->getMessage());
                }
            }
        }

        $notification = array(
            'message' => 'Product successfully added',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function allproduct()
    {
        $product=Product::where('user_id', Auth::user()->id)->get();
        return view('seller.product.all_product', compact('product'));
    }

    public function editproduct($id)
    {
        $product=Product::findorfail($id);
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $category=Category::orderBy('categoryname', 'ASC')->get();
        $shop=Shop::where('user_id', Auth::user()->id)->orderBy('shopname', 'ASC')->get();
        return view('seller.product.edit_product', compact('product', 'brand', 'category', 'shop'));
    }

    public function updateproduct(Request $request, $id){
        $validatedData = $request->validate([
            'productname' => ['required', 'string', 'max:255'],
            'productmodel' => ['required', 'string', 'max:255'],
            'coverimage' => ['image'],
            'otherimages.*' => ['image'],
            'regularprice' => ['required', 'integer', 'min:1'],
            'discountedprice' => ['integer', 'min:1', 'nullable'],
            'colors' => ['array'],
            'colors.*' => ['string', 'max:255'],
            'sizes' => ['array'],
            'sizes.*' => ['string', 'max:255'],
            'productquantity' => ['required', 'integer', 'min:1'],
            'productdetail' => ['required', 'string'],
            'productdescription' => ['required', 'string'],
        ]);

        $product = Product::findorfail($id);
        $product->productname=$request->productname;
        $product->productmodel=$request->productmodel;
        $product->productdetail=$request->productdetail;
        $product->productdescription=$request->productdescription;
        $product->regularprice=$request->regularprice;
        
        if($request->discountedprice){
            $product->discountedprice=$request->discountedprice;
        }

        $product->productquantity=$request->productquantity;
        $product->user_id=Auth::user()->id;
        $product->brand_id=$request->brand;
        $product->category_id=$request->category;
        $product->shop_id=$request->shop;
        $image = $request->file('coverimage');
        if($image){
            $old_image=$product->coverimage;
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $name = hexdec(uniqid());
            $fullname = $name.'.webp';
            $path = 'images/products/images/';
            $url = $path.$fullname;
            $resize_image=Image::make($image->getRealPath());
            $resize_image->resize(500,500);
            $resize_image->save('images/products/images/'.$fullname);
            $product->coverimage = $url;
            $product->save();

            $filepath = $url;
            try {
                \Tinify\setKey(env("TINIFY_API_KEY"));
                $source = \Tinify\fromFile($filepath);
                $source->toFile($filepath);
            } catch(\Tinify\AccountException $e) {
                return redirect('upload')->with('error', $e->getMessage());
            } catch(\Tinify\ClientException $e) {
                return redirect('upload')->with('error', $e->getMessage());
            } catch(\Tinify\ServerException $e) {
                return redirect('upload')->with('error', $e->getMessage());
            } catch(\Tinify\ConnectionException $e) {
                return redirect('upload')->with('error', $e->getMessage());
            } catch(Exception $e) {
                return redirect('upload')->with('error', $e->getMessage());
            }
        }
        else{
            $product->save();
        }

        if($request->colors){
            $old_colors=$product->colors;
            foreach ($old_colors as $old_color) {
                $old_color->delete();
            }
            foreach ($request->colors as $color) {
                Color::create([
                    'colorname' => $color,
                    'product_id' => $product->id,
                ]);
            }
        }

        if($request->sizes){
            $old_sizes=$product->sizes;
            foreach ($old_sizes as $old_size) {
                $old_size->delete();
            }
            foreach ($request->sizes as $size) {
                Size::create([
                    'sizename' => $size,
                    'product_id' => $product->id,
                ]);
            }
        }

        $images = $request->file('otherimages');
        if ($images) {
            $old_otherimages=$product->otherimages;
            foreach ($old_otherimages as $old_othrimg) {
                if(file_exists($old_othrimg->otherimage)){
                    unlink($old_othrimg->otherimage);
                }
                $old_othrimg->delete();
            }
            foreach ($images as $img) {
                $name = hexdec(uniqid());
                $fullname = $name.'.webp';
                $path = 'images/products/images/otherimages/';
                $url = $path.$fullname;
                $resize_image=Image::make($img->getRealPath());
                $resize_image->resize(500,500);
                $resize_image->save('images/products/images/otherimages/'.$fullname);
                Otherimage::create([
                    'otherimage' => $url,
                    'product_id' => $product->id,
                ]);

                $filepath = $url;
                try {
                    \Tinify\setKey(env("TINIFY_API_KEY"));
                    $source = \Tinify\fromFile($filepath);
                    $source->toFile($filepath);
                } catch(\Tinify\AccountException $e) {
                    return redirect('upload')->with('error', $e->getMessage());
                } catch(\Tinify\ClientException $e) {
                    return redirect('upload')->with('error', $e->getMessage());
                } catch(\Tinify\ServerException $e) {
                    return redirect('upload')->with('error', $e->getMessage());
                } catch(\Tinify\ConnectionException $e) {
                    return redirect('upload')->with('error', $e->getMessage());
                } catch(Exception $e) {
                    return redirect('upload')->with('error', $e->getMessage());
                }
            }
        }

        $notification = array(
            'message' => 'Product successfully updated',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.product')->with($notification);
    }

    public function deleteproduct($id){
        $product=Product::findorfail($id);
        $otherimages=Otherimage::where('product_id', $id)->get();
        $image=$product->coverimage;
        if(file_exists($image)){
            unlink($image);
        }
        foreach ($otherimages as $otherimage) {
            if(file_exists($otherimage->otherimage)){
                unlink($otherimage->otherimage);
            }
        }
        $product->delete();

        $notification = array(
            'message' => 'Product successfully deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function sellerprocessingorder(){
        $user_id = Auth::user()->id;
        $product_id=Product::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('product_id', $product_id)->get();
        return view('seller.order.processing_order', compact('orderdetail'));
    }

    public function sellercompletedorder(){
        $user_id = Auth::user()->id;
        $product_id=Product::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('product_id', $product_id)->get();
        return view('seller.order.completed_order', compact('orderdetail'));
    }

    public function sellercanceledorder(){
        $user_id = Auth::user()->id;
        $product_id=Product::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('product_id', $product_id)->get();
        return view('seller.order.canceled_order', compact('orderdetail'));
    }

    public function sellervieworder($id){
        $orderdetail=Orderdetail::findorfail($id);
        return view('seller.order.view_order', compact('orderdetail'));
    }

    public function processorder($id){
        $orderdetail=Orderdetail::findorfail($id);
        $orderdetail->status = 'Processing';
        $orderdetail->save();

        $notification = array(
            'message' => 'Order is now processing',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function packageorder($id){
        $orderdetail=Orderdetail::findorfail($id);
        $orderdetail->status = 'Packaged';
        $orderdetail->save();

        $notification = array(
            'message' => 'Product successfully Packaged',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function shiporder($id){
        $orderdetail=Orderdetail::findorfail($id);
        $orderdetail->status = 'Shipped';
        $orderdetail->save();

        $notification = array(
            'message' => 'Product successfully Shipped',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function deliverorder($id){
        $orderdetail=Orderdetail::findorfail($id);
        $orderdetail->status = 'Delivered';
        $orderdetail->save();

        $earning = new Earning;
        $earning->earnings = ($orderdetail->total / 100) * 99.5;
        $earning->user_id = Auth::user()->id;
        $earning->save();

        $notification = array(
            'message' => 'Product successfully Delivered',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function sellerrequestwithdraw(){
        $earnings = Earning::where('user_id', Auth::user()->id)->get();
        $withdraws = Withdraw::where('user_id', Auth::user()->id)->get();
        return view('seller.withdraw.request_withdraw', compact('earnings', 'withdraws'));
    }

    public function sellerrequestwithdraw2(Request $request, $total){
        $validatedData = $request->validate([
            'amount' => ['required', 'integer', 'min:1'],
            'method' => ['required', 'string', 'max:255'],
        ]);

        $amount = $request->amount;
        $admin = User::where('type', 'admin')->first();
        $user = User::where('id', Auth::user()->id)->first();
        if($amount > $total){
            $notification = array(
                'message' => 'Your withdraw request of BDT '.$amount.' exceeds the available amount',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
        elseif($amount < 10000){
            $notification = array(
                'message' => 'Minimum withdraw amount is BDT 10000',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
        else{
            $withdraw = new Withdraw;
            $withdraw->amount = $amount;
            $withdraw->method = $request->method;
            $withdraw->status = 'Processing';
            $withdraw->user_id = Auth::user()->id;
            $withdraw->save();

            Mail::to($admin->email)->send(new WithdrawRequestEmail($admin, $user, $withdraw));

            $notification = array(
                'message' => 'Your withdraw request of BDT '.$amount.' has placed successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function sellerallwithdraw(){
        $withdraws = Withdraw::where('user_id', Auth::user()->id)->get();
        return view('seller.withdraw.all_withdraw', compact('withdraws'));
    }

    public function sellerviewwithdraw($id){
        $withdraw = Withdraw::findorfail($id);
        return view('seller.withdraw.view_withdraw', compact('withdraw'));
    }
}
