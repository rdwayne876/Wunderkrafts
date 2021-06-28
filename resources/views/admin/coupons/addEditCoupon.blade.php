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
    <!-- Datepicker css -->
    <link href="{{asset('assets/admin/plugins/datepicker/datepicker.min.css')}}" rel="stylesheet" type="text/css">
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
                        @if(empty($coupon['coupon_code']))
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="coupon_option">Coupon Option</label>
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
                                <input type="text" class="form-control" id="couponCode" name="coupon_code" placeholder="Enter Coupon Code"
                                @if(!empty($coupon['coupon_code'])) value="{{$coupon['coupon_code']}}" @else value="{{old('coupon_code')}}" @endif>
                            </div>
                        </div>
                        @else

                        <input type="hidden" name="coupon_option" value="{{$coupon['coupon_option']}}"/>

                        <input type="hidden" name="coupon_code" value="{{$coupon['coupon_code']}}"/>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="coupon-code">Coupon Code: {{ $coupon['coupon_code']}} </label>

                        </div>

                        @endif

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="category" required>Categories<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                            <select class="select2-multi-select form-control" name="categories[]" multiple="multiple">
                                <option value="">Please Select</option>
                                    @foreach ($categories as $section)
                                        <optgroup label="{{ $section['name'] }}"></optgroup>
                                        @foreach($section['categories'] as $category)
                                            <option value=" {{$category['id']}} " 
                                                @if(in_array($category['id'], $selCats)) 
                                                    selected=""
                                                @endif>     
                                                &nbsp;&nbsp;&nbsp;{{$category['category_name']}}
                                                @foreach($category['subcategories'] as $subcategory)
                                                    <option value="{{$subcategory['id']}}" 
                                                        @if(in_array($subcategory['id'], $selCats)) 
                                                            selected=""
                                                        @endif>
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
                            <label class="col-lg-3 col-form-label" for="users" required>Select Users<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="select2-multi-select form-control" name="users[]" multiple="multiple">
                                    <option value="">Please Select</option>
                                    @foreach($users as $user)
                                        <option value="{{$user['email']}}"
                                            @if(in_array($user['email'], $selUsers)) 
                                                selected=""
                                            @endif>
                                            {{$user['email']}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="coupon_type">Coupon Type</label>
                            <div class="col-lg-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="coupon_type" id="automaticCoupon" value="single"
                                        @if(isset($coupon['coupon_type']) && $coupon['coupon_type'] == "single" )
                                            checked=""
                                        @endif
                                    >
                                    <label class="form-check-label" for="coupon_type">Single-Use</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="coupon_type" id="manualCoupon" value="multiple"
                                        @if(isset($coupon['coupon_type']) && $coupon['coupon_type'] == "multiple" )
                                            checked=""
                                        @endif
                                    >
                                  <label class="form-check-label" for="coupon_type">Multi-Use</label>
                                </div>
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="amount_type">Amount Type</label>
                            <div class="col-lg-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="amount_type" id="percentageCoupon" value="Percentage"
                                        @if(isset($coupon['amount_type']) && $coupon['amount_type'] == "Percentage" )
                                            checked=""
                                        @endif
                                    >
                                  <label class="form-check-label" for="amount_type">Percentage</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="amount_type" id="fixedCoupon" value="Fixed"
                                        @if(isset($coupon['amount_type']) && $coupon['amount_type'] == "Fixed" )
                                            checked=""
                                        @endif
                                    >
                                  <label class="form-check-label" for="amount_type">Fixed</label>
                                </div>
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="amount">Coupon Amount<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter coupon amount"
                                    @if(isset($coupon['amount']))
                                        value="{{ $coupon['amount']}}"
                                    @endif
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="coupon_expire_date">Expire Date<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <div class="input-group">                                  
                                    <input name="coupon_expire_date" type="text" id="autoclose-date" class="datepicker-here form-control" placeholder="dd/mm/yyyy" aria-describedby="basic-addon3"/
                                        @if(isset($coupon['expire_date']))
                                            value="{{$coupon['expire_date']}}"
                                        @endif
                                    >
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon3"><i class="ri-calendar-line"></i></span>
                                    </div>
                                </div>
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
<script src="{{asset('assets/admin/plugins/datepicker/datepicker.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datepicker/i18n/datepicker.en.js')}}"></script>
<script src="{{asset('assets/admin/js/custom/custom-form-datepicker.js')}}"></script>
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