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
                            <h4 class="page-title pull-left">Kardex.</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Movimientos</span></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
</div>
<div class="main-content-inner">
                    <div class="row">
                        <!-- busqueda de producto -->
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                        <div class='input-group'> 
                                            <div class='col-md-3'>
                                                <label>Del:</label>
                                                <input name='fecha_inicio' id='fecha_inicio' type="date" value="<?php echo date("Y-m-d");?>" class='form-control' >
                                            </div>
                                            <div class='col-md-3'>
                                                <label>Al:</label>
                                                <input name='fecha_fin' id='fecha_fin' type="date" value="<?php echo date("Y-m-d");?>" class='form-control' >
                                            </div>
                                            <div class='col-md-6'>
                                                <label class="col-form-control">Buscar Producto:</label>
                                                <input name="autocompleteProducto" class="form-control" type="text" id="autocompleteProducto">
                                            </div>           
                                        </div>                       
                                        <br>
                                        <div class="col-md-12">                
                                            <br>
                                            <table id="tabla_kardex"class="table table-bordered table-striped table-hover table-responsive" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Tipo</th>
                                                        <th>Descripción</th>
                                                        <th>Producto</th>
                                                        <th>Cantidad</th>
                                                        <th>Saldo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                                               
                                                </tbody>
                                            </table>
                                        </div>             

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="button" onclick="validarFormulario()" id="procesar" class="btn btn-outline-primary mb-3">Procesar</button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/adminJS/kardex.js"></script>
