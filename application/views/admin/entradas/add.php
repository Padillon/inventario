
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

            <div class="main-content-inner">
                            <div class="row">
                                <!-- busqueda de producto -->
                                <div class="col-12 mt-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-control" action="<?php echo base_url();?>movimientos/entradas/store" id="FormCompra" method='post'  >
                                                <div class='input-group'>
                                                    <div class='col-md-3'>
                                                    <label>Fecha:</label>
                                                    <input name='fecha' id="fecha" type="text" value="<?php echo date('Y-m-d');?>" class='form-control datepicker' >

                                                </div>
                                                <div class='col-md-9'>
                                                    <label>Proveedor: </label>
                                                    <input name='valorProveedor' required id='autocompleteProveedor' require type='text' class='form-control' >
                                                    <input type="hidden" id="idProveedor" name="idProveedor" >
                                                    <input  step='0.01' type="hidden" pattern='^\d*(\.\d{0,2})?$' id="total" name="total" value="0">
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
                                                    
                                                    <table id="tbCompras" class=" tabla-contenido table table-bordered table-striped table-hover table-responsive" style="width:100%">
                                                        <thead>
                                                            <tr class=>
                                                                <th  WIDTH="15%">Codigo</th>
                                                                <th  WIDTH="15%">Nombre</th>
                                                                <th  WIDTH="15%">Precio Entrada</th>
                                                                <th  WIDTH="15%">Precio Salida</th>
                                                                <th  WIDTH="15%">Cantidad</th>
                                                                <th  WIDTH="15%">Importes</th>
                                                                <th  WIDTH="15%">Fecha de caducidad</th>
                                                                <th  WIDTH="15%">Opciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>                               
                                                        </tbody>
                                                    </table>
                                                </div> 
                                                <div class="col-md-5">
                                                <table id="tbTotal" class="table table-striped  table-responsive table-bordered">
                                                    <tr>
                                                    <td class="alert alert-success">TOTAL:</td>
                                                    <td id="total_sub" class="alert alert-success">$</td>
                                                    </tr>
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
                        <!-- <div class="col-3 mt-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-control">
                                                <table id="tbTotal" class="table table-striped  table-responsive table-bordered">
                                                    <tr>
                                                    <td class="alert alert-success">TOTAL:</td>
                                                    <td id="total_sub" class="alert alert-success">$</td>
                                                    </tr>
                                                </table>
                                            </div>                               
                                        </div>
                                    </div>
                            </div>-->
                </div>
            </div>
</div>


<script src="<?php echo base_url();?>assets/js/adminJS/entradas.js"></script>