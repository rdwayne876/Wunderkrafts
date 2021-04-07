
@extends('layouts.front.front_layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="{{url('/')}}">{{$categoryDetails['catDetails']['category_name']}}</a>
                        </li>
                        <?php echo $categoryDetails['breadcrumbs']; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="wrapper-sidebar shop-sidebar">
                    <div class="widget woof_Widget">
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
                        <div class="widget widget-categories">
                            <h3 class="widgettitle">Materials</h3>
                            <ul class="list-categories">
                                @foreach($materialArray as $material)
                                    <li>
                                        <input class="material" type="checkbox" id="{{ $material}}" name="material[]" value="{{ $material}}">
                                        <label for="{{ $material }}" class="label-text">
                                           {{ $material}}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget-categories"> 
                            <h3 class="widgettitle">Gemstones</h3>
                            <ul class="list-categories">
                                @foreach($gemstoneArray as $gemstone)
                                    <li>
                                        <input class="gemstone" type="checkbox" id="{{ $gemstone}}" name="gemstone[]" value="{{ $gemstone}}">
                                        <label for="{{ $gemstone }}" class="label-text">
                                           {{ $gemstone}}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget-categories">
                            <h3 class="widgettitle">Sets</h3>
                            <ul class="list-categories">
                                @foreach($bundleArray as $bundle)
                                    <li>
                                        <input class="bundle" type="checkbox" id="{{ $bundle}}" name="bundle[]" value="{{ $bundle}}">
                                        <label for="{{ $bundle }}" class="label-text">
                                           {{ $bundle}}
                                        </label>
                                    </li>
                                @endforeach
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
                        <form name="sortProducts"  class="filter-choice select-form">
                            <input type="hidden" name="url" id="url" value="{{ $url }}">
                            <span class="title">Sort by</span>
                            <select name="sort" id="sort" title="sort-by" data-placeholder="Sort By" class="chosen-select">
                                <option value="">Select</option>
                                <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort'] == "product_latest") selected="" @endif>Latest Products</option>
                                <option value="product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort'] == "product_name_a_z") selected="" @endif>Name: A - Z</option>
                                <option value="product_price_lowest" @if(isset($_GET['sort']) && $_GET['sort'] == "product_price_lowest") selected="" @endif>Price: Low to High</option>
                                <option value="product_price_highest" @if(isset($_GET['sort']) && $_GET['sort'] == "product_price_highest") selected="" @endif>Price: High to Low</option>
                            </select>
                        </form>
                    </div>
                    <div class="filter_products">
                        @include('front.products.ajaxlisting')
                    </div>
                    <div class="pagination clearfix style3">
                        <div class="nav-link">
                            @if(isset($_GET['sort']) && !empty($_GET['sort']))
                                {{ $categoryProducts->appends(['sort' => $_GET['sort']])->onEachside(1)->links() }}
                            @else
                                {{ $categoryProducts->onEachside(1)->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

