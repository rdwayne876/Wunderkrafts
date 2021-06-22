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
                            <li class="trail-item">
								 <a href="{{ url('/account/address')}}">My Addresses</a>
							</li>
							<li class="trail-item trail-end active">
								Add New Address
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="site-main">
						<h3 class="custom_blog_title">
							Add New Address
						</h3>
						<div class="customer_login">
							<div class="row">
								@if (Session::has('error'))
									<div class="alert alert-danger" role="alert">
										{{ Session::get('error')}}
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>   
								@endif

								@if (Session::has('success'))
									<div class="alert alert-success " role="alert">
										{{ Session::get('success')}}
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>   
								@endif
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="login-item">
										<h5 class="title-login">Enter your Shipping Address</h5>
										<form id="editProfile" class="register" action="{{ url('/account/address/add-address')}}" method="post">@csrf
											<p class="form-row form-row-wide">
												<label class="text" for="country">Country</label>
												<input name="country" id="country" title="Country" type="text" class="input-text" >
											</p>
                                            <p class="form-row form-row-wide">
												<label for="address1" class="text">Address</label>
												<input id="address1" name="address1" title="Address Line 1" type="text" class="input-text" >
											</p>
                                            <p class="form-row form-row-wide">
												<input id="address2" name="address2" title="Address Line 2" type="text" class="input-text" >
											</p>
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-12">
                                                    <p class="form-row form-row-wide">
                                                        <label class="text" for="city">City</label>
                                                        <input name="city" id="city" title="City" type="text" class="input-text" >
                                                    </p>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                    <p class="form-row form-row-wide">
                                                        <label class="text" for="state">State</label>
                                                        <input name="state" id="state" title="State" type="text" class="input-text" >
                                                    </p>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-6">
                                                    <p class="form-row form-row-wide">
                                                        <label class="text" for="zip">Zip</label>
                                                        <input name="zip" id="zip" title="Zip" type="text" class="input-text" >
                                                    </p>
                                                </div>
                                            </div>
											<p class="form-row">
												<input type="submit" class="button-submit" value="Add Address">
											</p>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection