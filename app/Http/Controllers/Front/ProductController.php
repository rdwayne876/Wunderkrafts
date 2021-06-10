<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use Illuminate\Http\Request;
use Session;
Use App\Cart;
use Auth;

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
        
        $productDetail = Product::with( ['category', 'brand', 'attributes'=>function($query){
            $query->where('status', 1);
            }, 
            'images'])->find( $id)->toArray();
        //dd($productDetail);

        $total_stock = ProductsAttribute::where('product_id', $id)->sum('stock');
        $relatedProducts = Product::where('category_id', $productDetail['category']['id'])->where('id', '!=', $id)->limit(6)->inRandomOrder()->get()->toArray();
        //dd($relatedProducts); die;

        return view( 'front.products.detail')->with( compact( 'productDetail', 'relatedProducts'));
    }

    public function getSize( Request $request){
        
        if( $request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;

            $getProductprice = ProductsAttribute::where(['product_id'=>$data['product_id'], 'size'=>$data['size']])->first();
            
            return $getProductprice->price;
        }
    }

    public function addtocart( Request $request) {
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;

            //check availability
            $getProductStock = ProductsAttribute::where(['product_id'=>$data['product_id'], 'size'=>$data['size']])->first()->toArray();
            //echo "<pre>"; print_r($getProductStock);die;

            if($getProductStock['stock']<$data['quantity']){
                $message = "Required Quantity is not Available!";
                session::flash('error', $message);
                return redirect()->back();
            }

            //Generate Session ID if not exist
            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }

            //check if product is already in cart
            if(Auth::check()){
                $countProducts = Cart::where(['product_id'=>$data['product_id'], 'size'=>$data['size'], 'user_id'=>Auth::user()->id])->count();
            } else {
                $countProducts = Cart::where(['product_id'=>$data['product_id'], 'size'=>$data['size'], 'session_id'=>Session::get('session_id')])->count();
            }

            if($countProducts>0){
                $message = "Product Already in Cart!";
                session::flash('error', $message);
                return redirect()->back();
            }

            // Save Product in cart
            /*Cart::insert(['session_id'=>$session_id,
                'product_id'=>$data['product_id'],
                'size'=>$data['size'],
                'quantity'=>$data['quantity']]); */

            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->quantity = $data['quantity'];
            $cart->save();

            $message = "Product Added to Cart!";
            session::flash('success', $message);
            return redirect()->back();

        }
    }

    public function cart( Request $request) {
        $userCartItems = Cart::userCartItems();
        //echo "<pre>"; print_r($userCartItems);die;

        return view('front.products.cart')->with(compact('userCartItems'));
    }
}
