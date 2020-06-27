@section('title') 
{{$title}}
@endsection 
@extends('layouts.admin.main')
@section('style')
<!-- Sweet Alert css -->
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

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
                
                <form name="categoryForm" id="categoryForm" class="form-validate" 
                    @if(empty($categorydata['id']))
                        action="{{url('admin/addEditCategory')}}"
                    @else 
                        action="{{url('admin/addEditCategory/'.$categorydata['id'])}}"
                    @endif
                    method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="categoryName">Category Name<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="categoryName" name="category_name" placeholder="Enter Category Name" required
                                @if(!empty($categorydata['category_name'])) value="{{$categorydata['category_name']}}" @else value="{{old('category_name')}}" @endif>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="section">Section<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="section_id" name="section_id">
                                    <option value="">Please select</option>
                                    @foreach ($getSections as $section)
                                        <option value="{{$section->id}}"
                                        @if (!empty($categorydata['section_id']) && $categorydata['section_id']==$section->id) selected @endif>
                                            {{$section->name}}
                                        </option>   
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="appendLevel">
                            @include('admin.categories.appendLevel')
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="categoryImage">Category Image</label>
                            <div class="input-group col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="categoryImage" name="category_image">
                                    <label class="custom-file-label" for="categoryImage" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                                </div>
                            </div>
                            @if(!empty($categorydata['category_image']))
                                <div class="col-md-6 offset-md-3">
                                    <img src=" {{asset('img/category/'.$categorydata['category_image'])}} " width="100px">
                                    <a href="javascript:void(0)" class="confirmDelete" record="deleteImage" recordid="{{$categorydata['id']}}" <?php /* href="{{url('admin/deleteImage/'.$categorydata['id'])}} " */ ?>><button type="button" class="btn btn-danger-rgba"><i class="feather icon-trash-2 mr-2"></i> Delete</button></a> 
                                </div>
                            @endif
                        </div> 

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="catgeoryDiscount">Category Discount</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="categoryDiscount" name="category_discount" placeholder="Enter Category Discount"
                                @if(!empty($categorydata['category_discount'])) value="{{$categorydata['category_discount']}}" @else value="{{old('category_discount')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="categoryDescription">Category Description <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="categoryDescription" name="description" rows="5" placeholder="Enter Description." required>@if(!empty($categorydata['description'])){{$categorydata['description']}}@else{{old('description')}}@endif</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="categoryURL">Category URL<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="categoryURL" name="url" placeholder="Enter Category URL" required
                                @if(!empty($categorydata['url'])) value="{{$categorydata['url']}}" @else value="{{old('url')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="metaTitle">Meta Title</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="metaTitle" name="meta_title" placeholder="Enter Meta Title"
                                @if(!empty($categorydata['meta_title'])) value="{{$categorydata['meta_title']}}" @else value="{{old('meta_title')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="metaDescription">Meta Description</label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="metaDescription" name="meta_description" rows="5" placeholder="Enter Meta Description.">@if(!empty($categorydata['meta_description'])) {{$categorydata['meta_description']}} @else {{old('meta_description')}} @endif</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="metaKeywords">Meta Keywords</label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="metaKeywords" name="meta_keywords" rows="5" placeholder="Enter Meta Keywords.">@if(!empty($categorydata['meta_keywords'])) {{$categorydata['meta_keywords']}} @else {{old('meta_keywords')}} @endif</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="categoryStatus">Active or Inactive<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="categoryStatus" name="status">
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
<script src="{{ asset('assets/plugins/validatejs/validate.min.js') }}"></script>
<!-- Validate js -->
<script src="{{ asset('assets/js/custom/custom-validate.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-form-validation.js') }}"></script>
<!-- Sweet-Alert js -->
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-sweet-alert.js') }}"></script>
@endsection 