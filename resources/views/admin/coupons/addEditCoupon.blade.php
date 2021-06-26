@section('title') 
{{$title}}
@endsection 
@extends('layouts.admin.main')
@section('style')
    <!-- Switchery css -->
    <link href="{{asset('assets/admin/plugins/switchery/switchery.min.css')}}" rel="stylesheet">
    <!-- Select2 css -->
    <link href="{{asset('assets/admin/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Tagsinput css -->
    <link href="{{asset('assets/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css')}}" rel="stylesheet" type="text/css">
    <!-- End css -->
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
                
                <form name="couponForm" id="couponForm" class="form-validate" 
                    @if(empty($coupon['id']))
                        action="{{url('admin/coupons/addEditCoupon')}}"
                    @else 
                        action="{{url('admin/coupons/addEditCoupon/'.$coupon['id'])}}"
                    @endif
                    method="post" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="couponImage">Coupon Option</label>
                            <div class="col-lg-6">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="coupon_option" id="automaticCoupon" value="Automatic">
                                  <label class="form-check-label" for="coupon_option">Automatic</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="coupon_option" id="manualCoupon" value="Manual">
                                  <label class="form-check-label" for="coupon_option">Manual</label>
                                </div>
                            </div>
                        </div> 

                        <div class="form-group row" style="display:none;" id="couponField">
                            <label class="col-lg-3 col-form-label" for="coupon-code">Coupon Code<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="couponCode" name="coupon_code" placeholder="Enter Coupon Code" required
                                @if(!empty($coupon['coupon_code'])) value="{{$coupon['coupon_code']}}" @else value="{{old('coupon_code')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="category" required>Categories<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                            <select class="select2-multi-select form-control" name="categories[]" multiple="multiple">
                                <option value="">Please Select</option>
                                    @foreach ($categories as $section)
                                        <optgroup label="{{ $section['name'] }}"></optgroup>
                                        @foreach($section['categories'] as $category)
                                            <option value=" {{$category['id']}} ">
                                                &nbsp;&nbsp;&nbsp;{{$category['category_name']}}
                                                @foreach($category['subcategories'] as $subcategory)
                                                    <option value="{{$subcategory['id']}}">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{$subcategory['category_name']}}
                                                    </option>
                                                @endforeach
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="couponTitleOne">Coupon Sub-Header<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="couponTitleTwo" name="coupon_title_two" placeholder="Enter Coupon Sub-Header" required
                                @if(!empty($coupon['title_two'])) value="{{$coupon['title_two']}}" @else value="{{old('title_two')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="couponTitleOne">Coupon Text<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="couponText" name="coupon_text" placeholder="Enter Coupon Text" required
                                @if(!empty($coupon['text'])) value="{{$coupon['text']}}" @else value="{{old('text')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="couponStatus">Active or Inactive<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="couponStatus" name="status">
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
<!-- Switchery js -->
<script src="{{asset('assets/admin/plugins/switchery/switchery.min.js')}}"></script>
<!-- Select2 js -->
<script src="{{asset('assets/admin/plugins/select2/select2.min.js')}}"></script>    
<!-- Tagsinput js -->
<script src="{{asset('assets/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/bootstrap-tagsinput/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/admin/js/custom/custom-form-select.js')}}"></script>
<!-- Core js -->
<script src="{{asset('assets/js/core.js')}}"></script>
<!-- End js -->
<!-- Parsley js -->
<script src="{{ asset('assets/admin/plugins/validatejs/validate.min.js') }}"></script>
<!-- Validate js -->
<script src="{{ asset('assets/admin/js/custom/custom-validate.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/custom-form-validation.js') }}"></script>
<!-- Sweet-Alert js -->
<script src="{{ asset('assets/admin/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/custom-sweet-alert.js') }}"></script>
@endsection 