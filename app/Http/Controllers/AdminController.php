<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Otherimage;
use App\Models\Withdraw;
use App\Models\Hotdeal;
use Image;
use Illuminate\Support\Facades\Mail;
use App\Mail\SellerApprovedEmail;
use App\Mail\SellerDisapprovedEmail;
use App\Mail\WithdrawCompletedEmail;

class AdminController extends Controller
{
    public function addbrand()
    {
        return view('admin.brand.add_brand');
    }

    public function storebrand(Request $request){
        $validatedData = $request->validate([
            'brandname' => ['required', 'string', 'max:255', 'unique:brands'],
        ]);

        $brand = new Brand;
        $brand->brandname=$request->brandname;
        $brand->save();

        $notification = array(
            'message' => 'Brand successfully added',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function allbrand()
    {
        $brand=Brand::all();
        return view('admin.brand.all_brand', compact('brand'));
    }

    public function editbrand($id){
        $brand = Brand::findorfail($id);
        return view('admin.brand.edit_brand', compact('brand'));
    }

    public function updatebrand(Request $request, $id){
        $validatedData = $request->validate([
            'brandname' => ['required', 'string', 'max:255'],
        ]);

        $brand = Brand::findorfail($id);
        $brand->brandname=$request->brandname;
        $brand->save();

        $notification = array(
            'message' => 'Brand successfully updated',
            'alert-type' => 'success'
        );
        return Redirect(route('all.brand'))->with($notification);
    }

    public function deletebrand($id){
        $brand=Brand::findorfail($id);
        $products=Product::where('brand_id', $id)->get();
        foreach($products as $product){
            $otherimages=Otherimage::where('product_id', $product->id)->get();
            if(file_exists($product->coverimage)){
                unlink($product->coverimage);
            }
            foreach ($otherimages as $otherimage) {
                if(file_exists($otherimage->otherimage)){
                    unlink($otherimage->otherimage);
                }
            }
        }
        $brand->delete();

        $notification = array(
            'message' => 'Brand successfully deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function addcategory()
    {
        return view('admin.category.add_category');
    }

    public function storecategory(Request $request){
        $validatedData = $request->validate([
            'categoryname' => ['required', 'string', 'max:255', 'unique:categories'],
            'categoryimage' => ['required', 'image'],
        ]);

        $category = new Category;
        $category->categoryname=$request->categoryname;
        $image = $request->file('categoryimage');
        $name = hexdec(uniqid());
        $fullname = $name.'.webp';
        $path = 'images/categories/images/';
        $url = $path.$fullname;
        $resize_image=Image::make($image->getRealPath());
        $resize_image->resize(360,240);
        $resize_image->save('images/categories/images/'.$fullname);
        $category->categoryimage = $url;
        $category->save();

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

        $notification = array(
            'message' => 'Category successfully added',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function allcategory()
    {
        $category=Category::all();
        return view('admin.category.all_category', compact('category'));
    }

    public function editcategory($id){
        $category = Category::findorfail($id);
        return view('admin.category.edit_category', compact('category'));
    }

    public function updatecategory(Request $request, $id){
        $validatedData = $request->validate([
            'categoryname' => ['required', 'string', 'max:255'],
            'categoryimage' => ['image'],
        ]);

        $category = Category::findorfail($id);
        $category->categoryname=$request->categoryname;
        $image = $request->file('categoryimage');
        if($image){
            if(file_exists($category->categoryimage)){
                unlink($category->categoryimage);
            }
            $name = hexdec(uniqid());
            $fullname = $name.'.webp';
            $path = 'images/categories/images/';
            $url = $path.$fullname;
            $resize_image=Image::make($image->getRealPath());
            $resize_image->resize(360,240);
            $resize_image->save('images/categories/images/'.$fullname);
            $category->categoryimage = $url;
            $category->save();

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
            $category->save();
        }

        $notification = array(
            'message' => 'Category successfully updated',
            'alert-type' => 'success'
        );
        return Redirect(route('all.category'))->with($notification);
    }

    public function deletecategory($id){
        $category=Category::findorfail($id);
        $products=Product::where('category_id', $id)->get();
        $image=$category->categoryimage;
        if(file_exists($image)){
            unlink($image);
        }
        foreach($products as $product){
            $otherimages=Otherimage::where('product_id', $product->id)->get();
            if(file_exists($product->coverimage)){
                unlink($product->coverimage);
            }
            foreach ($otherimages as $otherimage) {
                if(file_exists($otherimage->otherimage)){
                    unlink($otherimage->otherimage);
                }
            }
        }
        $category->delete();

        $notification = array(
            'message' => 'Category successfully deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function notapprovedseller()
    {
        $seller=User::where('approved', '0')->get();
        return view('admin.seller.approve_seller', compact('seller'));
    }

    public function approveseller($id)
    {
        $seller=User::findorfail($id);
        $seller->approved='1';
        $seller->save();

        Mail::to($seller->email)->send(new SellerApprovedEmail($seller));

        $notification = array(
            'message' => 'Seller successfully approved',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function allseller()
    {
        $seller=User::where('type', 'seller')->where('approved', '1')->get();
        return view('admin.seller.all_seller', compact('seller'));
    }

    public function disapproveseller($id)
    {
        $seller=User::findorfail($id);
        $seller->approved='0';
        $seller->save();

        Mail::to($seller->email)->send(new SellerDisapprovedEmail($seller));

        $notification = array(
            'message' => 'Seller successfully disapproved',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function adminprocessingwithdraw(){
        $withdraws = Withdraw::where('status', 'Processing')->get();
        return view('admin.withdraw.processing_withdraw', compact('withdraws'));
    }

    public function admincompletewithdraw($id){
        $withdraw = Withdraw::findorfail($id);
        return view('admin.withdraw.complete_withdraw', compact('withdraw'));
    }

    public function admincompletewithdraw2(Request $request, $id){
        $validatedData = $request->validate([
            'tran_id' => ['required', 'string', 'min:8','max:10'],
        ]);

        $withdraw = Withdraw::findorfail($id);
        $withdraw->status = 'Completed';
        $withdraw->tran_id = strtoupper($request->tran_id);
        $withdraw->save();

        Mail::to($withdraw->users->email)->send(new WithdrawCompletedEmail($withdraw));

        $notification = array(
            'message' => 'Withdraw successfully completed',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.processing.withdraw')->with($notification);
    }

    public function admincompletedwithdraw(){
        $withdraws = Withdraw::where('status', 'Completed')->get();
        return view('admin.withdraw.completed_withdraw', compact('withdraws'));
    }

    public function adminviewwithdraw($id){
        $withdraw = Withdraw::findorfail($id);
        return view('admin.withdraw.view_withdraw', compact('withdraw'));
    }

    public function addhotdeal(){
        $category = Category::all();
        return view('admin.hot_deal.add_hot_deal', compact('category'));
    }

    public function storehotdeal(Request $request){
        $validatedData = $request->validate([
            'discount' => ['required', 'integer', 'max:20'],
            'category' => ['required'],
            'coverimage' => ['required', 'image'],
            'date' => ['required'],
        ]);

        $hotdeals = Hotdeal::all();
        if (count($hotdeals) == 0) {
            $hotdeal = new Hotdeal;
            $hotdeal->discount = $request->discount;
            $hotdeal->date = $request->date;
            $hotdeal->expired = false;
            $hotdeal->category_id = $request->category;
            $image = $request->file('coverimage');
            $name = hexdec(uniqid());
            $fullname = $name.'.webp';
            $path = 'images/hotdeals/images/';
            $url = $path.$fullname;
            $resize_image=Image::make($image->getRealPath());
            $resize_image->resize(1366,768);
            $resize_image->save('images/hotdeals/images/'.$fullname);
            $hotdeal->image = $url;
            $hotdeal->save();

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

            $products = Product::where('category_id', $request->category)->get();
            foreach($products as $product){
                $discountprice = ($product->regularprice / 100) * $request->discount;
                $discountedprice = $product->regularprice - $discountprice;
                $product->discountedprice = $discountedprice;
                $product->save();
            }

            $notification = array(
                'message' => 'Hot Deal successfully added',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
        else{
            $not_expired_hotdeals = Hotdeal::where('expired', false)->get();
            if (count($not_expired_hotdeals) == 0) {
                $hotdeal = Hotdeal::where('expired', true)->first();
                if(file_exists($hotdeal->image)){
                    unlink($hotdeal->image);
                }
                $hotdeal->discount = $request->discount;
                $hotdeal->date = $request->date;
                $hotdeal->expired = false;
                $hotdeal->category_id = $request->category;
                $image = $request->file('coverimage');
                $name = hexdec(uniqid());
                $fullname = $name.'.webp';
                $path = 'images/hotdeals/images/';
                $url = $path.$fullname;
                $resize_image=Image::make($image->getRealPath());
                $resize_image->resize(1366,768);
                $resize_image->save('images/hotdeals/images/'.$fullname);
                $hotdeal->image = $url;
                $hotdeal->save();

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

                $products = Product::where('category_id', $request->category)->get();
                foreach($products as $product){
                    $discountprice = ($product->regularprice / 100) * $request->discount;
                    $discountedprice = $product->regularprice - $discountprice;
                    $product->discountedprice = $discountedprice;
                    $product->save();
                }

                $notification = array(
                    'message' => 'Hot Deal successfully added',
                    'alert-type' => 'success'
                );
                return Redirect()->back()->with($notification);
            }
            else{
                $notification = array(
                    'message' => 'Hot Deal already exists',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
        }
    }

    public function allhotdeal(){
        $hotdeal = Hotdeal::where('expired', false)->get();
        return view('admin.hot_deal.all_hot_deal', compact('hotdeal'));
    }

    public function edithotdeal($id){
        $hotdeal = Hotdeal::findorfail($id);
        $category = Category::all();
        return view('admin.hot_deal.edit_hot_deal', compact('hotdeal', 'category'));
    }

    public function updatehotdeal(Request $request, $id){
        $validatedData = $request->validate([
            'discount' => ['required', 'integer', 'max:20'],
            'coverimage' => ['image'],
        ]);

        $hotdeal = Hotdeal::findorfail($id);
        $hotdeal->discount = $request->discount;
        $image = $request->file('coverimage');
        if($image){
            if(file_exists($hotdeal->image)){
                unlink($hotdeal->image);
            }
            $name = hexdec(uniqid());
            $fullname = $name.'.webp';
            $path = 'images/hotdeals/images/';
            $url = $path.$fullname;
            $resize_image=Image::make($image->getRealPath());
            $resize_image->resize(1366,768);
            $resize_image->save('images/hotdeals/images/'.$fullname);
            $hotdeal->image = $url;

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

        if ($request->date) {
            $hotdeal->date = $request->date;
        }

        if ($request->category) {
            $old_products = Product::where('category_id', $hotdeal->category_id)->get();
            foreach($old_products as $product){
                $product->discountedprice = $product->regularprice;
                $product->save();
            }

            $hotdeal->category_id = $request->category;

            $products = Product::where('category_id', $request->category)->get();
            foreach($products as $product){
                $discountprice = ($product->regularprice / 100) * $request->discount;
                $discountedprice = $product->regularprice - $discountprice;
                $product->discountedprice = $discountedprice;
                $product->save();
            }
        }
        else{
            $products = Product::where('category_id', $hotdeal->category_id)->get();
            foreach($products as $product){
                $discountprice = ($product->regularprice / 100) * $request->discount;
                $discountedprice = $product->regularprice - $discountprice;
                $product->discountedprice = $discountedprice;
                $product->save();
            }
        }

        $hotdeal->save();

        $notification = array(
            'message' => 'Hot Deal successfully updated',
            'alert-type' => 'success'
        );
        return Redirect(route('all.hot.deal'))->with($notification);
    }
}
