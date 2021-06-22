@extends('layouts.front.front_layout')
@section('content')
    <div class="main-content main-content-login">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumb-trail breadcrumbs">
						<ul class="trail-items breadcrumb">
							<li class="trail-item trail-begin">
								<a href="index.html">Home</a>
							</li>
							<li class="trail-item trail-end active">
								Account
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-in-stock-wrapp">
                            <div class="container">
                                <h3 class="custommenu-title-blog white">
                                    My Account
                                </h3>
                                <div class="ysera-product style3">
                                    <ul class="row list-products auto-clear equal-container product-grid">
                                        <li class="product-item  col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12 style-3">
                                            <div class="product-inner equal-element">
                                                <div class="product-thumb">
                                                    <div class="thumb-inner">
                                                        <a href="#" tabindex="0">
                                                            <img src="{{asset('img/product/sent.png')}}" alt="Your Orders">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <h5 class="product-name product_title">
                                                        <a href="#" tabindex="0">Your Orders</a>
                                                    </h5>
                                                    <div class="group-info">
                                                        <p class="des">View your orders</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-item style-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12">
                                            <div class="product-inner equal-element">
                                                <div class="product-thumb">
                                                    <div class="thumb-inner">
                                                        <a href="#" tabindex="0">
                                                            <img src="{{asset('img/product/login.png')}}" alt="Login & Security">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <h5 class="product-name product_title">
                                                        <a href="{{ url('/account/profile')}}" tabindex="0">Login & Security</a>
                                                    </h5>
                                                    <div class="group-info">
                                                        <p class="des">Edit login, name and phone</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-item style-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12">
                                            <div class="product-inner equal-element">
                                                <div class="product-thumb">
                                                    <div class="thumb-inner">
                                                        <a href="#" tabindex="0">
                                                            <img src="{{asset('img/product/address.png')}}" alt="Your Addresses">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <h5 class="product-name product_title">
                                                        <a href="{{ url('/account/address')}}" tabindex="0">Your Addresses</a>
                                                    </h5>
                                                    <div class="group-info">
                                                        <p class="des">Add/edit your address</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-item style-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12">
                                            <div class="product-inner equal-element">
                                                <div class="product-thumb">
                                                    <div class="thumb-inner">
                                                        <a href="#" tabindex="0">
                                                            <img src="{{asset('img/product/credit-card.png')}}" alt="Your Payments">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <h5 class="product-name product_title">
                                                        <a href="#" tabindex="0">Your Payments</a>
                                                    </h5>
                                                    <div class="group-info">
                                                        <p class="des">Manage your payment methods</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-item style-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12">
                                            <div class="product-inner equal-element">
                                                <div class="product-thumb">
                                                    <div class="thumb-inner">
                                                        <a href="#" tabindex="0">
                                                            <img src="{{asset('img/product/wishlist.png')}}" alt="Your Wishlist">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <h5 class="product-name product_title">
                                                        <a href="#" tabindex="0">Your Wishlist</a>
                                                    </h5>
                                                    <div class="group-info">
                                                        <p class="des">View your wishlist</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-item style-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12">
                                            <div class="product-inner equal-element">
                                                <div class="product-thumb">
                                                    <div class="thumb-inner">
                                                        <a href="#" tabindex="0">
                                                            <img src="{{asset('img/product/email.png')}}" alt="Your Messages">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <h5 class="product-name product_title">
                                                        <a href="#" tabindex="0">Your Messages</a>
                                                    </h5>
                                                    <div class="group-info">
                                                        <p class="des">View messages recieved from WunderKrafts</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection