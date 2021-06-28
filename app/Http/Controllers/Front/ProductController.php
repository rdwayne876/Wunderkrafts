<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\ProductsAttribute;
use App\Category;
use App\Product;
use App\Coupon;
Use App\Cart;
use App\User;
use Session;
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

            $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($data['product_id'], $data['size']);
            
            return $getDiscountedAttrPrice;
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
            
            if(Auth::check()){
                $user_id = Auth::user()->id;
            } else{
                $user_id = 0;
            }

            // Save Product in cart
            /*Cart::insert(['session_id'=>$session_id,
                'product_id'=>$data['product_id'],
                'size'=>$data['size'],
                'quantity'=>$data['quantity']]); */

            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->user_id = $user_id;
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

    public function updateCartItemQty(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;
            $cartDetails = Cart::find($data['cartid']);

            $availableStock = ProductsAttribute::select('stock')->where(['product_id'=>$cartDetails['product_id'], 'size'=>$cartDetails['size']])->first();

            if($data['qty']>$availableStock['stock']){
                return response()->json([
                    'status'=>false,
                    'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))
                ]);
            }

            Cart::where('id', $data['cartid'])->update(['quantity'=>$data['qty']]);
            $userCartItems = Cart::userCartItems();

            return response()->json([
                'status'=>true,
                'view'=>(String)View::make('front.products.cartItems')->with(compact('userCartItems'))
            ]);
        }
    }

    public function deleteCartItem(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;

            Cart::where('id', $data['cartid'])->delete();
            $userCartItems = Cart::userCartItems();

            return response()->json([
                'view'=>(String)View::make('front.products.cartItems')->with(compact('userCartItems'))]);
        }
    }

    public function applyCoupon(Request $request){
        if($request->ajax()){
            $data = $request->all();

            //echo "<pre>"; print_r($data);die;
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();

            if($couponCount == 0){

                $userCartItems = Cart::userCartItems();
                
                return response()->json([
                    'status'=>false, 
                    'message'=>'Coupon is not valid',
                    'view'=>(String)View::make('front.products.cartItems')->with(compact('userCartItems'))]);
            } else{
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();

                if($couponDetails->status == 0) {
                    $message = 'This coupon is inactive';
                }

                $expire_date = $couponDetails->expire_date;
                $current_date =  date('Y-m-d');
                if($expire_date< $current_date){
                    $message =  "This coupon is expired";
                }

                $catArray = explode(",", $couponDetails->categories);
                $userCartItems = Cart::userCartItems();
                $userArr = explode(",", $couponDetails->users);
                $total_amount = 0;

                foreach( $userArr as $key => $user){
                    $getUserID = User::Select('id')->where('email', $user)->first()->toArray();
                    $userID[] = $getUserID['id'];
                }
                foreach( $userCartItems as $key => $item){
                    if(!in_array($item['product']['category_id'], $catArray)){
                        $message = 'This coupon is not valid for products in your cart';
                    }
                    if(!in_array($item['user_id'], $userID)){
                        $message = "This coupoun in not Vailid";
                    }

                    $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);
                    //echo "<pre>"; print_r($attrPrice);die;
                    $total_amount = $total_amount + ($attrPrice['discounted_price'] * $item['quantity']);
                    
                }


                if(isset($message)) {
                    $userCartItems = Cart::userCartItems();
                    return response()->json([
                        'status'=>flase, 
                        'message'=>$message,
                        'view'=>(String)View::make('front.products.cartItems')->with(compact('userCartItems'))]);
                } else {
                    if($couponDetails->amount_type == "Fixed"){
                        $couponAmount = $couponDetails->amount;
                    } else{
                        $couponAmount = $total_amount * ($couponDetails->amount/100);
                    }

                    $orderTotal = $total_amount - $couponAmount;
                    //echo "<pre>"; print_r($orderTotal);die;

                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode', $data['code']);

                    $message = 'Coupon applied successfully';

                    $userCartItems = Cart::userCartItems();
                    return response()->json([
                        'status'=>true, 
                        'message'=>$message,
                        'orderTotal'=>$orderTotal,
                        'view'=>(String)View::make('front.products.cartItems')->with(compact('userCartItems'))]);
                }
            }
        }
    }

}
