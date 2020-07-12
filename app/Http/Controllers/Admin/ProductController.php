<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Product;
use App\Category;
use Session;
use Image;

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

    public function addEditProduct(Request $request, $id=null) {
        if($id=="") {
            
            // Create new product
            $title = "Add Product";
            $product = new Product;
            $productdata = array();
            $message = "Product added successfully!";


        } else {
            // Edit existing title
            $title = "Edit Product";

            $productdata = Product::find($id);
            $productdata = json_decode(json_encode($productdata), true);
            // "<pre>"; print_r($productdata); die;

            $product = Product::find($id);
            $message = "Product updated successfully!";

        }

        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            //Category Validations
            $rules = [
                'product_colour'  => 'required|regex:/^[\pL\s\-]+$/u',
                'product_price'  => 'required|numeric',
                //'category_image' => 'mimes:jpeg,jpg,png,gif'
            ];

            $customMessages = [
                'product_colour.regex'   => 'Valid Colour is required',
                'product_price.numeric'   => 'Valid Price is required'
                //'category_image.mimes'  => 'Valid image is required'
            ];

            $this->validate($request, $rules, $customMessages);
            
            if(empty($data['is_featured'])) {
                $is_featured = "No";
            } else{
                $is_featured = "Yes";
            }

            if(empty($data['product_discount'])) {
                $data['product_discount'] = "";
            }

            if(empty($data['product_video'])) {
                $data['product_video'] = "";
            }

            if(empty($data['productMainImage'])) {
                $data['productMainImage'] = "";
            }

            if(empty($data['meta_title'])) {
                $data['meta_title'] = "";
            }

            if(empty($data['meta_description'])) {
                $data['meta_description'] = "";
            }

            if(empty($data['meta_keywords'])) {
                $data['meta_keywords'] = "";
            }

            //upload product image
            if($request->hasFile( 'main_image' )) {
                $image_tmp = $request->file( 'main_image');
                if( $image_tmp->isValid()) {
                    
                    //generate image name
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = $image_name.'-'.rand(111, 99999).'.'.$extension;
                    
                    $large_image_path = 'img/product/large/'.$imageName;
                    $medium_image_path = 'img/product/medium/'.$imageName;
                    $small_image_path = 'img/product/small/'.$imageName;

                    //upload and resize
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260,300)->save($small_image_path);

                    $product->main_image = $imageName;
                }
            }

            //upload product video
            if($request->hasFile( 'product_video')) {
                $video_tmp = $request->file('product_video');

                if($video_tmp->isValid()) {
                    $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = $video_name.'-'.rand().'.'.$extension;

                    $video_path = 'vid/product/';
                    $video_tmp->move($video_path,$video_name);

                    $product->video =  $videoName;
                }
            }

            //save product to db
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->name = $data['product_name'];
            $product->code = $data['product_code'];
            $product->color = $data['product_colour'];
            $product->price = $data['product_price'];
            $product->discount = $data['product_discount'];
            $product->size = $data['product_size'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->featured = $is_featured;
            $product->status = $data['status'];
            $product-> save();
            Session::flash('success', $message);
            return redirect('admin/products');
        }

        /* 
        Array Filters
        $materialArray = array('Beads', 'Stones', 'Leather');
        pass into view when in use
        */

        //Sections with Categories and sub categories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
        // echo "<pre>"; print_r($categories); die;

        return view('admin.products.addEdit')->with(compact('title', 'categories', 'productdata'));
    }
}
