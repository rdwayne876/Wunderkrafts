<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listing($url) {

        $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();

        if( $categoryCount>0) {
            //echo "Category exists"; die;
            $categoryDetails = Category::categoryDetails($url);
            echo "<pre>"; print_r($categoryDetails);die;
        } else{
            abort(404);
        }
    }
}
