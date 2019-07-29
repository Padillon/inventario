
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
   
       <!-- main content area start -->
    <div class="main-content">
        <div class="header-area">
             <!-- page title area start -->
             <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>pricing</span></li>
                            </ul>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            <!-- page title area end -->
             <div class="main-content-inner">
                <div class="row">
                    <!-- seo fact area start -->
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-3 mt-md-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact sbg1">
                                        <div class="p-4 d-flex ventas justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="fa fa-money"></i> Ventas</div>
                                            <h2><?php echo $ventas->contador; ?></h2>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mt-md-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact sbg1">
                                        <div class="p-4 d-flex compras justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="fa fa-shopping-cart"></i> Compras</div>
                                            <h2><?php echo $compras->contador; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mt-md-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact sbg1">
                                        <div class="p-4 d-flex justify-content-between usuario align-items-center">
                                            <div class="seofct-icon"><i class="fa fa-book"></i> Kardex</div>
                                            <h2>3,984</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mt-md-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact sbg1">
                                        <div class="p-4 d-flex justify-content-between conf align-items-center">
                                            <div class="seofct-icon"><i class="fa fa-cog    "></i> Configuración</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                     <h4 class="header-title mb-0">Últimos 7 días de venta.</h4>
                                  
                                </div>
                                <div id="verview-shart" value=></div>
                            </div>
                        </div>
                    </div>

                                 <!-- overview area start -->                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
     </div>

    
    <!-- page container area end -->
    <script src="<?php echo base_url();?>assets/js/adminJS/dashboard.js">