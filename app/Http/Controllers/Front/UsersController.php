<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Cart;
use Session;
use Auth;
use App\Country;

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
                $user->status = 0;
                $user->save();

                // send confirm email
                $email = $data['email'];
                $messageData = [
                    'email'=> $data['email'],
                    'name'=> $data['name'],
                    'code'=> base64_encode($data['email'])
                ];

                Mail::send('emails.confirmation', $messageData, function($message) use($email){
                    $message->to($email)->subject('Confirm your Account');
                });

                $message = "Please confirm your email to activate your account!";
                Session::put('success', $message);

                return redirect()->back();


                if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['registerPassword']])){
                    //echo "<pre>"; print_r(Auth::user()); die;
                    if(!empty(Session::get('session_id'))){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id', $session_id)->update(['user_id'=>$user_id]);
                    }
                    
                    return redirect('/');
                }
            }
        }
    }

    public function confirmAccount($email){

        Session::forget('error');
        Session::forget('success');

        //decode email
        $email = base64_decode($email);

        //check if user account exists
        $userCount = User::where('email', $email)->count();
        if($userCount>0){
            //check if user account already activated
            $userDetails = User::where('email', $email)->first();
            if($userDetails->status == 1){
                $message = "Your email account has already been activated. Please login.";
                Session::put('error', $message);
                return redirect('login-register');
            } else{
                User::where('email', $email)->update(['status'=>1]);

                //send register email
                $messageData = ['name'=>$userDetails['name'], 'phone'=>$userDetails['phone'],'email'=>$userDetails['email']];
                Mail::send('emails.register', $messageData, function($message) use($email){
                    $message->to($email)->subject('Welcome to WunderKrafts!');
                });

                $message = "Your account has been activated. Please login to continue";
                Session::flash('success', $message);
                return redirect('login-register');
            }
        } else{
            abort(404);
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

                //check if user is activated
                $userStatus = User::where('email', $data['username'])->first();
                if($userStatus->status == 0){
                    Auth::logout();
                    $message = "Account not Activated! Please activate your account to continue!";
                    Session::flash('error', $message);
                    return redirect()->back();
                }
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

    public function account(Request $request){

        return view('front.users.account');
    }

    public function profile(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id)->toArray();

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            $user = User::find($user_id);
            $user-> name = $data['name'];
            $user-> email = $data['email'];
            $user-> mobile = $data['phone'];
            $user->save();

            return redirect()->back();
        }

        return view('front.users.profile')->with(compact('userDetails'));
    }
    
    public function address(){

        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id)->toArray();

        return view('front.users.address')->with(compact('userDetails'));
    }

    public function addAddress(Request $request){

        $countries = Country::where('status', 1)->get()->toArray();
        //dd($countries); die;

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            $user_id =  Auth::user()->id;
            $user = User::find($user_id);
            $user-> country = $data['country'];
            $user-> address = $data['address1'];
            $user-> city = $data['city'];
            $user-> state = $data['state'];
            $user-> zipcode = $data['zip'];
            $user-> save();

            return redirect('/account/address');
        }
        
        return view('front.users.addAddress')->with(compact('countries'));
    }

    public function updatePassword(Request $request) {
        $data = $request->all();
        $user_id =  Auth::user()->id;

        $user = User::find($user_id);
        echo "<pre>"; print_r($user); die;

    }

    public function logoutUser(){
        Auth::logout();
        return redirect('/');
    }

    public function forgotPassword(Request $request){

        if($request->isMethod('POST')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            $emailCount = User::where('email', $data['username'])->count();
            if($emailCount == 0){
                $message = "Email address not found";
                Session::flash('error', $message);
                Session::forget('success');

                return redirect()->back();
            }

            $randomPassword = str_random(8);
            $newPassword = bcrypt($randomPassword);

            User::where('email', $data['username'])->update(['password'=>$newPassword]);

            $userName = User::Select('name')->where('email', $data['username'])->first();
            $email = $data['username'];
            $name = $userName->name;
            $messageData = [
                'email' => $email,
                'name' => $name,
                'password' => $randomPassword
            ];

            Mail::send('emails.forgotPassword', $messageData, function($message)use($email){
                $message->to($email)->subject('New Password - WunderKrafts');
            });

            $message = "Please check your email for new password!";
            Session::flash('success', $message);
            Session::forget('error');
            return redirect('login-register');
        }
        return view('front.users.forgotPassword');
    }
}
