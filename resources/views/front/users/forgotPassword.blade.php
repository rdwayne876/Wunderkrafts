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
								Password Reset
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="site-main">
						<h3 class="custom_blog_title">
							Forgot Password?
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
										<h5 class="title-login">Enter your email address to reset your Password</h5>
										<form id="forgotPasswordForm" class="login" action="{{ url('/forgot-password')}}" method="post">@csrf
											<p class="form-row form-row-wide">
												<label class="text" for="username">Email</label>
												<input name="username" id="username" title="username" type="text" class="input-text" required="">
											</p>
											<p class="form-row">
												<input type="submit" class="button-submit" value="Submit">
											</p>
										</form>
									</div>
								</div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
									<div class="login-item">
										<h5 class="title-login">Login</h5>
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
							</div>
						-</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection