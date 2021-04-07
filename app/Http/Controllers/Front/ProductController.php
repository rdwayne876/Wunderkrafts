<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listing($url, Request $request) {

        if( $request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;

            $url = $data['url'];

            Paginator::useBootstrap();

            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
    
            if( $categoryCount>0) {
                //echo "Category exists"; die;
                $categoryDetails = Category::catDetails($url);
                //echo "<pre>"; print_r($categoryDetails);die;
    
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
                //echo "<pre>"; print_r($categoryProducts);die;
    
                //check filters
                if(isset($data['material']) && !empty($data['material'])) {
                    $categoryProducts->whereIn('products.material', $data['material']);
                }

                //check for sort condition
                if(isset($data['sort']) && !empty($data['sort'])) {
                    if($data['sort'] == "product_latest") {
                        $categoryProducts->orderBy('id', 'Desc');
                    } else if($data['sort'] == "product_name_a_z") {
                        $categoryProducts->orderBy('name', 'Asc');
                    } else if($data['sort'] == "product_price_lowest") {
                        $categoryProducts->orderBy('price', 'Asc');
                    } else if($data['sort'] == "product_price_highest") {
                        $categoryProducts->orderBy('price', 'Desc');
                    }
                } else{
                    $categoryProducts = $categoryProducts->orderBy('id', 'Desc');
                }
    
                $categoryProducts = $categoryProducts->paginate(12);
    
                return view('front.products.ajaxlisting')->with(compact('categoryDetails', 'categoryProducts', 'url'));
                
            } else{
                abort(404);
            }
      
        } else{
            Paginator::useBootstrap();

            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
    
            if( $categoryCount>0) {
                //echo "Category exists"; die;
                $categoryDetails = Category::catDetails($url);
                //echo "<pre>"; print_r($categoryDetails);die;
    
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
                //echo "<pre>"; print_r($categoryProducts);die;
    
                $categoryProducts = $categoryProducts->orderBy('id', 'Desc');
    
                $categoryProducts = $categoryProducts->paginate(12);

                //Array Filters
                $productFilters = Product::productFilters();
                //echo "<pre>"; print_r($productFilters); die;
                $materialArray = $productFilters['materialArray'];
                $gemstoneArray = $productFilters['gemstoneArray'];
                $setArray = $productFilters['setArray'];
    
                return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'url','materialArray','gemstoneArray','setArray'));
                
            } else{
                abort(404);
            }
        }
    }
}
