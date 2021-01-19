<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Banner;
use Session;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banners() {
        $banners = Banner::get()->toArray();
        //dd($banners);die;

        return view('admin.banners.banners')->with(compact('banners'));
    }

    public function updateBannerStatus(Request $request) {
        if($request->ajax()) {
            $data = request()->all();

            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Banner::where('id', $data['banner_id'])
                ->update(['status'=>$status]);

            return response()->json(
                ['status'=>$status, 'banner_id'=>$data['banner_id']]);
        }
    }

    public function delete($id) {

        $bannerImage = Banner::where('id', $id)->first();

        $bannerImagePath = 'img/banner/';

        if(file_exists($bannerImagePath.$bannerImage->image)){
            unlink($bannerImagePath.$bannerImage->image);
        }

        //Find and delete banner
        Banner::where('id', $id)->delete();

        Session::flash('success', 'Banner deleted successfully');
        return redirect()->back();
    }
    
}
