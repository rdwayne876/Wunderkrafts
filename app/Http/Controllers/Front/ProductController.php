<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listing( Request $request) {

        if( $request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;
            //dd($data);

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
                if(isset($data['gemstone']) && !empty($data['gemstone'])) {
                    $categoryProducts->whereIn('products.gemstone', $data['gemstone']);
                }
                if(isset($data['bundle']) && !empty($data['bundle'])) {
                    $categoryProducts->whereIn('products.bundle', $data['bundle']);
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
    
                $categoryProducts = $categoryProducts->paginate(2);
    
                return view('front.products.ajaxlisting')->with(compact('categoryDetails', 'categoryProducts', 'url'));
                
            } else{
                abort(404);
            }
      
        } else{
            Paginator::useBootstrap();
            $url = Route::getFacadeRoot()->current()->uri();
            //dd($url);
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            
            

            if( $categoryCount>0) {
                //echo "Category exists"; die;
                $categoryDetails = Category::catDetails($url);
                //echo "<pre>"; print_r($categoryDetails);die;
    
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
                //echo "<pre>"; print_r($categoryProducts);die;
    
                $categoryProducts = $categoryProducts->orderBy('id', 'Desc');
    
                $categoryProducts = $categoryProducts->paginate(2);

                //Array Filters
                $productFilters = Product::productFilters();
                //echo "<pre>"; print_r($productFilters); die;
                $materialArray = $productFilters['materialArray'];
                $gemstoneArray = $productFilters['gemstoneArray'];
                $bundleArray = $productFilters['bundleArray'];
    
                return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'url','materialArray','gemstoneArray','bundleArray'));
                
            } else{
                abort(404);
            }
        }
    }

    public function detail( $code, $id){
        
        return view('front.products.detail');
    }
}
