@section('title') 
eCommerce
@endsection 
@extends('layouts.admin.main')
@section('style')
<!-- Apex css -->
<link href="{{ asset('assets/admin/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet" type="text/css" />
<!-- Slick css -->
<link href="{{ asset('assets/admin/plugins/slick/slick.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/slick/slick-theme.css') }}" rel="stylesheet" type="text/css" />
@endsection 
@section('rightbar-content')
<!-- Start Contentbar -->    
<div class="contentbar">
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 col-xl-8">
            <div class="card m-b-30">
                <div class="card-header">                                
                    <div class="row align-items-center">
                        <div class="col-6 col-lg-9">
                            <h5 class="card-title mb-0">Monthly Sales Report</h5>
                        </div>
                        <div class="col-6 col-lg-3">
                            <select class="form-control font-12">
                                <option value="class1" selected>Jan 20</option>
                                <option value="class2">Feb 20</option>
                                <option value="class3">Mar 20</option>
                                <option value="class4">Apr 20</option>
                                <option value="class5">May 20</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0 pl-0">
                    <div id="apex-area-chart"></div>
                </div>
            </div>
        </div>
        <!-- End col -->
        <!-- Start col -->
        <div class="col-lg-12 col-xl-4">
            <div class="card text-center m-b-30">
                <div class="card-header">                                
                    <h5 class="card-title mb-0">Sales by Category</h5>
                </div>
                <div class="card-body px-0">
                    <div id="apex-pie-chart"></div>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 col-xl-8">
            <div class="card m-b-30">
                <div class="card-header">                                
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h5 class="card-title mb-0">Recent Orders</h5>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-light text-muted btn-sm float-right font-12">View</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                       <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Zebronics Mouse</td>
                                    <td>Black Smith</td>
                                    <td>EL265</td>
                                    <td>$49</td>
                                    <td><span class="badge badge-primary">Pending</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Amritam Face Mask</td>
                                    <td>Reva John</td>
                                    <td>HL986</td>
                                    <td>$21</td>
                                    <td><span class="badge badge-success">Shipped</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Papimo Diapers</td>
                                    <td>Nora Fox</td>
                                    <td>PL256</td>
                                    <td>$39</td>
                                    <td><span class="badge badge-warning">Awaiting</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Night in the Forest</td>
                                    <td>Courtney Pitt</td>
                                    <td>CL480</td>
                                    <td>$15</td>
                                    <td><span class="badge badge-light">Cancelled</span></td>
                                </tr>
                            </tbody>
                       </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
        <!-- Start col -->
        <div class="col-lg-12 col-xl-4">
            <!-- Start row -->
            <div class="row">
                <!-- Start col -->
                <div class="col-lg-12 col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-header">                                
                            <h5 class="card-title mb-0">Orders by Country</h5>
                        </div>
                        <div class="card-body">
                            <div class="orders-country-slider">
                                <div class="orders-country-item">
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="mt-0 mb-1">$2,59,875</h4>
                                            <p class="mb-0">1,298 Orders</p>
                                        </div>
                                        <i class="flag flag-icon-au flag-icon-squared ml-3"></i>
                                    </div>
                                </div>
                                <div class="orders-country-item">
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="mt-0 mb-1">$2,59,875</h4>
                                            <p class="mb-0">1,298 Orders</p>
                                        </div>
                                        <i class="flag flag-icon-us flag-icon-squared ml-3"></i>
                                    </div>
                                </div>
                                <div class="orders-country-item">
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="mt-0 mb-1">$2,59,875</h4>
                                            <p class="mb-0">1,298 Orders</p>
                                        </div>
                                        <i class="flag flag-icon-de flag-icon-squared ml-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
                <!-- Start col -->
                <div class="col-lg-12 col-xl-12">
                    <div class="card bg-secondary-rgba m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h5 class="card-title font-16 mb-5">Download New Orders</h5>
                                    <p class="mb-0 text-primary font-30"><a href="#"><i class="ri-file-download-line"></i></a></p>
                                </div>
                                <div class="col-4 text-right">
                                    <img src="assets/images/general/order-download.svg" class="img-fluid" alt="order-download">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
            </div>
            <!-- End row -->
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 col-xl-6">
            <div class="card m-b-30">
                <div class="card-header">                                
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h5 class="card-title mb-0">Revenue</h5>
                        </div>
                        <div class="col-3">
                            <div class="dropdown">
                                <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetRevenue" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetRevenue">
                                    <a class="dropdown-item font-13" href="#">Refresh</a>
                                    <a class="dropdown-item font-13" href="#">Export</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0 pl-0">
                    <div id="apex-bar-chart"></div>
                </div>
            </div>
        </div>
        <!-- End col -->
        <!-- Start col -->
        <div class="col-lg-12 col-xl-6">
            <div class="card m-b-30">
                <div class="card-body text-center">
                    <h4>$5985</h4>
                    <p class="card-text">Profit Earned - Feb 20</p>
                    <div id="apex-line-chart"></div>
                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col-6 border-right">
                            <p class="my-2">Last Month : $9875</p>
                        </div>
                        <div class="col-6">
                            <p class="my-2"><a href="#"><i class="ri-download-line align-middle mr-2"></i>Download Report</a></p>
                        </div>
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
<!-- Apex js -->
<script src="{{ asset('assets/admin/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/apexcharts/irregular-data-series.js') }}"></script>
<!-- Slick js -->
<script src="{{ asset('assets/admin/plugins/slick/slick.min.js') }}"></script>
<!-- Dashboard js -->
<script src="{{ asset('assets/admin/js/custom/custom-dashboard-ecommerce.js') }}"></script>
@endsection 