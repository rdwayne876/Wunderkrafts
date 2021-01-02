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
                <form name="AddAttributeForm" id="AddAttributeForm" class="form-validate"
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
                
                </div>
                <div class="card-footer">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>              
        </div>

        <form name="editAttributeForm" id="editAttributeForm" method="post" action=" {{url('admin/products/attributes/edit/'.$productdata['id'])}} ">@csrf
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Existing Attributes</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle">With DataTables you can alter the ordering characteristics of the table at initialisation time.</h6>
                    <div class="table-responsive">
                        <table id="sections" class="display table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Size</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productdata['attributes'] as $attribute)
                                    <input style="display: none;" type="text" name="attrId[]" value="{{$attribute['id']}}">
                                    <tr>
                                        <td> {{ $attribute['id'] }} </td>
                                        <td> {{ $attribute['size'] }} </td>
                                        <td> {{ $attribute['sku'] }} </td>
                                        <td>
                                            <input type="number" name="price[]" value="{{ $attribute['price'] }}" required="">
                                        </td>
                                        <td>
                                            <input type="number" name="stock[]" value="{{ $attribute['stock'] }}" required="">
                                        </td>
                                        <td>
                                            @if($attribute['status'] == 1)
                                                <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" 
                                                    attribute_id="{{$attribute['id']}}" href="javascript:void(0)">Active</a> 
                                            @else
                                                <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" 
                                                    attribute_id="{{$attribute['id']}}" href="javascript:void(0)">Inactive</a>                                            
                                            @endif 
                                            &nbsp;&nbsp;
                                            <a title="Delete" href="javascript:void(0)" class="btn btn-danger-rgba confirmDelete" record="products/attributes/delete" recordid="{{$attribute['id']}}">
                                                <i class="ri-delete-bin-3-line"></i>
                                            </a>
                                        </td>
                                    </tr>                       
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>  
            </div>
        </form>
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