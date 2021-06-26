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
                
                <form name="productForm" id="productForm" class="form-validate" 
                    @if(empty($productdata['id']))
                        action="{{url('admin/products/addedit')}}"
                    @else 
                        action="{{url('admin/products/addedit/'.$productdata['id'])}}"
                    @endif
                    method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="productName">Product Name<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="productName" name="product_name" placeholder="Enter Product Name" required
                                @if(!empty($productdata['name'])) value="{{$productdata['name']}}" @else value="{{old('product_name')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="material" class="col-lg-3 col-form-label" required>Collection</label>
                            <div class="col-lg-6">
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ( $brands as $brand )
                                        <option value="{{ $brand['id'] }}"
                                            @if( !empty( $productdata['brand_id']) && $productdata['brand_id'] == $brand['id'] )
                                                selected=""
                                            @endif>
                                            {{ $brand['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="category" required>Category<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="category_id" name="category_id">
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
                            <label class="col-lg-3 col-form-label" for="productCode">Product Code<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="productCode" name="product_code" placeholder="Enter Product Code" required
                                @if(!empty($productdata['code'])) value="{{$productdata['code']}}" @else value="{{old('product_code')}}" @endif>
                            </div>
                        </div>

                        <!--
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="productColour">Product Colour<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="productColour" name="product_colour" placeholder="Product Colour" required
                                @if(!empty($productdata['color'])) value="{{$productdata['color']}}" @else value="{{old('product_colour')}}" @endif>
                            </div>
                        </div>
                        -->
                        <!--
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="productSize">Size<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="productSize" name="product_size" placeholder="Product Size" required
                                @if(!empty($productdata['size'])) value="{{$productdata['size']}}" @else value="{{old('product_size')}}" @endif>
                            </div>
                        </div>
                        -->

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="price">Price<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="price" name="product_price" placeholder="Enter Price" required
                                @if(!empty($productdata['price'])) value="{{$productdata['price']}}" @else value="{{old('product_price')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="productDiscount">Discount (%)<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="productDiscount" name="product_discount" placeholder="Product Discount"
                                @if(!empty($productdata['discount'])) value="{{$productdata['discount']}}" @else value="{{old('product_discount')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="productMainImage">Product Main Image</label>
                            <div class="input-group col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="productMainImage" name="main_image">
                                    <label class="custom-file-label" for="productMainImage" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                                </div>
                            </div>
                            @if(!empty($productdata['main_image']))
                                <div class="col-md-6 offset-md-3">
                                    <img src=" {{asset('img/product/medium/'.$productdata['main_image'])}} " width="100px">
                                    <a href="javascript:void(0)" class="confirmDelete" record="products/delete/image" recordid="{{$productdata['id']}}" <?php /* href="{{url('admin/deleteImage/'.$productdata['id'])}} " */ ?>><button type="button" class="btn btn-danger-rgba"><i class="feather icon-trash-2 mr-2"></i> Delete</button></a> 
                                </div>
                            @endif
                        </div> 

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="productVideo">Product Video</label>
                            <div class="input-group col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="productVideo" name="product_video">
                                    <label class="custom-file-label" for="productVideo" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                                </div>
                            </div>
                            @if(!empty($productdata['video']))
                                <div class="col-md-6 offset-md-3">
                                    <a href="{{url('vid/product/'.$productdata['video'])}}">Download</a>
                                    <a href="javascript:void(0)" class="confirmDelete" record="products/delete/video" recordid="{{$productdata['id']}}" <?php /* href="{{url('admin/deleteImage/'.$productdata['id'])}} " */ ?>><button type="button" class="btn btn-danger-rgba"><i class="feather icon-trash-2 mr-2"></i> Delete</button></a> 
                                </div>
                            @endif
                        </div> 

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="productDescription">Product Description <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="productDescription" name="description" rows="5" placeholder="Enter Description." required>@if(!empty($productdata['description'])){{$productdata['description']}}@else{{old('description')}}@endif</textarea>
                            </div>
                        </div>

                        <!-- Passing filter -->
                        <div class="form-group row">
                            <label for="material" class="col-lg-3 col-form-label">Material</label>
                            <div class="col-lg-6">
                                <select name="material" id="material" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ( $materialArray as $material )
                                        <option value="{{$material}}">{{ $material }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gemstone" class="col-lg-3 col-form-label">Gemstone</label>
                            <div class="col-lg-6">
                                <select name="gemstone" id="gemstone" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ( $gemstoneArray as $gemstone )
                                        <option value="{{$gemstone}}">{{ $gemstone }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bundle" class="col-lg-3 col-form-label">Set</label>
                            <div class="col-lg-6">
                                <select name="bundle" id="bundle" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ( $bundleArray as $bundle )
                                        <option value="{{$bundle}}">{{ $bundle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="metaTitle">Meta Title</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="metaTitle" name="meta_title" placeholder="Enter Meta Title"
                                @if(!empty($productdata['meta_title'])) value="{{$productdata['meta_title']}}" @else value="{{old('meta_title')}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="metaDescription">Meta Description</label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="metaDescription" name="meta_description" rows="5" placeholder="Enter Meta Description.">@if(!empty($productdata['meta_description'])){{$productdata['meta_description']}}@else{{old('meta_description')}}@endif</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="metaKeywords">Meta Keywords</label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="metaKeywords" name="meta_keywords" rows="5" placeholder="Enter Meta Keywords.">@if(!empty($productdata['meta_keywords'])){{$productdata['meta_keywords']}}@else{{old('meta_keywords')}}@endif</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="isFeatured">Featured</label>
                            <div class="col-lg-6">
                                <input type="checkbox" name="isFeatured" id="isFeatured" value="Yes"
                                @if( !empty( $productdata['featured']) && $productdata['featured'] == 
                                "Yes")
                                    checked=""
                                @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="productStatus">Active or Inactive<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="productStatus" name="status">
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