@section('title') 
Settings
@endsection 
@extends('layouts.admin.main')
@section('style')

@endsection 
@section('rightbar-content')
<!-- Start Contentbar -->    
<div class="contentbar">                
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="mt-3 mb-5">
                <!-- Start col -->
                <div class="col-lg-6">
                    <div class="card m-b-30">
                        <div class="card-header bg-primary">
                            <h4 class="card-title">Update Password</h5>
                        </div>
                        <div class="card-body">

                            @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                    {{ Session::get('error')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>   
                            @endif

                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissable fade show" role="alert">
                                    {{ Session::get('success')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>   
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form role="form" method="POST" action=" {{ url('/admin/updateCurrentPassword') }} " name="updateAdminPasswordForm" id="updateAdminPasswordForm" >
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value=" {{ Auth::guard('admin')->user()->email }} " readonly="">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Current Password</label>
                                    <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password" required>
                                    <small id="checkCurrentPassword" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
<!-- End Contentbar -->
@endsection 
@section('script')

@endsection 