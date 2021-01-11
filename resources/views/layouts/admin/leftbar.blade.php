<div class="leftbar">
    <!-- Start Sidebar -->
    <div class="sidebar">
        <!-- Start Logobar -->
        <div class="logobar">
            <a href="{{url('/')}}" class="logo logo-large"><img src="{{asset('img/logo.png')}}" class="img-fluid" alt="logo"></a>
        </div>
        <!-- End Logobar -->
        <!-- Start Navigationbar -->
        <div class="navigationbar">
            <ul class="vertical-menu">
                <!-- <li>
                    <a href="{{url('/')}}">
                        <i class="ri-user-6-fill"></i><span>CRM</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/dashboard')}}">
                        <i class="ri-store-2-fill"></i><span>Dashboard</span>
                    </a>
                </li>
                <li class="vertical-header"></li> -->

                <li>
                    <a href="javaScript:void();">
                        <i class="ri-settings-5-line"></i><span>Settings</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{url('admin/settings')}}">Update Password</a></li>
                        <li><a href="{{url('admin/updateInfo')}}">Personal Information</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-pencil-ruler-2-line"></i><span>Catalogue</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{url('admin/sections')}}">Sections</a></li>
                        <li><a href="{{url('admin/brands')}}">Brands</a></li>
                        <li><a href="{{url('admin/categories')}}">Categories</a></li>
                        <li><a href="{{url('admin/products')}}">Products</a></li>
                    </ul>
                </li>
                
                <!--
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-pencil-ruler-line"></i><span>Basic UI</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{url('/basic-ui-kits-alerts')}}">Alerts</a></li>
                        <li><a href="{{url('/basic-ui-kits-badges')}}">Badges</a></li>
                        <li><a href="{{url('/basic-ui-kits-buttons')}}">Buttons</a></li>
                        <li><a href="{{url('/basic-ui-kits-cards')}}">Cards</a></li>
                        <li><a href="{{url('/basic-ui-kits-carousel')}}">Carousel</a></li>
                        <li><a href="{{url('/basic-ui-kits-collapse')}}">Collapse</a></li>
                        <li><a href="{{url('/basic-ui-kits-dropdowns')}}">Dropdowns</a></li>
                        <li><a href="{{url('/basic-ui-kits-embeds')}}">Embeds</a></li>
                        <li><a href="{{url('/basic-ui-kits-grids')}}">Grids</a></li>
                        <li><a href="{{url('/basic-ui-kits-images')}}">Images</a></li>
                        <li><a href="{{url('/basic-ui-kits-media')}}">Media</a></li>
                        <li><a href="{{url('/basic-ui-kits-modals')}}">Modals</a></li>
                        <li><a href="{{url('/basic-ui-kits-paginations')}}">Paginations</a></li>
                        <li><a href="{{url('/basic-ui-kits-popovers')}}">Popovers</a></li>
                        <li><a href="{{url('/basic-ui-kits-progressbars')}}">Progress Bars</a></li>
                        <li><a href="{{url('/basic-ui-kits-spinners')}}">Spinners</a></li>
                        <li><a href="{{url('/basic-ui-kits-tabs')}}">Tabs</a></li>   
                        <li><a href="{{url('/basic-ui-kits-toasts')}}">Toasts</a></li>     
                        <li><a href="{{url('/basic-ui-kits-tooltips')}}">Tooltips</a></li>
                        <li><a href="{{url('/basic-ui-kits-typography')}}">Typography</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-pencil-ruler-2-line"></i><span>Advanced UI</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">                                
                        <li><a href="{{url('/advanced-ui-kits-image-crop')}}">Image Crop</a></li>  
                        <li><a href="{{url('/advanced-ui-kits-jquery-confirm')}}">jQuery Confirm</a></li>
                        <li><a href="{{url('/advanced-ui-kits-nestable')}}">Nestable</a></li>
                        <li><a href="{{url('/advanced-ui-kits-pnotify')}}">Pnotify</a></li>
                        <li><a href="{{url('/advanced-ui-kits-range-slider')}}">Range Slider</a></li>
                        <li><a href="{{url('/advanced-ui-kits-ratings')}}">Ratings</a></li>
                        <li><a href="{{url('/advanced-ui-kits-session-timeout')}}">Session Timeout</a></li>
                        <li><a href="{{url('/advanced-ui-kits-sweet-alerts')}}">Sweet Alerts</a></li>
                        <li><a href="{{url('/advanced-ui-kits-switchery')}}">Switchery</a></li>
                        <li><a href="{{url('/advanced-ui-kits-toolbar')}}">Toolbar</a></li>
                        <li><a href="{{url('/advanced-ui-kits-tour')}}">Tour</a></li>
                        <li><a href="{{url('/advanced-ui-kits-treeview')}}">Tree View</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();">
                      <i class="ri-apps-line"></i><span>Apps</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{url('/apps-calender')}}">Calender</a></li>
                        <li><a href="{{url('/apps-chat')}}">Chat</a></li> 
                        <li>
                            <a href="javaScript:void();">Email<i class="ri-arrow-right-s-line"></i></a>
                            <ul class="vertical-submenu">
                                <li><a href="{{url('/apps-email-inbox')}}">Inbox</a></li>
                                <li><a href="{{url('/apps-email-open')}}">Open</a></li>
                                <li><a href="{{url('/apps-email-compose')}}">Compose</a></li>
                            </ul>
                        </li>
                        <li><a href="{{url('/apps-kanban-board')}}">Kanban Board</a></li>
                        <li><a href="{{url('/apps-onboarding-screens')}}">Onboarding Screens</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-file-copy-2-line"></i><span>Forms</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{url('/form-inputs')}}">Basic Elements</a></li>
                        <li><a href="{{url('/form-groups')}}">Groups</a></li>
                        <li><a href="{{url('/form-layouts')}}">Layouts</a></li>
                        <li><a href="{{url('/form-colorpickers')}}">Color Pickers</a></li>
                        <li><a href="{{url('/form-datepickers')}}">Date Pickers</a></li>
                        <li><a href="{{url('/form-editors')}}">Editors</a></li>
                        <li><a href="{{url('/form-file-uploads')}}">File Uploads</a></li>
                        <li><a href="{{url('/form-input-mask')}}">Input Mask</a></li>
                        <li><a href="{{url('/form-maxlength')}}">MaxLength</a></li>
                        <li><a href="{{url('/form-selects')}}">Selects</a></li>
                        <li><a href="{{url('/form-touchspin')}}">Touchspin</a></li>
                        <li><a href="{{url('/form-validations')}}">Validations</a></li>
                        <li><a href="{{url('/form-wizards')}}">Wizards</a></li>
                        <li><a href="{{url('/form-xeditable')}}">X-editable</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-pie-chart-line"></i><span>Charts</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{url('/chart-apex')}}">Apex</a></li>
                        <li><a href="{{url('/chart-c3')}}">C3</a></li>
                        <li><a href="{{url('/chart-chartistjs')}}">Chartist</a></li> 
                        <li><a href="{{url('/chart-chartjs')}}">Chartjs</a></li>
                        <li><a href="{{url('/chart-flot')}}">Flot</a></li>
                        <li><a href="{{url('/chart-knob')}}">Knob</a></li>
                        <li><a href="{{url('/chart-morris')}}">Morris</a></li>
                        <li><a href="{{url('/chart-piety')}}">Piety</a></li>
                        <li><a href="{{url('/chart-sparkline')}}">Sparkline</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-service-line"></i><span>Icons</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{url('/icon-svg')}}">SVG</a></li>
                        <li><a href="{{url('/icon-dripicons')}}">Dripicons</a></li>
                        <li><a href="{{url('/icon-feather')}}">Feather</a></li>
                        <li><a href="{{url('/icon-flag')}}">Flag</a></li>  
                        <li><a href="{{url('/icon-font-awesome')}}">Font Awesome</a></li>
                        <li><a href="{{url('/icon-ionicons')}}">Ion</a></li>
                        <li><a href="{{url('/icon-line-awesome')}}">Line Awesome</a></li>
                        <li><a href="{{url('/icon-material-design')}}">Material Design</a></li>
                        <li><a href="{{url('/icon-remixicon')}}">Remixicon</a></li>
                        <li><a href="{{url('/icon-simple-line')}}">Simple Line</a></li>
                        <li><a href="{{url('/icon-socicon')}}">Socicon</a></li>
                        <li><a href="{{url('/icon-themify')}}">Themify</a></li>
                        <li><a href="{{url('/icon-typicons')}}">Typicons</a></li> 
                    </ul>
                </li>                        
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-table-line"></i><span>Tables</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{url('/table-bootstrap')}}">Bootstrap</a></li>
                        <li><a href="{{url('/table-datatable')}}">Datatable</a></li>
                        <li><a href="{{url('/table-editable')}}">Editable</a></li>
                        <li><a href="{{url('/table-footable')}}">Foo</a></li>
                        <li><a href="{{url('/table-rwdtable')}}">RWD</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-map-pin-line"></i><span>Maps</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{url('/map-google')}}">Google</a></li>
                        <li><a href="{{url('/map-vector')}}">Vector</a></li>
                    </ul>
                </li>                                              
                <li>
                    <a href="javaScript:void();">
                      <i class="ri-pages-line"></i><span>Pages</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="javaScript:void();">Basic<i class="ri-arrow-right-s-line"></i></a>
                            <ul class="vertical-submenu">
                                <li><a href="{{url('/page-starter')}}">Starter</a></li>
                                <li><a href="{{url('/page-blog')}}">Blog</a></li>
                                <li><a href="{{url('/page-faq')}}">FAQ</a></li>
                                <li><a href="{{url('/page-gallery')}}">Gallery</a></li>
                                <li><a href="{{url('/page-invoice')}}">Invoice</a></li>
                                <li><a href="{{url('/page-pricing')}}">Pricing</a></li>
                                <li><a href="{{url('/page-timeline')}}">Timeline</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();">Store<i class="ri-arrow-right-s-line"></i></a>
                            <ul class="vertical-submenu">
                                <li><a href="{{url('/ecommerce-product-list')}}">Product List</a></li>
                                <li><a href="{{url('/ecommerce-product-detail')}}">Product Detail</a></li>
                                <li><a href="{{url('/ecommerce-order-list')}}">Order List</a></li>
                                <li><a href="{{url('/ecommerce-order-detail')}}">Order Detail</a></li> 
                                <li><a href="{{url('/ecommerce-shop')}}">Shop</a></li>
                                <li><a href="{{url('/ecommerce-single-product')}}">Single Product</a></li>
                                <li><a href="{{url('/ecommerce-cart')}}">Cart</a></li>
                                <li><a href="{{url('/ecommerce-checkout')}}">Checkout</a></li>
                                <li><a href="{{url('/ecommerce-thankyou')}}">Thank You</a></li>
                                <li><a href="{{url('/ecommerce-myaccount')}}">My Account</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();">Authentication<i class="ri-arrow-right-s-line"></i></a>
                            <ul class="vertical-submenu">
                                <li><a href="{{url('/user-login')}}">Login</a></li>
                                <li><a href="{{url('/user-register')}}">Register</a></li>
                                <li><a href="{{url('/user-forgotpsw')}}">Forgot Password</a></li>
                                <li><a href="{{url('/user-lock-screen')}}">Lock Screen</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();">Error<i class="ri-arrow-right-s-line"></i></a>
                            <ul class="vertical-submenu">
                                <li><a href="{{url('/error-comingsoon')}}">Coming Soon</a></li>  
                                <li><a href="{{url('/error-maintenance')}}">Maintenance</a></li>
                                <li><a href="{{url('/error-404')}}">Error 404</a></li>
                                <li><a href="{{url('/error-500')}}">Error 500</a></li>
                            </ul>
                        </li>
                    </ul> 
                </li>   
                <li>
                    <a href="{{url('/widgets')}}">
                        <i class="ri-palette-line"></i><span>Widgets</span><span class="new-icon"></span>
                    </a>
                </li>  
                
                -->
            </ul>
        </div>
        <!-- End Navigationbar -->
    </div>
    <!-- End Sidebar -->
</div>