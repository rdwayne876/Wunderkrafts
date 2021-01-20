
@extends('layouts.front.front_layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="{{url('/')}}">Home</a>
                        </li>
                        <?php echo $categoryDetails['breadcrumbs']; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-area shop-grid-content no-banner col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="site-main">
                    <h3 class="custom_blog_title">
                        {{$categoryDetails['catDetails']['category_name']}}
                    </h3>
                    <div class="shop-top-control">
                        <form class="select-item select-form">
                            <span class="title">Sort</span>
                            <select title="sort" data-placeholder="12 Products/Page" class="chosen-select">
                                <option value="1">12 Products/Page</option>
                                <option value="2">9 Products/Page</option>
                                <option value="3">10 Products/Page</option>
                                <option value="4">8 Products/Page</option>
                                <option value="5">6 Products/Page</option>
                            </select>
                        </form>
                        <form class="filter-choice select-form">
                            <span class="title">Sort by</span>
                            <select title="sort-by" data-placeholder="Price: Low to High" class="chosen-select">
                                <option value="1">Price: Low to High</option>
                                <option value="2">Sort by popularity</option>
                                <option value="3">Sort by average rating</option>
                                <option value="4">Sort by newness</option>
                                <option value="5">Sort by price: low to high</option>
                            </select>
                        </form>
                        <div class="grid-view-mode">
                            <div class="inner">
                                <a href="listproducts.html" class="modes-mode mode-list">
                                    <span></span>
                                    <span></span>
                                </a>
                                <a href="gridproducts.html" class="modes-mode mode-grid  active">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <ul class="row list-products auto-clear equal-container product-grid">
                        @foreach($categoryProducts as $product)
                            <li class="product-item product-type-variable col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12 style-1">
                                <div class="product-inner equal-element">
                                    <div class="product-top">
                                    </div>
                                    <div class="product-thumb">
                                        <div class="thumb-inner">
                                            <a href="#">
                                                <?php 
                                                    $product_image_path ='img/product/medium/'.$product['main_image'];
                                                ?>
                                                @if(!empty($product['main_image']) && file_exists($product_image_path))
                                                    <img src="{{asset('img/product/medium/'.$product['main_image'])}}" alt="img">
                                                @else
                                                    <img src="{{asset('img/product/small/no_image.png')}}" alt="img">
                                                @endif
                                            </a>
                                            <div class="thumb-group">
                                                <div class="yith-wcwl-add-to-wishlist">
                                                    <div class="yith-wcwl-add-button">
                                                        <a href="#">Add to Wishlist</a>
                                                    </div>
                                                </div>
                                                <a href="#" class="button quick-wiew-button">Quick View</a>
                                                <div class="loop-form-add-to-cart">
                                                    <button class="single_add_to_cart_button button">Add to cart
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h5 class="product-name product_title">
                                            <a href="#">{{$product['name']}}</a>
                                        </h5>
                                        <div class="group-info">
                                            <div class="stars-rating">
                                                <div class="star-rating">
                                                    <span class="star-3"></span>
                                                </div>
                                                <div class="count-star">
                                                    (3)
                                                </div>
                                            </div>
                                            <div class="price">
                                                <ins>
                                                    ${{$product['price']}}
                                                </ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="pagination clearfix style3">
                        <div class="nav-link">
                            <a href="#" class="page-numbers"><i class="icon fa fa-angle-left"
                                                                aria-hidden="true"></i></a>
                            <a href="#" class="page-numbers">1</a>
                            <a href="#" class="page-numbers">2</a>
                            <a href="#" class="page-numbers current">3</a>
                            <a href="#" class="page-numbers"><i class="icon fa fa-angle-right"
                                                                aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="wrapper-sidebar shop-sidebar">
                    <div class="widget woof_Widget">
                        <div class="widget widget-categories">
                            <h3 class="widgettitle">Categories</h3>
                            <ul class="list-categories">
                                <li>
                                    <input type="checkbox" id="cb1">
                                    <label for="cb1" class="label-text">
                                        New Arrivals
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="cb2">
                                    <label for="cb2" class="label-text">
                                        Earrings
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="cb3">
                                    <label for="cb3" class="label-text">
                                        Tanzanites
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="cb4">
                                    <label for="cb4" class="label-text">
                                        Bracelets
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="cb5">
                                    <label for="cb5" class="label-text">
                                        Accessories
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="cb6">
                                    <label for="cb6" class="label-text">
                                        By Metal
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="widget widget_filter_price">
                            <h4 class="widgettitle">
                                Price
                            </h4>
                            <div class="price-slider-wrapper">
                                <div data-label-reasult="Range:" data-min="0" data-max="3000" data-unit="$"
                                     class="slider-range-price " data-value-min="0" data-value-max="1000">
                                </div>
                                <div class="price-slider-amount">
                                    <span class="from">$45</span>
                                    <span class="to">$215</span>
                                </div>
                            </div>
                        </div>
                        <div class="widget widget-brand">
                            <h3 class="widgettitle">Brand</h3>
                            <ul class="list-brand">
                                <li>
                                    <input id="cb7" type="checkbox">
                                    <label for="cb7" class="label-text">New Arrivals</label>
                                </li>
                                <li>
                                    <input id="cb8" type="checkbox">
                                    <label for="cb8" class="label-text">Earrings</label>
                                </li>
                                <li>
                                    <input id="cb9" type="checkbox">
                                    <label for="cb9" class="label-text">Tanzanites</label>
                                </li>
                                <li>
                                    <input id="cb10" type="checkbox">
                                    <label for="cb10" class="label-text">Bracelets</label>
                                </li>
                                <li>
                                    <input id="cb11" type="checkbox">
                                    <label for="cb11" class="label-text">Accessories</label>
                                </li>
                                <li>
                                    <input id="cb12" type="checkbox">
                                    <label for="cb12" class="label-text">By Metal</label>
                                </li>
                            </ul>
                        </div>
                        <div class="widget widget_filter_size">
                            <h4 class="widgettitle">Size</h4>
                            <ul class="list-brand">
                                <li>
                                    <input id="cb13" type="checkbox">
                                    <label for="cb13" class="label-text">14.0 mm</label>
                                </li>
                                <li>
                                    <input id="cb14" type="checkbox">
                                    <label for="cb14" class="label-text">14.4 mm</label>
                                </li>
                                <li>
                                    <input id="cb15" type="checkbox">
                                    <label for="cb15" class="label-text">14.8 mm</label>
                                </li>
                                <li>
                                    <input id="cb16" type="checkbox">
                                    <label for="cb16" class="label-text">15.2 mm</label>
                                </li>
                                <li>
                                    <input id="cb17" type="checkbox">
                                    <label for="cb17" class="label-text">15.6 mm</label>
                                </li>
                                <li>
                                    <input id="cb18" type="checkbox">
                                    <label for="cb18" class="label-text">16.0 mm</label>
                                </li>
                            </ul>
                        </div>
                        <div class="widget widget-color">
                            <h4 class="widgettitle">
                                Color
                            </h4>
                            <div class="list-color">
                                <a href="#" class="color1"></a>
                                <a href="#" class="color2 "></a>
                                <a href="#" class="color3 active"></a>
                                <a href="#" class="color4"></a>
                                <a href="#" class="color5"></a>
                                <a href="#" class="color6"></a>
                                <a href="#" class="color7"></a>
                            </div>
                        </div>
                        <div class="widget widget-tags">
                            <h3 class="widgettitle">
                                Popular Tags
                            </h3>
                            <ul class="tagcloud">
                                <li class="tag-cloud-link">
                                    <a href="#">Pendants</a>
                                </li>
                                <li class="tag-cloud-link">
                                    <a href="#">Bracelets</a>
                                </li>
                                <li class="tag-cloud-link">
                                    <a href="#">Flowering</a>
                                </li>
                                <li class="tag-cloud-link active">
                                    <a href="#">Accessories</a>
                                </li>
                                <li class="tag-cloud-link">
                                    <a href="#">Hot</a>
                                </li>
                                <li class="tag-cloud-link">
                                    <a href="#">By Metal</a>
                                </li>
                                <li class="tag-cloud-link">
                                    <a href="#">Earrings</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget newsletter-widget">
                        <div class="newsletter-form-wrap ">
                            <h3 class="title">Subscribe to Our Newsletter</h3>
                            <div class="subtitle">
                                More special Deals, Events & Promotions
                            </div>
                            <input type="email" class="email" placeholder="Your email letter">
                            <button type="submit" class="button submit-newsletter">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

