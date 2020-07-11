@section('title') 
Catalogue
@endsection 
@extends('layouts.admin.main')
@section('style')
<!-- DataTables css -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive Datatable css -->
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Sweet Alert css -->
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection 
@section('rightbar-content')
<!-- Start Contentbar --> 

<!-- Start col -->
<div class="contentbar">                
    <!-- Start row -->
        <!-- Start col -->
        <div class="col-lg-12">

            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    {{ Session::get('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>   
            @endif

            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Products
                        <a href="{{url('admin/products/addedit')}}" style="float: right; display:inline-block" class="btn btn-success"><i class="ri-add-line align-middle mr-2"></i>Add Product</a>
                    </h5>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle">With DataTables you can alter the ordering characteristics of the table at initialisation time.</h6>
                    <div class="table-responsive">
                        <table id="sections" class="display table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Section</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Product Code</th>
                                    <th>color</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td> {{ $product->section->name }} </td>
                                        <td> {{ $product->category->category_name }} </td>
                                        <td>
                                            <?php $product_image_path = "img/product/small/".$product->main_image; ?>
                                            @if(!empty($product->main_image) && file_exists($product_image_path))
                                                <img style="width: 90px;" src=" {{asset('img/product/small/'.$product->main_image)}} " alt="{{$product->name}}" >
                                            @else 
                                                <img style="width: 90px;" src=" {{asset('img/product/small/no_image.png')}} " alt="no image" >
                                            @endif 
                                        </td>        
                                        <td> {{ $product->name }} </td>
                                        <td> {{ $product->code}} </td>
                                        <td> {{ $product->color }} </td>
                                        <td> 
                                            @if ($product->status == 1)
                                                <a class="updateProductStatus" id="product-{{ $product->id }}" 
                                                    product_id="{{$product->id}}" href="javascript:void(0)">Active</a> 
                                            @else
                                                <a class="updateProductStatus" id="product-{{ $product->id }}" 
                                                    product_id="{{$product->id}}" href="javascript:void(0)">Inactive</a>                                            
                                            @endif 
                                        </td>
                                        <td>
                                            <div class="button-list">
                                                <a href="{{url('admin/addEditProduct/'.$product->id)}}" class="btn btn-success-rgba">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-danger-rgba confirmDelete" record="delete" recordid="{{$product->id}}">
                                                    <i class="ri-delete-bin-3-line"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>                       
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
<!-- Datatable js -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-table-datatable.js') }}"></script>
<!-- Sweet-Alert js -->
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-sweet-alert.js') }}"></script>
@endsection 