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
							<li class="trail-item">
								 <a href="{{ url('/account')}}">My Account</a>
							</li>
							<li class="trail-item trail-end active">
								My Address
							</li>
						</ul>
					</div>
				</div>
			</div>
                <div class="ysera-product produc-featured rows-space-40">
                <div class="container">
                    <h3 class="custommenu-title-blog">
                        My Addresses
                    </h3>
                    <ul class="row list-products auto-clear equal-container product-grid">
                        <li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                            <div class="product-inner equal-element">
                                <div class="product-thumb">
                                    <div class="thumb-inner">
                                        <a href="#">
                                            <img src="{{asset('img/product/address2.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-name product_title">
                                        <a href="{{ url('/account/address/add-address')}}">Add New Address</a>
                                    </h5>
                                </div>
                            </div>
                        </li>
                        <li class="product-item product-type-variable col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                            <div class="product-inner equal-element">
                                <div class="product-info">
                                    <p class="des"></p>
                                    <h5 class="product-name product_title">
                                        {{$userDetails['name']}}
                                    </h5>
                                    <p class="des"></p>
                                    <h5 class="product-name product_title">
                                    </h5>
                                    @if(!empty($userDetails['address']))
                                        <p>{{$userDetails['address']}}</p>
                                        <p class="des">{{$userDetails['address']}}</p>
                                        <p class="des">{{$userDetails['city']}}, {{$userDetails['zipcode']}}, {{$userDetails['country']}}</p>
                                        <div class="description">
                                            <a href="#">Edit</a> | <a href="#">Delete</a>
                                        </div>
                                    @else
                                        <p>Address Line 1</p>
                                        <p class="des">Address Line 2</p>
                                        <p class="des">City, Zip, Country</p>
                                        <div class="description">
                                            <a href="#">Edit</a> | <a href="#">Delete</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
		</div>
	</div>
@endsection