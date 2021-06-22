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
								Login & Security
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="site-main">
						<h3 class="custom_blog_title">
							Login & Security
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
										<h5 class="title-login">Edit Your Information</h5>
										<form id="editProfile" class="register" action="{{ url('/account/profile')}}" method="post">@csrf
											<p class="form-row form-row-wide">
												<label class="text" for="name">Name</label>
												<input name="name" id="name" title="Name" type="text" class="input-text" value="{{$userDetails['name']}}" >
											</p>
                                            <p class="form-row form-row-wide">
												<label for="email" class="text">Your email</label>
												<input id="email" name="email" title="email" type="email" class="input-text" value="{{$userDetails['email']}}" >
											</p>
                                            <p class="form-row form-row-wide">
												<label for="phone" class="text">Phone</label>
												<input id="phone" name="phone" title="phone" type="text" class="input-text" value="{{$userDetails['mobile']}}">
											</p>
											<p class="form-row">
												<input type="submit" class="button-submit" value="Update">
											</p>
										</form>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="login-item">
										<h5 class="title-login">Update Password</h5>
										<form id="resetPasswordForm" class="register" action="{{ url('/update-password')}}" method="post">@csrf
											<p class="form-row form-row-wide">
												<label for="currentPassword" class="text">Current Password</label>
												<input id="currentPassword" name="currentPassword" title="pass" type="password" class="input-text" value="********">
											</p>
											<p class="form-row form-row-wide">
												<label for="newPassword" class="text">New Password</label>
												<input id="newPassword" name="newPassword" title="pass" type="password" class="input-text">
											</p>
											<p class="form-row form-row-wide">
												<label for="confirmPassword" class="text">Confirm Password</label>
												<input id="confirmPassword" name="confirmPassword" title="pass" type="password" class="input-text">
											</p>
											<p class="">
												<input type="submit" class="button-submit" value="Update">
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