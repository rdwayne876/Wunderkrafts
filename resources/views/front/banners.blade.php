<?php use App\Banner;
    $getBanners = Banner::getBanners();
?>

<div class="home-slider fullwidth rows-space-60">
    <div class="slider-owl owl-slick equal-container nav-center equal-container"
         data-slick='{"autoplay":true, "autoplaySpeed":10000, "arrows":true, "dots":true, "infinite":true, "speed":800, "rows":1}'
         data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":1}}]'>
         @foreach($getBanners as  $banner)
            <div class="slider-item style4" style="background-image: url('{{asset('img/banner/'.$banner['image'])}}'); background-size: cover; background-repeat: no-repeat;">
                <div class="slider-inner equal-element">
                   <!-- <img  src="{{asset('img/banner/'.$banner['image'])}}">  -->          
                    <div class="container">
                        <div class="slider-infor">
                            <h5 class="title-small">
                                Sale up to 40% off!
                            </h5>
                            <h3 class="title-big">
                                Ring Jewelry <br/>
                                Design
                            </h3>
                            <div class="price">
                                New Price:
                                <span class="number-price">
                                            $25.00
                                        </span>
                            </div>
                            <a href="#" class="button btn-shop-the-look bgroud-style">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>