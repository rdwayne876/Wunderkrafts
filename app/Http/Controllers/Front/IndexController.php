<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function index() {
        $page_name = "index";

        $featuredCount = Product::where('featured', 'Yes')->where('status', '1')->count();
        $featuredProducts = Product::where('featured', 'Yes')->where('status', '1')->get()->toArray();
        $featuredProducts = array_slice($featuredProducts, 0, 6);
        //dd($featuredProducts); die;
        //$featuredProductsChunk = array_chunk($featuredProducts, 6);

        $latestProducts = Product::where('status', '1')->orderBy('id', 'Desc')->limit(6)->get()->toArray();
        //dd($latestProducts);die;

        return view('front.index')->with(compact('page_name', 'featuredProducts', 'latestProducts'));
    }
}
