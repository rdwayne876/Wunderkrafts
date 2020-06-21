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
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form role="form" method="POST" action=" {{ url('/admin/updateInfo') }} " name="updateInfoForm" id="updateInfoForm" >
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
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value=" {{ Auth::guard('admin')->user()->name }} " required>
                                    <small id="checkCurrentPassword" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter new phone number" value=" {{ Auth::guard('admin')->user()->phone }} " required>
                                </div>

                                <label for="image">Image</label>
                                <div class=" form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
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