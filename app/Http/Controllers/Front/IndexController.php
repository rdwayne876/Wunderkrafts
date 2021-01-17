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
        //dd($featuredProducts); die;
        $featuredProductsChunk = array_chunk($featuredProducts, 6);

        return view('front.index')->withcompact('page_name');
    }
}
