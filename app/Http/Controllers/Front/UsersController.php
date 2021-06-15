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
                $user->name = $data['name'];
                $user->mobile = $data['phone'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['registerPassword']);
                $user->save();

                if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['registerPassword']])){
                    echo "<pre>"; print_r(Auth::user()); die;
                    return redirect('/');
                }
            }
        }
    }

    public function checkEmail(Request $request){
        $data = $request->all();
        $emailCount = User::where('email', $data['email'])->count();
        
        if($emailCount>0){
            return "false";
        } else {
            return "true";
        }
    }

    public function logoutUser(){
        Auth::logout();
        return redirect('/');
    }
}
