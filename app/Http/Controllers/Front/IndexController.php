<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $page_name = "index";

        $featuredCount = Product::where('featured', 'Yes')->count();
        $featuredProducts = Product::where('featured', 'Yes')->get()->toArray();
        $featuredProducts = array_slice($featuredProducts, 0, 6);
        //dd($featuredProducts); die;
        //$featuredProductsChunk = array_chunk($featuredProducts, 6);

        return view('front.index')->with(compact('page_name', 'featuredProducts'));
    }
}
