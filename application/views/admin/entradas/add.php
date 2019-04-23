
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
                                <h4 class="page-title pull-left">Agregar Entrada</h4>
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
                        <div class="col-9 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <form class="form-control">
                                        <div class='input-group'>
                                            <div class='col-md-3'>
                                            <label>Fecha:</label>
                                            <input name='nombre' type="date" value="<?php echo date("Y-m-d");?>" class='form-control' >
                                        </div>
                                        <div class='col-md-9'>
                                            <label>Proveedor: </label>
                                            <input name='valorProveedor' id='autocompleteProveedor' type='text' class='form-control' >
                                            <input type="hidden" id="idProveedor" name="idProveedor" value="0">
                                        </div>                        
                                        <br>
                                        <div class="col-md-12">
                                            <label class="col-form-control">Buscar Producto:</label>
                                            <div class="input-group">
                                                <input name="autocompleteProducto" class="form-control" type="text" id="autocompleteProducto">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-primary" id="btn-agregar-abast" type="button">Agregar</button>
                                                </div>
                                            </div>                           
                                            <br>
                                            <table id="tbCompras" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Codigo</th>
                                                        <th>Nombre</th>
                                                        <th>Precio Entrada</th>
                                                        <th>Precio Salida</th>
                                                        <th>Cantidad</th>
                                                        <th>Importes</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>                               
                                                </tbody>
                                            </table>
                                        </div>             

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-outline-primary mb-3">Procesar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-control">
                                        <table id="tbTotal" class="table">
                                            <tr>
                                             <td>SUBTOTAL:</td>
                                             <td>$</td>
                                             </tr>
                                             <tr>
                                             <td>IVA:</td>
                                             <td>$</td>
                                             </tr>
                                             <tr>
                                             <td>CESC:</td>
                                             <td>$</td>
                                             </tr>
                                             <tr>
                                             <td class="alert alert-success">TOTAL:</td>
                                             <td class="alert alert-success">$</td>
                                             </tr>
                                        </table>
                                    </div>                               
                                </div>
                            </div>
                    </div>
    </div>
</div>


<script src="<?php echo base_url();?>assets/js/adminJS/entradas.js"></script>