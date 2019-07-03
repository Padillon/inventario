
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
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
                        <h4 class="page-title pull-left">Reportes</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="index.html">Home</a></li>
                            <li><span>Registros</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-inner">
        <div class="row">
        <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Registros</h4>
                        <div class="input-group">
                        <form method="post" action="<?php echo base_url(); ?>mantenimiento/Registros/buscar">
                            <div class="col-md-3">
                            <label>Seleccionar:</label>
                                <select id="slSeleccionar" class="form-control">
                                    <option value="1">Proveedores</option>
                                    <option value="2">Clientes</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Valor:</label>
                                <input type="text" class="form-control" id="txtValor">
                            </div>
                            <div class="col-md-3">
                                <br>
                                <button type="submit" id="btnGenerar" class="btn btn-outline-primary mb-3">Generar PDF</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
        </div>
        </div>
        </div>
        <!-- main content area end -->
    <!-- page container area end -->
    <?php
    $this->load->view('layouts/alert');
    ?>

<script src="<?php echo base_url();?>assets/js/adminJS/registros.js"></script>