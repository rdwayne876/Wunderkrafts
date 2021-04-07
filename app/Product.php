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
}
