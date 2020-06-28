<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Session;

class ProductController extends Controller
{
    public function products() {
        $products = Product::with(['category'=>function($query) {
            $query->select('id', 'category_name');
        }, 'section'=>function($query) {
            $query->select('id', 'name');}])->get();

        $products = json_decode(json_encode($products));
        //echo "<pre>"; print_r($products); die;   
        
        return view('admin.products.products')->with(compact('products'));
    
    }

    public function updateProductStatus(Request $request) {
        if($request->ajax()) {
            $data = request()->all();

            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Product::where('id', $data['product_id'])
                ->update(['status'=>$status]);

            return response()->json(
                ['status'=>$status, 'product_id'=>$data['product_id']]);
        }
    }

    public function delete($id) {
        //Find and delete product
        Product::where('id', $id)->delete();

        Session::flash('success', 'Product deleted successfully');
        return redirect()->back();
    }
}
