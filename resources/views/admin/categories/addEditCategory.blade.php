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
                            <label class="col-lg-3 col-form-label" for="val-categoryName">Category Name<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="val-categoryName" name="val-categoryName" placeholder="Enter Category Name">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-section">Section <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="val-section" name="section_id">
                                    <option value="">Please select</option>
                                    @foreach ($getSections as $section)
                                        <option value=" {{$section->name}} ">{{$section->name}}</option>   
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-section">Select Catgeory Level<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="val-categgoryLevel" name="parent_id">
                                    <option value="0">Main Category</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-section">Category Image<span class="text-danger">*</span></label>
                            <div class="input-group col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile02">
                                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-categoryName">Category Discount<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="category_discount" name="val-categoryName" placeholder="Enter Category Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-categoryName">Category URL<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="val-categoryName" name="val-categoryName" placeholder="Enter Category Name">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-email">Email <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="val-email" name="val-email" placeholder="Enter Email ID">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-password">Password <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="val-password" name="val-password" placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-confirm-password">Re-Type Password <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="val-confirm-password" name="val-confirm-password" placeholder="Enter again passward for confirm">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-suggestions">Description <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="val-suggestions" name="val-suggestions" rows="5" placeholder="Enter Your Details."></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-skill">Skill <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="val-skill" name="val-skill">
                                    <option value="">Please select</option>
                                    <option value="web-development">Web Development</option>
                                    <option value="web-designing">Web Designing</option>
                                    <option value="ui-designing">UI Designing</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="testing">Testing</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-currency">Currency <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="val-currency" name="val-currency" placeholder="$45.75">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-website">Website <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="val-website" name="val-website" placeholder="http://demo.com">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-phoneus">Phone <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="val-phoneus" name="val-phoneus" placeholder="999-888-0000">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-digits">Digits <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="val-digits" name="val-digits" placeholder="9">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-number">Number <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="val-number" name="val-number" placeholder="9.1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="val-range">Range [1, 5] <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="val-range" name="val-range" placeholder="3">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Terms &amp; Conditions <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <label class="css-control css-control-primary css-checkbox" for="val-terms">
                                    <input type="checkbox" class="css-control-input" id="val-terms" name="val-terms" value="1">
                                    <span class="css-control-indicator"></span> I agree to the terms & conditions of Minaati
                                </label>
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