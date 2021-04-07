<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Product;
use App\Category;
use App\ProductsAttribute;
use App\ProductsImage;
use App\Brand;
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
            //echo "<pre>"; print_r($data); die;

            //Category Validations
            $rules = [
                //'product_colour'  => 'required|regex:/^[\pL\s\-]+$/u',
                'product_price'  => 'required|numeric',
                //'category_image' => 'mimes:jpeg,jpg,png,gif'
            ];

            $customMessages = [
                'product_colour.regex'   => 'Valid Colour is required',
                'product_price.numeric'   => 'Valid Price is required'
                //'category_image.mimes'  => 'Valid image is required'
            ];

            $this->validate($request, $rules, $customMessages);

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
            $product->brand_id = $data['brand_id'];
            $product->bundle = $data['bundle'];
            $product->category_id = $data['category_id'];
            $product->name = $data['product_name'];
            $product->code = $data['product_code'];
            //$product->color = $data['product_colour'];
            $product->price = $data['product_price'];
            $product->discount = $data['product_discount'];
            $product->gemstone = $data['gemstone'];
            $product->material = $data['material'];
            //$product->size = $data['product_size'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            if(!empty($data['isFeatured'])) {
                $product->featured = $data['isFeatured'];
            } else{
                $product->featured = "No";
            }
            $product->status = $data['status'];
            $product-> save();
            Session::flash('success', $message);
            return redirect('admin/products');
        }

         
        //Array Filters
        $productFilters = Product::productFilters();
        //echo "<pre>"; print_r($productFilters); die;
        $materialArray = $productFilters['materialArray'];
        $gemstoneArray = $productFilters['gemstoneArray'];
        $bundleArray = $productFilters['bundleArray'];

        //Sections with Categories and sub categories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
        // echo "<pre>"; print_r($categories); die;
        $brands = Brand::where('status', 1)->get();
        $brands = json_decode(json_encode($brands), true);

        return view('admin.products.addEdit')->with(compact('title', 'categories', 'productdata', 'materialArray', 'gemstoneArray', 'bundleArray', 'brands'));
    }

    public function deleteImage($id) {
        // Get  Image
        $productImage = Product::select('main_image')->where('id', $id)->first();

        //Get image path
        $smallImagePath = 'img/product/small/';
        $mediumImagePath = 'img/product/medium/';
        $largeImagePath = 'img/product/large/';

        //Delete image from folder
        if(file_exists($smallImagePath.$productImage->main_image)) {
            unlink($smallImagePath.$productImage->main_image);
        }

        if(file_exists($mediumImagePath.$productImage->main_image)) {
            unlink($mediumImagePath.$productImage->main_image);
        }

        if(file_exists($largeImagePath.$productImage->main_image)) {
            unlink($largeImagePath.$productImage->main_image);
        }

        // Delete from db
        Product::where('id', $id)->update(['main_image'=>'']);

        Session::flash('success', 'Image deleted successfully');

        return redirect()->back();
    }

    public function deleteVideo($id) {
        // Get  Image
        $productVideo = Product::select('video')->where('id', $id)->first();

        //Get image path
        $videoPath = 'vid/product/';


        //Delete image from folder
        if(file_exists($videoPath.$productVideo->video)) {
            unlink($videoPath.$productVideo->video);
        }

        // Delete from db
        Product::where('id', $id)->update(['video'=>'']);

        Session::flash('success', 'Video deleted successfully');

        return redirect()->back();
    }

    public function addAttributes(Request $request, $id) {
        if( $request->isMethod('post')) {
            $data = $request->all();

            //echo "<pre>"; print_r($data); die;
            foreach( $data['sku'] as $key => $value) {
                if( !empty( $value)) {
                    //SKU check
                    $attrCountSKU = ProductsAttribute::where('sku', $value)->count();
                    if($attrCountSKU>0) {
                        $message = 'SKU already exists. Please add another SKU!';
                        session::flash('error', $message);
                        return redirect()->back();
                    }

                    //Size and colour check
                    $attrCountColour = ProductsAttribute::where(['product_id'=>$id, 'colour'=>$data['colour'][$key]])->count();
                    $attrCountSize = ProductsAttribute::where(['product_id'=>$id, 'size'=>$data['size'][$key]])->count();
                    if($attrCountSize>0 && $attrCountColour>0) {
                        $message = 'Size and colour already exists!';
                        session::flash('error', $message);
                        return redirect()->back();
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;

                    $attribute->sku = $value;
                    $attribute->size= $data['size'][$key];
                    $attribute->colour= $data['colour'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }

            $message = 'Product attributes have been added successfully!';
            session::flash('success', $message);
            return redirect()->back();
        }

        $productdata = Product::select('id', 'name', 'code', 'color', 'main_image')
            ->with('attributes')->find($id);
        $productdata = json_decode(json_encode($productdata), true);
        //echo "<pre>"; print_r($productdata); die;

        $title = "Product Attributes";

        return view('admin.products.attributes')->with(compact('productdata', 'title'));

    }

    public function editAttributes(Request $request, $id) {
        if( $request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach ($data[ "attrId"] as $key => $attr) {
                if(!empty($attr)) {
                    ProductsAttribute::where(['id'=>$data['attrId'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                }
            }

            $message = 'Product attributes have been updated successfully!';
            session::flash('success', $message);
            return redirect()->back();
        }
    }

    public function updateAttributeStatus(Request $request) {
        if($request->ajax()) {
            $data = request()->all();
            //echo "<pre>"; print_r($data);
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            ProductsAttribute::where('id', $data['attribute_id'])
                ->update(['status'=>$status]);
            return response()->json(
                ['status'=>$status, 'attribute_id'=>$data['attribute_id']]);
        }
    }

    public function deleteAttribute($id) {
        //Find and delete attribute
        ProductsAttribute::where('id', $id)->delete();

        Session::flash('success', 'Attribute deleted successfully');
        return redirect()->back();
    }

    public function addImages(Request  $request, $id) {
        //if method is post
        if($request->isMethod('post')) {
            if($request->hasFile('images')) {
                $images = $request->file('images');

                foreach ($images as $key => $image) {
                    $productImage = new ProductsImage;
                    $image_tmp = Image::make($image);
                    $extension = $image->getClientOriginalExtension();
                    $imageName = rand(111, 999999).time().".".$extension;

                    $large_image_path = 'img/product/large/'.$imageName;
                    $medium_image_path = 'img/product/medium/'.$imageName;
                    $small_image_path = 'img/product/small/'.$imageName;

                    //upload and resize
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260,300)->save($small_image_path);

                    $productImage->image = $imageName;
                    $productImage->product_id = $id;
                    $productImage->status = 1;
                    $productImage->save();
                }

                $message = 'Images added successfully!';
                session::flash('success', $message);
                return redirect()->back();
            }
        }

        //Find product
        $productdata = Product::with('images')->select('id', 'name', 'code', 'color', 'main_image')
            ->find($id);
        $productdata = json_decode(json_encode($productdata), true);
        // echo "<pre>"; print_r($productdata); die;
        $title = "Product Images";

        return view('admin/products/addimage')->with(compact('title','productdata'));
    }

    public function updateImageStatus(Request $request) {
        if($request->ajax()) {
            $data = request()->all();
            //echo "<pre>"; print_r($data);
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            ProductsImage::where('id', $data['image_id'])
                ->update(['status'=>$status]);
            return response()->json(
                ['status'=>$status, 'image_id'=>$data['image_id']]);
        }
    }

    public function deleteProductImage($id) {
        // Get  Image
        $productImage = ProductsImage::select('image')->where('id', $id)->first();

        //Get image path
        $smallImagePath = 'img/product/small/';
        $mediumImagePath = 'img/product/medium/';
        $largeImagePath = 'img/product/large/';

        //Delete image from folder
        if(file_exists($smallImagePath.$productImage->image)) {
            unlink($smallImagePath.$productImage->image);
        }

        if(file_exists($mediumImagePath.$productImage->image)) {
            unlink($mediumImagePath.$productImage->image);
        }

        if(file_exists($largeImagePath.$productImage->image)) {
            unlink($largeImagePath.$productImage->image);
        }

        // Delete from db
        ProductsImage::where('id', $id)->delete();

        Session::flash('success', 'Image deleted successfully');
        return redirect()->back();
    }
}
