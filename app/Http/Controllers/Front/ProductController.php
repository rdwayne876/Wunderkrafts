<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listing($url) {
        $page_name = 'listing';

        $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();

        if( $categoryCount>0) {
            //echo "Category exists"; die;
            $categoryDetails = Category::catDetails($url);
            //echo "<pre>"; print_r($categoryDetails);die;

            $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->get()->toArray();
            //echo "<pre>"; print_r($categoryProducts);die;

            return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'page_name'));
        } else{
            abort(404);
        }
    }
}
