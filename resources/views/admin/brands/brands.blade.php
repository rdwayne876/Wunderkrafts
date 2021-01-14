@section('title') 
Catalogue
@endsection 
@extends('layouts.admin.main')
@section('style')
<!-- DataTables css -->
<link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive Datatable css -->
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Sweet Alert css -->
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection 
@section('rightbar-content')
<!-- Start Contentbar -->    
<div class="contentbar">                
    <!-- Start row -->
    <div class="row">
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
                    <h5 class="card-title">Collections
                        <a href="{{url('admin/brands/addEditBrand')}}" style="float: right; display:inline-block" class="btn btn-success"><i class="ri-add-line align-middle mr-2"></i>Add Brand</a>
                    </h5>
                </div>

                <div class="card-body">
                    <h6 class="card-subtitle">With DataTables you can alter the ordering characteristics of the table at initialisation time.</h6>
                    <div class="table-responsive">
                        <table id="brands" class="display table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td> {{ $brand-> id }} </td>
                                        <td> {{ $brand-> name }} </td>
                                        <td> 
                                            <div class="button-list">
                                                <a title="Edit Brand" href="{{url('admin/brands/addEditBrand/'.$brand->id)}}" class="btn btn-primary-rgba">
                                                    <i class="ri-edit-box-line"></i>
                                                </a>
                                                <a title="Delete" href="javascript:void(0)" class="btn btn-danger-rgba confirmDelete" record="brands/delete" recordid="{{$brand->id}}">
                                                    <i class="ri-delete-bin-3-line"></i>
                                                </a>

                                                @if ($brand->status == 1)
                                                    <a class="updateBrandStatus" id="brand-{{ $brand->id }}" 
                                                        brand_id="{{$brand->id}}" href="javascript:void(0)"><i class="la la-toggle-on" aria-hidden="true" status="Active"></i></a> 
                                                @else
                                                    <a class="updateBrandStatus" id="brand-{{ $brand->id }}" 
                                                        brand_id="{{$brand->id}}" href="javascript:void(0)"><i class="la la-toggle-off" aria-hidden="true" status="Inactive"></i></a>                                            
                                                @endif 
                                            </div>  
                                        </td>
                                    </tr>                       
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
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
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/custom-table-datatable.js') }}"></script>
<!-- Sweet-Alert js -->
<script src="{{ asset('assets/admin/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/custom-sweet-alert.js') }}"></script>
@endsection 