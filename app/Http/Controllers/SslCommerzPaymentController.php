<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Orderdetail;
use App\Models\Product;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderBuyerEmail;
use App\Mail\NewOrderSellerEmail;

class SslCommerzPaymentController extends Controller
{
    public function payorder(Request $request, $total)
    {
        $payment=$request->payment;
        if(isset($payment) && $payment == 'COD'){
            $validatedData = $request->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'shippingaddress' => ['required', 'string', 'max:255'],
                'phonenumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255'],
                'note' => ['nullable', 'string', 'max:255'],
            ]);

            $order = Order::create([
                'trx_id' => Str::upper(Str::random(8)),
                'total' => $total,
                'type' => $request['payment'],
                'status' => 'Processing',
                'note' => $request['note'],
                'currency' => 'BDT',
                'user_id' => Auth::user()->id,
            ]);

            if($request->type == 'CartCheckout'){
                $user_id = Auth::user()->id;
                $carts=Cart::where('user_id', $user_id)->get();
                foreach ($carts as $cart) {
                    $quantity = $cart->quantity;
                    if(is_null($cart->products->discountedprice)){
                        $price = $cart->products->regularprice;
                        $total2 = $quantity * $price;
                    }
                    else{
                        if($cart->products->regularprice == $cart->products->discountedprice){
                            $price = $cart->products->regularprice;
                            $total2 = $quantity * $price;
                        }
                        else{
                            $price = $cart->products->discountedprice;
                            $total2 = $quantity * $price;
                        }
                    }
                    $orderdetail = Orderdetail::create([
                        'firstname' => $request['firstname'],
                        'lastname' => $request['lastname'],
                        'email' => $request['email'],
                        'shippingaddress' => $request['shippingaddress'],
                        'phonenumber' => $request['phonenumber'],
                        'color' => $cart->color,
                        'size' => $cart->size,
                        'quantity' => $quantity,
                        'shippingcost' => '60',
                        'total' => $total2,
                        'status' => 'Processing',
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                    ]);
                    $product_id=$cart->product_id;
                    $product=Product::findorfail($product_id);
                    $quantity2=$product->productquantity;
                    $quantity3=$quantity2 - $quantity;
                    $product->productquantity=$quantity3;
                    $sales=$product->sales;
                    $sales2=$sales + $quantity;
                    $product->sales=$sales2;
                    $product->save();

                    $seller=User::where('id', $product->user_id)->first();
                    Mail::to($seller->email)->send(new NewOrderSellerEmail($orderdetail));

                    $cart->delete();
                }
            }
            elseif($request->type == 'ProductCheckout'){
                $product=Product::findorfail($request->product_id);
                $quantity = $request->quantity;
                if(is_null($product->discountedprice)){
                    $price = $product->regularprice;
                    $total2 = $quantity * $price;
                }
                else{
                    $price = $product->discountedprice;
                    $total2 = $quantity * $price;
                }
                $orderdetail = Orderdetail::create([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'shippingaddress' => $request['shippingaddress'],
                    'phonenumber' => $request['phonenumber'],
                    'color' => $request->color,
                    'size' => $request->size,
                    'quantity' => $quantity,
                    'shippingcost' => '60',
                    'total' => $total2,
                    'status' => 'Processing',
                    'order_id' => $order->id,
                    'product_id' => $request->product_id,
                ]);
                $quantity2=$product->productquantity;
                $quantity3=$quantity2 - $quantity;
                $product->productquantity=$quantity3;
                $sales=$product->sales;
                $sales2=$sales + $quantity;
                $product->sales=$sales2;
                $product->save();

                $seller=User::where('id', $product->user_id)->first();
                Mail::to($seller->email)->send(new NewOrderSellerEmail($orderdetail));
            }
            $user=User::where('id', $order->user_id)->first();
            Mail::to($user->email)->send(new NewOrderBuyerEmail($order));

            $notification = array(
                'message' => 'Order successfully placed',
                'alert-type' => 'success'
            );
            return redirect()->route('buyer.processing.order')->with($notification);
        }
        elseif(isset($payment) && $payment == 'Bkash'){
            $validatedData = $request->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'shippingaddress' => ['required', 'string', 'max:255'],
                'phonenumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255'],
                'note' => ['nullable', 'string', 'max:255'],
                'bkash_tran_id' => ['required', 'string', 'min:10', 'max:10'],
            ]);

            $order = Order::create([
                'trx_id' => Str::upper($request['bkash_tran_id']),
                'total' => $total,
                'type' => $request['payment'],
                'status' => 'Processing',
                'note' => $request['note'],
                'currency' => 'BDT',
                'user_id' => Auth::user()->id,
            ]);

            if($request->type == 'CartCheckout'){
                $user_id = Auth::user()->id;
                $carts=Cart::where('user_id', $user_id)->get();
                foreach ($carts as $cart) {
                    $quantity = $cart->quantity;
                    if(is_null($cart->products->discountedprice)){
                        $price = $cart->products->regularprice;
                        $total2 = $quantity * $price;
                    }
                    else{
                        if($cart->products->regularprice == $cart->products->discountedprice){
                            $price = $cart->products->regularprice;
                            $total2 = $quantity * $price;
                        }
                        else{
                            $price = $cart->products->discountedprice;
                            $total2 = $quantity * $price;
                        }
                    }
                    $orderdetail = Orderdetail::create([
                        'firstname' => $request['firstname'],
                        'lastname' => $request['lastname'],
                        'email' => $request['email'],
                        'shippingaddress' => $request['shippingaddress'],
                        'phonenumber' => $request['phonenumber'],
                        'color' => $cart->color,
                        'size' => $cart->size,
                        'quantity' => $quantity,
                        'shippingcost' => '60',
                        'total' => $total2,
                        'status' => 'Pending',
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                    ]);
                    $product_id=$cart->product_id;
                    $product=Product::findorfail($product_id);
                    $quantity2=$product->productquantity;
                    $quantity3=$quantity2 - $quantity;
                    $product->productquantity=$quantity3;
                    $sales=$product->sales;
                    $sales2=$sales + $quantity;
                    $product->sales=$sales2;
                    $product->save();

                    $seller=User::where('id', $product->user_id)->first();
                    Mail::to($seller->email)->send(new NewOrderSellerEmail($orderdetail));

                    $cart->delete();
                }
            }
            elseif($request->type == 'ProductCheckout'){
                $product=Product::findorfail($request->product_id);
                $quantity = $request->quantity;
                if(is_null($product->discountedprice)){
                    $price = $product->regularprice;
                    $total2 = $quantity * $price;
                }
                else{
                    $price = $product->discountedprice;
                    $total2 = $quantity * $price;
                }
                $orderdetail = Orderdetail::create([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'shippingaddress' => $request['shippingaddress'],
                    'phonenumber' => $request['phonenumber'],
                    'color' => $request->color,
                    'size' => $request->size,
                    'quantity' => $quantity,
                    'shippingcost' => '60',
                    'total' => $total2,
                    'status' => 'Pending',
                    'order_id' => $order->id,
                    'product_id' => $request->product_id,
                ]);
                $quantity2=$product->productquantity;
                $quantity3=$quantity2 - $quantity;
                $product->productquantity=$quantity3;
                $sales=$product->sales;
                $sales2=$sales + $quantity;
                $product->sales=$sales2;
                $product->save();

                $seller=User::where('id', $product->user_id)->first();
                Mail::to($seller->email)->send(new NewOrderSellerEmail($orderdetail));
            }
            $user=User::where('id', $order->user_id)->first();
            Mail::to($user->email)->send(new NewOrderBuyerEmail($order));

            $notification = array(
                'message' => 'Order successfully placed',
                'alert-type' => 'success'
            );
            return redirect()->route('buyer.processing.order')->with($notification);
        }
        elseif(isset($payment) && $payment == 'Nagad'){
            $validatedData = $request->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'shippingaddress' => ['required', 'string', 'max:255'],
                'phonenumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255'],
                'note' => ['nullable', 'string', 'max:255'],
                'nagad_tran_id' => ['required', 'string', 'min:8', 'max:8'],
            ]);

            $order = Order::create([
                'trx_id' => Str::upper($request['nagad_tran_id']),
                'total' => $total,
                'type' => $request['payment'],
                'status' => 'Processing',
                'note' => $request['note'],
                'currency' => 'BDT',
                'user_id' => Auth::user()->id,
            ]);

            if($request->type == 'CartCheckout'){
                $user_id = Auth::user()->id;
                $carts=Cart::where('user_id', $user_id)->get();
                foreach ($carts as $cart) {
                    $quantity = $cart->quantity;
                    if(is_null($cart->products->discountedprice)){
                        $price = $cart->products->regularprice;
                        $total2 = $quantity * $price;
                    }
                    else{
                        if($cart->products->regularprice == $cart->products->discountedprice){
                            $price = $cart->products->regularprice;
                            $total2 = $quantity * $price;
                        }
                        else{
                            $price = $cart->products->discountedprice;
                            $total2 = $quantity * $price;
                        }
                    }
                    $orderdetail = Orderdetail::create([
                        'firstname' => $request['firstname'],
                        'lastname' => $request['lastname'],
                        'email' => $request['email'],
                        'shippingaddress' => $request['shippingaddress'],
                        'phonenumber' => $request['phonenumber'],
                        'color' => $cart->color,
                        'size' => $cart->size,
                        'quantity' => $quantity,
                        'shippingcost' => '60',
                        'total' => $total2,
                        'status' => 'Pending',
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                    ]);
                    $product_id=$cart->product_id;
                    $product=Product::findorfail($product_id);
                    $quantity2=$product->productquantity;
                    $quantity3=$quantity2 - $quantity;
                    $product->productquantity=$quantity3;
                    $sales=$product->sales;
                    $sales2=$sales + $quantity;
                    $product->sales=$sales2;
                    $product->save();

                    $seller=User::where('id', $product->user_id)->first();
                    Mail::to($seller->email)->send(new NewOrderSellerEmail($orderdetail));

                    $cart->delete();
                }
            }
            elseif($request->type == 'ProductCheckout'){
                $product=Product::findorfail($request->product_id);
                $quantity = $request->quantity;
                if(is_null($product->discountedprice)){
                    $price = $product->regularprice;
                    $total2 = $quantity * $price;
                }
                else{
                    $price = $product->discountedprice;
                    $total2 = $quantity * $price;
                }
                $orderdetail = Orderdetail::create([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'shippingaddress' => $request['shippingaddress'],
                    'phonenumber' => $request['phonenumber'],
                    'color' => $request->color,
                    'size' => $request->size,
                    'quantity' => $quantity,
                    'shippingcost' => '60',
                    'total' => $total2,
                    'status' => 'Pending',
                    'order_id' => $order->id,
                    'product_id' => $request->product_id,
                ]);
                $quantity2=$product->productquantity;
                $quantity3=$quantity2 - $quantity;
                $product->productquantity=$quantity3;
                $sales=$product->sales;
                $sales2=$sales + $quantity;
                $product->sales=$sales2;
                $product->save();

                $seller=User::where('id', $product->user_id)->first();
                Mail::to($seller->email)->send(new NewOrderSellerEmail($orderdetail));
            }
            $user=User::where('id', $order->user_id)->first();
            Mail::to($user->email)->send(new NewOrderBuyerEmail($order));

            $notification = array(
                'message' => 'Order successfully placed',
                'alert-type' => 'success'
            );
            return redirect()->route('buyer.processing.order')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Please select a payment method',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
