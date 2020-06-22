<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Hash;
use Auth;
use App\Admin;
use Image;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function settings() {
        return view('admin.settings');
    }

    public function login(Request $request) {
        if ($request->isMethod('POST')) {
            $data = $request->all();

            if (Auth::guard('admin')->attempt( ['email' => $data['email'], 'password' =>$data['password']])) {
                return redirect('admin/dashboard');
            } else {
                Session::flash('error', 'Invalid Email or Password');
                return redirect()->back();
            }
            
        }
        return view('admin.login');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function checkCurrentPassword(Request $request) {
        $data = $request->all();
        
        if (Hash::check($data['currentPassword'], Auth::guard('admin')->user()->password)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function updateCurrentPassword(Request $request) {
        $data = $request->all();

        if (Hash::check($data['currentPassword'], Auth::guard('admin')->user()->password)) {
            if ($data['newPassword'] == $data['confirmPassword']) {
                if ($data['currentPassword'] == $data['newPassword']) {
                    Session::flash('error', 'New Password cannot be the same as old password');
                    return redirect()->back();
                } else {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['newPassword'])]);
                    Session::flash('success', 'Password has been updated successfully!');
                    return redirect()->back();
                }
            } else {
                Session::flash('error', 'New Passwords do not match');
                return redirect()->back();
            }
        } else {
            Session::flash('error', 'Incorrect Password');
            return redirect()->back();
        }    
    }

    public function updateInfo( Request $request ) {

        //Validations
        if ( $request -> isMethod('POST') ) {
            $data = $request->all();

            $rules = [
                'name'  => 'required|regex:/^[\pL\s\-]+$/u',
                'phone' => 'required|numeric',
                'image' => 'mimes:jpeg,jpg,png,gif'
            ];

            $customMessages = [
                'name.alpha'        => 'Valid Name is required',
                'mobile.numeric'    => 'Valid phone number is required',
                'image'             => 'Valid image is required'
            ];

            $this->validate($request, $rules, $customMessages);

            // upload image
            if ($request->hasFile('image')) {
                $tempImage = $request->file('image');
                if ($tempImage->isValid()) {
                    //get extension
                    $extension = $tempImage->getClientOriginalExtension();

                    //generate new image name
                    $imageName = rand(111, 99999).'.'.$extension;
                    $imagePath = 'img/admin/photos/'.$imageName;

                    //upload the image
                    Image::make($tempImage)->save($imagePath);
                } else if (!empty($data['currentImage'])) {
                    $imageName = $data['currentImage'];
                } else {
                    $imageName = "";
                }
            }

            //Update admin info
            Admin::where('email', Auth::guard('admin')->user()->email)
                ->update(['name' => $data['name'], 'mobile' => $data['phone'], 'image' => $imageName]);
            Session::flash('success', 'Admin information updated succcesfully');
            
            return redirect()->back();
        }
        return view('admin/updateInfo');
    }
}
