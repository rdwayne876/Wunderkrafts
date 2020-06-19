<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Hash;
use Auth;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
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
}
