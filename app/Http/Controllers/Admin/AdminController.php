<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Hash;
use Auth;
use App\Admin;

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
}
