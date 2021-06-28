<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Coupon;
use App\User;
use Session;


class CouponsController extends Controller
{
    public function coupons() {
        $coupons = Coupon::get()->toArray();
        //dd($coupons); die;

        return view('admin.coupons.coupons')->with(compact('coupons'));
    }

    public function updateCouponStatus(Request $request) {
        if($request->ajax()) {
            $data = request()->all();

            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Coupon::where('id', $data['coupon_id'])
                ->update(['status'=>$status]);

            return response()->json(
                ['status'=>$status, 'coupon_id'=>$data['coupon_id']]);
        }
    }

    public function addEditCoupon(Request $request, $id=null){
        if($id==""){
            $coupon = new Coupon;
            $title = "Add Coupon";
            $selCats = array();
            $selUsers = array();
            $message = "Coupon added successfully";
            $selDate = "";
        }else{
            $coupon = Coupon::find($id);
            $title = "Edit Coupon";
            $selCats = explode(',', $coupon['categories']);
            $selUsers = explode(',', $coupon['users']);
            $date = explode('-', $coupon['expire_date']);
            $selDate = $date[2].'/'.$date[1].'/'.$date[0];
            //dd($selDate);
            $message = "Coupon updated successfully";
            
        }

        if($request->isMethod('post')){
            $data = $request->all();

            $rules = [
                'categories' => 'required',
                'coupon_option' => 'required',
                'coupon_type' => 'required',
                'amount_type' => 'required',
                'coupon_expire_date' => 'required'

            ];
            $customMessage = [
                'categories.required' => 'Select categories',
                'coupon_option.required' => 'Select Coupon Option',
                'coupon_type.required' => 'Select Coupon Type',
                'amount_type.required' => 'Select Amount Type',
                'amount.required' => 'Enter Amount',
                'coupon_expire_date.required' => 'Set Coupon expire date',
            ];
            $this->validate($request, $rules, $customMessage);
            //dd($data); die;
            if(isset($data['users'])){
                $users =  implode(',', $data['users']);
            }else{
                $users = "";
            }
            if(isset($data['categories'])){
                $categories =  implode(',', $data['categories']);
            }
            if($data['coupon_option'] == "Automatic") {
                $coupon_code = str_random(8);
            } else{
                $coupon_code = $data['coupon_code'];
            }

            $coupon_expire_date = explode('/', $data['coupon_expire_date']);
            $expire_date = $coupon_expire_date[2].'-'.$coupon_expire_date[1].'-'.$coupon_expire_date[0];
            //dd($data);

            $coupon->coupon_option = $data['coupon_option'];
            $coupon->coupon_code = $coupon_code;
            $coupon->categories = $categories;
            $coupon->users = $users;
            $coupon->coupon_type = $data['coupon_type'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->amount = $data['amount'];
            $coupon->expire_date = $expire_date;
            $coupon->status = $data['status'];
            $coupon->save();

            session::flash('success', $message);
            return redirect('admin/coupons');
        }

        //Sections with Categories and sub categories
        $categories = Section::with('categories')->get()->toArray();
        $users = User::select('email')->where('status', 1)->get()->toArray();

        return view('admin.coupons.addEditCoupon')->with(compact('title', 'coupon', 'categories', 'users', 'selCats', 'selUsers', 'selDate'));
    }

    public function delete($id) {
        //Find and delete brand
        Coupon::where('id', $id)->delete();

        Session::flash('success', 'Coupon deleted successfully');
        return redirect()->back();
    }
        
}
