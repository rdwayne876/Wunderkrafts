<ul class="row list-products auto-clear equal-container product-grid">
    @foreach($categoryProducts as $product)
        <li class="product-item product-type-variable col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12 style-1">
            <div class="product-inner equal-element">
                <div class="product-top">
                </div>
                <div class="product-thumb">
                    <div class="thumb-inner">
                        <a href="#">
                            @if(isset($product['main_image']))
                                <?php 
                                    $product_image_path ='img/product/medium/'.$product['main_image'];
                                ?>
                            @else
                                <?php 
                                    $product_image_path ='';
                                ?>
                            @endif
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