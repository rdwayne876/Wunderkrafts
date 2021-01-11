<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use Session;

class BrandController extends Controller
{
    public function brands() {
        $brands = Brand::get();
        return view('admin.brands.brands')->with(compact('brands'));
    }

    public function updateBrandStatus(Request $request) {
        if($request->ajax()) {
            $data = request()->all();

            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Brand::where('id', $data['brand_id'])
                ->update(['status'=>$status]);

            return response()->json(
                ['status'=>$status, 'brand_id'=>$data['brand_id']]);
        }
    }

    public function addEditBrand(Request $request, $id=null) {
        if($id=="") {
            
            // Create new brand
            $title = "Add Brand";
            $brand = new Brand;
            $message = "Brand added successfully!";

        } else {
            // Edit existing title
            $title = "Edit Brand";

            // Gert brand data
            $brand = Brand::find($id);
            $message = "$brand->name updated successfully!";
        }

        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            //Brand Validations
            $rules = [
                'brand_name'  => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessages = [
                'brand_name.regex'   => 'Valid Category Name is required',
            ];

            $this->validate($request, $rules, $customMessages);

            //add brand
            $brand->name = $data['brand_name'];
            $brand->save();


            Session::flash('success', $message);
            return redirect('admin/brands');
        }

        return view('admin.brands.addEditBrand')
            ->with(compact('title', 'brand'));
    }

    public function delete($id) {
        //Find and delete product
        Brand::where('id', $id)->delete();

        Session::flash('success', 'Brand deleted successfully');
        return redirect()->back();
    }
}
