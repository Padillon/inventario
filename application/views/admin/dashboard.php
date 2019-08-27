
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
                <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img src="<?php echo base_url()?>assets/images/ajuste/<?php echo $this->session->userdata('logo')?>" class="avatar user-thumb" alt="avatar">                         
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"> <?php echo $this->session->userdata("usuario_log")?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo base_url();?>ajustes/ajustes/index">Ajustes</a>
                                <a class="dropdown-item" href="<?php echo base_url();?>Auth/logout">Cerrar Sesion</a>
                              </div>
                        </div>
                </div>
            </div>
        </div>
         <!-- page title area end -->
        <div class="main-content-inner">
                <div class="mt-5 ">     
                    <div class="card">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-3 mt-md-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact sbg1">
                                        <div class="p-4 d-flex ventas justify-content-between align-items-center">
                                            <div class="seofct-icon">
                                                <i class="fa fa-money"></i> Ventas
                                            </div>
                                            <h2><?php echo $ventas->contador; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mt-md-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact sbg1">
                                        <div class="p-4 d-flex compras justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="fa fa-shopping-cart"></i> Compras
                                            </div>
                                            <h2><?php echo $compras->contador; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($this->session->userdata('rol') == 1){ ?>
                                <div class="col-md-3 mt-md-5 mb-3">
                                    <div class="card">
                                        <div class="seo-fact sbg1">
                                            <div class="p-4 d-flex justify-content-between kardex align-items-center">
                                                <div class="seofct-icon"><i class="fa fa-book"></i> Kardex
                                                </div>
                                                <h2><?php echo $kardex->contador; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if($this->session->userdata('rol') == 1){ ?>
                                <div class="col-md-3 mt-md-5 mb-3">
                                    <div class="card">
                                        <div class="seo-fact sbg1">
                                            <div class="p-4 d-flex configuracion justify-content-between conf align-items-center">
                                                <div class="seofct-icon"><i class="fa fa-cog    "></i> Configuración
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php $stock_minimos = 0; $arreglo;                                    
                                foreach( $stock as $sto){
                                    if($sto->actual <= $sto->minimo){
                                        $stock_minimos++;
                                    }
                                } 
                            ?>
                            <div class="col-md-3 mt-md-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact sbg1">
                                        <div class="p-4 d-flex productos justify-content-between conf align-items-center">
                                            <div class="seofct-icon"><i class="fa fa-exclamation"></i> Stock bajo
                                            </div>
                                            <h2><?php echo $stock_minimos; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($this->session->userdata('rol') == 1){ ?>
                                <div class="col-xl-12 col-lg-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4 class="header-title mb-0">Últimos 7 días de venta.</h4>         
                                            </div>
                                            <div id="verview-shart" value=>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }; ?>                           
                        </div>
                    </div>
                    </div>
                </div>   
        </div>  
</div>

    <!-- page container area end -->
    <script src="<?php echo base_url();?>assets/js/adminJS/dashboard.js"></script>
