@section('title') 
{{$title}}
@endsection 
@extends('layouts.admin.main')
@section('style')

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
                    <h6 class="card-subtitle">Add new Category</h6>
                    <form class="form-validate" action="#" method="post">

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="categoryName">Category Name<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="categoryName" name="category_name" placeholder="Enter Category Name">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="section">Section<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="section" name="section_id">
                                    <option value="">Please select</option>
                                    @foreach ($getSections as $section)
                                        <option value=" {{$section->name}} ">{{$section->name}}</option>   
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="categoryLevel">Select Catgeory Level<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="categoryLevel" name="parent_id">
                                    <option value="0">Main Category</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="categoryImage">Category Image<span class="text-danger">*</span></label>
                            <div class="input-group col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="categoryImage" name="category_image">
                                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="catgeoryDiscount">Category Discount<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="categoryDiscount" name="category_discount" placeholder="Enter Category Discount">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="categoryDescription">Category Description <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="categoryDescription" name="description" rows="5" placeholder="Enter Description."></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="categoryURL">Category URL<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="categoryURL" name="url" placeholder="Enter Category URL">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="metaTitle">Meta Title<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="metaTitle" name="meta_title" placeholder="Enter Meta Title">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="metaDescription">Meta Description<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="metaDescription" name="meta_description" rows="5" placeholder="Enter Meta Description."></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="metaKeywords">Meta Keywords<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="metaKeywords" name="meta_keywords" rows="5" placeholder="Enter Meta Keywords."></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="categoryStatus">Active or Inactive<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="categoryStatus" name="status">
                                    <option value="0">Active</option>
                                    <option value="1">Inactive</option>
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
@endsection 