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
								Authentication
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="site-main">
						<h3 class="custom_blog_title">
							Authentication
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
										<h5 class="title-login">Login your Account</h5>
										<form id="loginForm" class="login" action="{{ url('/login')}}" method="post">@csrf
											<p class="form-row form-row-wide">
												<label class="text" for="username">Username</label>
												<input name="username" id="username" title="username" type="text" class="input-text">
											</p>
											<p class="form-row form-row-wide">
												<label for="password" class="text">Password</label>
												<input id="password" name="password" title="password" type="password" class="input-text">
											</p>
											<p class="lost_password">
												<span class="inline">
													<input type="checkbox" id="cb1">
													<label for="cb1" class="label-text">Remember me</label>
												</span>
												<a href="{{ url('forgot-password')}}" class="forgot-pw">Forgot password?</a>
											</p>
											<p class="form-row">
												<input type="submit" class="button-submit" value="login">
											</p>
										</form>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="login-item">
										<h5 class="title-login">Register now</h5>
										<form id="registerForm" class="register" action="{{ url('/register')}}" method="post">@csrf
											<p class="form-row form-row-wide">
												<label for="name" class="text">Your name</label>
												<input id="name" name="name" title="name" type="text" class="input-text">
											</p>
											<p class="form-row form-row-wide">
												<label for="email" class="text">Your email</label>
												<input id="email" name="email" title="email" type="email" class="input-text">
											</p>
                                            <p class="form-row form-row-wide">
												<label for="phone" class="text">Phone</label>
												<input id="phone" name="phone" title="phone" type="text" class="input-text">
											</p>
											<p class="form-row form-row-wide">
												<label for="registerPassword" class="text">Password</label>
												<input id="registerPassword" name="registerPassword" title="pass" type="password" class="input-text">
											</p>
											<p class="form-row form-row-wide">
												<label for="confirmPassword" class="text">Confirm Password</label>
												<input id="confirmPassword" name="confirmPassword" title="pass" type="password" class="input-text">
											</p>
											<p class="form-row">
												<span class="inline">
													<input  type="checkbox" id="registerAgree" name="registerAgree">
													<label for="registerAgree" class="label-text">I agree to <span>Terms & Conditions</span></label>
												</span>
											</p>
											<p class="">
												<input type="submit" class="button-submit" value="Register Now">
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