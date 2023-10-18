<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Image;

class ProfileController extends Controller
{
    public function adminchangeemail()
    {
        return view('admin.profile.change_email');
    }
    public function adminchangepassword()
    {
        return view('admin.profile.change_password');
    }
    public function adminchangepicture(){
        return view('admin.profile.change_picture');
    }

    public function sellerchangeemail()
    {
        return view('seller.profile.change_email');
    }
    public function sellerchangepassword()
    {
        return view('seller.profile.change_password');
    }
    public function sellerchangepicture(){
        return view('seller.profile.change_picture');
    }
    
    public function buyerchangeemail()
    {
        return view('user.profile.change_email');
    }
    public function buyerchangepassword()
    {
        return view('user.profile.change_password');
    }
    public function buyerchangepicture(){
        return view('user.profile.change_picture');
    }
    
    public function updateemail(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => ['required', 'string', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $current_password = Auth::user()->password;
        if (Hash::check($request->old_password, $current_password)) {
            $user_id = Auth::user()->id;
            $user = User::findorfail($user_id);
            $user->email = $request->email;
            $user->save();
            $notification = array(
                'message' => 'Email successfully changed',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Old password did not match',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function updatepassword(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $current_password = Auth::user()->password;
        if (Hash::check($request->old_password, $current_password)) {
            $user_id = Auth::user()->id;
            $user = User::findorfail($user_id);
            $user->password = Hash::make($request->password);
            $user->save();
            $notification = array(
                'message' => 'Password successfully changed',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Old password did not match',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function updatepicture(Request $request)
    {
        $validatedData = $request->validate([
            'profilepicture' => ['required', 'image'],
        ]);

        $old_image=Auth::user()->image;
        $image = $request->file('profilepicture');
        $user_id=Auth::user()->id;
        $user=User::findorfail($user_id);
        if($old_image == 'images/users/images/default.webp'){
            $name = hexdec(uniqid());
            $fullname = $name.'.webp';
            $path = 'images/users/images/';
            $url = $path.$fullname;
            $resize_image=Image::make($image->getRealPath());
            $resize_image->resize(300,300);
            $resize_image->save('images/users/images/'.$fullname);
            $user->image = $url;
            $user->save();

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
                'message' => 'Profile picture successfully changed',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
        else{
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $name = hexdec(uniqid());
            $fullname = $name.'.webp';
            $path = 'images/users/images/';
            $url = $path.$fullname;
            $resize_image=Image::make($image->getRealPath());
            $resize_image->resize(300,300);
            $resize_image->save('images/users/images/'.$fullname);
            $user->image = $url;
            $user->save();

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
                'message' => 'Profile picture successfully changed',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
