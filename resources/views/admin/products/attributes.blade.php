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
                    <h6 class="card-subtitle">{{$productdata['name']}} Attributes</h6>

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
                <form name="attributesForm" id="attributesForm" class="form-validate"
                        method="post" action={{ url('admin/products/attributes/'.$productdata['id'])}}>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
 
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="productName">Product Name:</label>&nbsp;{{$productdata['name']}}
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="productCode">Product Code:</label>&nbsp;{{$productdata['code']}}
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="productColour">Product Colour:</label>&nbsp;{{$productdata['color']}}
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group row">
                                @if(!empty($productdata['main_image']))
                                    <div class="col-md-6 offset-md-3">
                                        <img src=" {{asset('img/product/medium/'.$productdata['main_image'])}} " width="100px">
                                    </div>
                                @endif
                            </div> 
                        </div>           
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="field_wrapper">
                                <div>
                                    <input id="size" type="text" name="size[]" value="" required="" placeholder="Size"/>
                                    <input id="sku" type="text" name="sku[]" value="" required="" placeholder="SKU"/>
                                    <input id="price" type="number" name="price[]" value="" required="" placeholder="Price"/>
                                    <input id="stock" type="number" name="stock[]" value="" required="" placeholder="Stock"/>
                                    <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>                                
                </form>
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