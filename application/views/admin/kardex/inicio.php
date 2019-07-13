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
                                    <form class="form-control" action="<?php echo base_url();?>movimientos/entradas/store" id="FormCompra" method='post'  >
                                    <a href  calss="btn btn-outline-primary mb-3 movimiento" data-toggle="modal" data-target="#movimiento" class="btn btn-outline-primary mb-3" onclick="movimientoModal()">Movimiento +</a>
                                    <div class="col-md-12">                
                                            <br>
                                            <table id="tabla_kardex"class="table table-bordered table-striped table-hover table-responsive" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Fecha</th>
                                                        <th>Movimiento</th>
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
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
</div>
