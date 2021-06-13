<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category() {
        return $this->belongsTo('App\Category', 'category_id');
    }

    //check sections tabble using product section id
    public function section() {
        return $this->belongsTo('App\Section', 'section_id');
    }

    public function brand(){
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function attributes() {
        return $this->hasMany('App\ProductsAttribute');
    }

    public function images() {
        return $this->hasMany('App\ProductsImage');
    }

    public static function productFilters(){

        $productFilters['materialArray'] = array('Beads', 'Leather', 'Accrylic', 'Resin');
        $productFilters['gemstoneArray'] = array('Topaz', 'Malachite', 'Jade');
        $productFilters['bundleArray'] = array('none', 'Two-Piece', 'Three-Piece', 'Four-Piece');

        return $productFilters;
    }

    public static function getDiscountedPrice($product_id) {
        $proDetails = Product::select('category_id','price', 'discount')->where('id', $product_id)->first()->toArray();
        //echo "<pre>";print_r($proDetails); die;
        $catDetails = Category::select('category_discount')->where('id', $proDetails['category_id'])->first()->toArray();

        if($proDetails['discount']>0){
            $discountedPrice = $proDetails['price'] - ($proDetails['price']*$proDetails['discount']/100);
        } else if( $catDetails['category_discount']>0) {
            $discountedPrice = $proDetails['price'] - ($proDetails['price']*$catDetails['category_discount']/100);
        } else {
            $discountedPrice = 0;
        }

        return $discountedPrice;
    }

    public static function getDiscountedAttrPrice($product_id, $size) {
        $proAttrPrice = ProductsAttribute::where(['product_id'=>$product_id, 'size'=>$size])->first()->toArray();

        $proDetails = Product::select('category_id', 'discount')->where('id', $product_id)->first()->toArray();
        //echo "<pre>";print_r($proDetails); die;
        $catDetails = Category::select('category_discount')->where('id', $proDetails['category_id'])->first()->toArray();

        if($proDetails['discount']>0){
            $discountedPrice = $proAttrPrice['price'] - ($proAttrPrice['price']*$proDetails['discount']/100);
            $discount = $proAttrPrice['price'] - $discountedPrice;
        } else if( $catDetails['category_discount']>0) {
            $discountedPrice = $proAttrPrice['price'] - ($proAttrPrice['price']*$catDetails['category_discount']/100);
            $discount = $proAttrPrice['price'] - $discountedPrice;
        } else {
            $discountedPrice = 0;
            $discount = 0;
        }

        return array('product_price'=>$proAttrPrice['price'], 'discounted_price'=>$discountedPrice, 'discount'=>$discountedPrice);

    }
}
