<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;

class UsersController extends Controller
{
    public function loginRegister(){
        
        return view('front.users.loginRegister');
    }

    public function registerUser(Request $request) {
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            //check if user already exists
            $userCount = User::where('email',$data['email'])->count();

            if($userCount>0) {
                $message = "Email already in use!";
                session::flash('error', $message);
                return redirect()->back();
            } else {
                $user = new User;
                $user->name = $data['username'];
                $user->mobile = $data['phone'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();

                if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
                    echo "<pre>"; print_r(Auth::user()); die;
                    return redirect('/');
                }
            }
        }
    }

    public function logoutUser(){
        Auth::logout();
        return redirect('/');
    }
}