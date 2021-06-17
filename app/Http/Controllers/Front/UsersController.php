<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Cart;
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
                    //echo "<pre>"; print_r(Auth::user()); die;
                    if(!empty(Session::get('session_id'))){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id', $session_id)->update(['user_id'=>$user_id]);
                    }

                    //send register email
                    $email = $data['email'];
                    $messageData = ['name'=>$data['name'], 'phone'=>$data['phone'],'email'=>$data['email']];
                    Mail::send('emails.register', $messageData, function($message) use($email){
                        $message->to($email)->subject('Welcome to WunderKrafts!');
                    });
                    
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

    public function loginUser(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            if(Auth::attempt(['email'=>$data['username'], 'password'=>$data['password']])){
                //update user cart w/ user id
                if(!empty(Session::get('session_id'))){
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id', $session_id)->update(['user_id'=>$user_id]);
                }
                return redirect('/');
            } else {
                $message = "Invalid username or password";
                Session::flash('error', $message);
                return redirect()->back();
            }
        }
    }

    public function logoutUser(){
        Auth::logout();
        return redirect('/');
    }
}
