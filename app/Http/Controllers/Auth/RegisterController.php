<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Sellerdetail;
use App\Models\Subscriber;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriberWelcomeEmail;
use App\Mail\WelcomeEmail;
use App\Mail\NewSellerMail;
use App\Mail\NewSellerMail2;
use Image;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showSellerRegistrationForm()
    {
        return view('auth.seller_register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string'],
            'dob' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phonenumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255'],
            'image' => ['image'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'email' => $data['email'],
            'phonenumber' => $data['phonenumber'],
            'type' => 'Admin',
            'approved' => true,
            'password' => Hash::make($data['password']),
        ]);

        $image = request()->file('image');
        if($image){
            $name = hexdec(uniqid());
            $fullname = $name.'.webp';
            $path = 'images/users/images/';
            $url = $path.$fullname;
            $resize_image=Image::make($image->getRealPath());
            $resize_image->resize(300,300);
            $resize_image->save('images/users/images/'.$fullname);
            $user->update(['image' => $url]);

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

        return $user;
    }

    public function customregister(Request $request){
        if(isset($request->type) && $request->type == 'Seller'){
            $validatedData = $request->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'string'],
                'dob' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phonenumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255'],
                'bkashnumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255', 'unique:sellerdetails'],
                'nagadnumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255', 'unique:sellerdetails'],
                'image' => ['image'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        else{
            $validatedData = $request->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'string'],
                'dob' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phonenumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255'],
                'image' => ['image'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        
        $users = User::all();

        $user = new User;

        if(count($users) > 0){
            if(isset($request->type) && $request->type == 'Seller'){
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->gender = $request->gender;
                $user->dob = $request->dob;
                $user->email = $request->email;
                $user->phonenumber = $request->phonenumber;
                $user->type = 'Seller';
                $user->password = Hash::make($request->password);

                $image = request()->file('image');
                if($image){
                    $name = hexdec(uniqid());
                    $fullname = $name.'.webp';
                    $path = 'images/users/images/';
                    $url = $path.$fullname;
                    $resize_image=Image::make($image->getRealPath());
                    $resize_image->resize(300,300);
                    $resize_image->save('images/users/images/'.$fullname);
                    $user->image = $url;

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

                $user->save();

                $sellerdetail = new Sellerdetail;
                $sellerdetail->bkashnumber = $request->bkashnumber;
                $sellerdetail->nagadnumber = $request->nagadnumber;
                $sellerdetail->user_id = $user->id;
                $sellerdetail->save();

                $app_name = config('app.name', 'Laravel');
                Mail::to($user->email)->send(new NewSellerMail2($user, $app_name));

                $admin=User::where('type', 'admin')->first();
                Mail::to($admin->email)->send(new NewSellerMail($admin, $user));
            }
            else{
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->gender = $request->gender;
                $user->dob = $request->dob;
                $user->email = $request->email;
                $user->phonenumber = $request->phonenumber;
                $user->type = 'Buyer';
                $user->approved = true;
                $user->password = Hash::make($request->password);
                
                $image = request()->file('image');
                if($image){
                    $name = hexdec(uniqid());
                    $fullname = $name.'.webp';
                    $path = 'images/users/images/';
                    $url = $path.$fullname;
                    $resize_image=Image::make($image->getRealPath());
                    $resize_image->resize(300,300);
                    $resize_image->save('images/users/images/'.$fullname);
                    $user->image = $url;

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

                $user->save();

                $subscribed = Subscriber::where('email', $user->email)->pluck('email');

                $app_name = config('app.name', 'Laravel');

                if (!$subscribed->isEmpty()) {
                    Mail::to($user->email)->send(new WelcomeEmail($user, $app_name));
                }
                else{
                    $subscriber = new Subscriber;
                    $subscriber->email = $user->email;
                    $subscriber->save();

                    Mail::to($user->email)->send(new SubscriberWelcomeEmail($user, $app_name));
                }
            }
        }
        else{
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->gender = $request->gender;
            $user->dob = $request->dob;
            $user->email = $request->email;
            $user->phonenumber = $request->phonenumber;
            $user->type = 'Admin';
            $user->approved = true;
            $user->password = Hash::make($request->password);
            
            $image = request()->file('image');
            if($image){
                $name = hexdec(uniqid());
                $fullname = $name.'.webp';
                $path = 'images/users/images/';
                $url = $path.$fullname;
                $resize_image=Image::make($image->getRealPath());
                $resize_image->resize(300,300);
                $resize_image->save('images/users/images/'.$fullname);
                $user->image = $url;

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

            $user->save();
        }

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return redirect()->route('index');
    }
}
