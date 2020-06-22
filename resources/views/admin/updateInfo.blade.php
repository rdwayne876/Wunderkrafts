@section('title') 
Settings
@endsection 
@extends('layouts.admin_layout.main')
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
                            <h4 class="card-title">Update Information</h5>
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
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </ul>   
                                </div>
                            @endif

                            <form role="form" method="POST" action=" {{ url('/admin/updateInfo') }} " name="updateInfoForm" id="updateInfoForm" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-group">
                                    <label for="Email">Email address</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value=" {{ Auth::guard('admin')->user()->email }} " readonly="">
                                    
                                </div>

                                <div class="form-group">
                                    <label for="type">Admin Type</label>
                                    <input type="text" class="form-control" id="type" aria-describedby="type" value=" {{ Auth::guard('admin')->user()->type }} " readonly="">
                                    
                                </div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ Auth::guard('admin')->user()->name }}" required>
                                    <small id="checkCurrentPassword" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter new phone number" value="{{ Auth::guard('admin')->user()->mobile }}" required>
                                </div>

                                <div class=" form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    @if (!empty(Auth::guard('admin')->user()->image))
                                        <a target="_blank" href=" {{url('img/admin/photos/'.Auth::guard('admin')->user()->image)}} ">View Image</a>
                                        <input type="hidden" name="currentImage" value=" {{Auth::guard('admin')->user()->image}} ">
                                    @endif
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