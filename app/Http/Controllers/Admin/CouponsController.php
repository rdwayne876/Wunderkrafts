<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Coupon;
use App\User;



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
        }else{
            $coupon = Coupon::find($id);
            $title = "Edit Coupon";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            dd($data); die;
        }

        //Sections with Categories and sub categories
        $categories = Section::with('categories')->get()->toArray();
        $users = User::select('email')->where('status', 1)->get()->toArray();

        return view('admin.coupons.addEditCoupon')->with(compact('title', 'coupon', 'categories', 'users'));
    }
        
}
