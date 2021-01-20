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
                
                <form name="bannerForm" id="bannerForm" class="form-validate" 
                    @if(empty($banner['id']))
                        action="{{url('admin/banners/addEditBanner')}}"
                    @else 
                        action="{{url('admin/banners/addEditBanner/'.$banner['id'])}}"
                    @endif
                    method="post" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="bannerImage">Banner Image</label>
                            <div class="input-group col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="bannerImage" name="image">
                                    <label class="custom-file-label" for="bannerImage" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                                </div>
                            </div>
                            @if(!empty($banner['image']))
                                <div class="col-md-6 offset-md-3">
                                    <img src=" {{asset('img/banner/'.$banner['image'])}} " width="600px">
                                    <a href="javascript:void(0)" class="confirmDelete" record="banners/delete/image" recordid="{{$banner['id']}}" <?php /* href="{{url('admin/deleteImage/'.$banner['id'])}} " */ ?>><button type="button" class="btn btn-danger-rgba"><i class="feather icon-trash-2 mr-2"></i> Delete</button></a> 
                                </div>
                            @endif
                        </div> 

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="bannerLink">Link<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="bannerLink" name="banner_link" placeholder="Enter Link" required
                                @if(!empty($banner['link'])) value="{{$banner['link']}}" @else value="{{old('banner_link')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="bannerTitleOne">Banner Header<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="bannerTitleOne" name="banner_title_one" placeholder="Enter Banner Header" required
                                @if(!empty($banner['title_one'])) value="{{$banner['title_one']}}" @else value="{{old('title_one')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="bannerTitleOne">Banner Sub-Header<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="bannerTitleTwo" name="banner_title_two" placeholder="Enter Banner Sub-Header" required
                                @if(!empty($banner['title_two'])) value="{{$banner['title_two']}}" @else value="{{old('title_two')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="bannerTitleOne">Banner Text<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="bannerText" name="banner_text" placeholder="Enter Banner Text" required
                                @if(!empty($banner['text'])) value="{{$banner['text']}}" @else value="{{old('text')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="bannerStatus">Active or Inactive<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="bannerStatus" name="status">
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