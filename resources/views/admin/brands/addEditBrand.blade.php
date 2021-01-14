@section('title') 
{{$title}}
@endsection 
@extends('layouts.admin.main')
@section('style')
<!-- Sweet Alert css -->
<link href="{{ asset('assets/admin/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection 
@section('rightbar-content')
<!-- Start Contentbar -->    
<div class="contentbar">
    <!-- Start row -->
    <div class="row justify-content-center">
        <!-- Start col -->
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Catalogue</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle">{{$title}}</h6>

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
                
                <form name="brandForm" id="brandForm" class="form-validate" 
                    @if(empty($brand['id']))
                        action="{{url('admin/brands/addEditBrand')}}"
                    @else 
                        action="{{url('admin/brands/addEditBrand/'.$brand['id'])}}"
                    @endif
                    method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="brandName">Collection Name<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="brandName" name="brand_name" placeholder="Enter Brand Name" required
                                @if(!empty($brand['name'])) value="{{$brand['name']}}" @else value="{{old('brand_name')}}" @endif>
                            </div>
                        </div>
                        
                        

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="brandStatus">Active or Inactive<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="brandStatus" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"></label>
                            <div class="col-lg-8">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>                                  
                    </form>
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
<!-- Parsley js -->
<script src="{{ asset('assets/admin/plugins/validatejs/validate.min.js') }}"></script>
<!-- Validate js -->
<script src="{{ asset('assets/admin/js/custom/custom-validate.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/custom-form-validation.js') }}"></script>
<!-- Sweet-Alert js -->
<script src="{{ asset('assets/admin/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/custom-sweet-alert.js') }}"></script>
@endsection 