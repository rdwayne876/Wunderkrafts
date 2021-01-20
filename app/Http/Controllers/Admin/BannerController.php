<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Banner;
use Session;
use Image;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banners() {
        $banners = Banner::get()->toArray();
        //dd($banners);die;

        return view('admin.banners.banners')->with(compact('banners'));
    }

    public function addEditBanner($id=null, Request $request) {
        if( $id=="") {
            $title = "Add Banner";

            $banner = new Banner;
            $message = "Banner added Succesfully!";

        } else{
            $title = "Edit Banner";

            $banner = Banner::find($id);
            $message = "Banner updated successfully!";
        }

        if($request->isMethod('post')) {
            $data = $request->all();
            //dd($data);die;

            $banner->link = $data['banner_link'];
            $banner->title_one = $data['banner_title_one'];
            $banner->title_two = $data['banner_title_two'];
            $banner->text = $data['banner_text'];
            $banner->status = $data['status'];

            //upload Banner image
            if($request->hasFile( 'image' )) {
                $image_tmp = $request->file( 'image');
                if( $image_tmp->isValid()) {
                    
                    //generate image name
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = $image_name.'-'.rand(111, 99999).'.'.$extension;
                    
                    $image_path = 'img/banner/'.$imageName;


                    //upload and resize
                    Image::make($image_tmp)->save($image_path);

                    $banner->image = $imageName;
                }
            }
            $banner->save();

            Session::flash('success', $message);

            return redirect('admin/banners');
        }

        return view('admin.banners.addEditBanner')->with(compact('title', 'banner'));
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
