
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Agregar Venta</h4>
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
                                    <form class="form-control" action="<?php echo base_url();?>movimientos/salidas/store" id="FormSalida" method='POST'  >
                                        <div class='input-group'>
                                            <div class='col-md-3'>
                                            <label>Fecha:</label>
                                            <input name='fecha' id='fecha' type="text" value="<?php echo date("Y-m-d");?>" class='form-control' >
                                        </div>
                                        <div class='col-md-9'>
                                        <label>Cliente: </label>
                                            <input name='valorCliente' required id='autocompleteCliente' type='text' class='form-control' >
                                            <input type="hidden" id="idCliente" name="idCliente" >
                                            </div>
                                        <div class="col-md-3">
                                               <input type="hidden" id="total" name="total"> 
                                        </div>
                                        
                                        <div class='col-md-3'>

                                        </div>   
                                        <div class='col-md-3'>

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
                                            <input type="hidden" id='cod' value=<?php echo $this->session->userdata('codigo') ?>>

                                            <table id="tbCompras" class="table table-bordered table-striped table-hover table-responsive">
                                                <thead>
                                                    <tr >
                                                    <?php if($this->session->userdata('codigo') == 1){?>
                                                                    <th class="col-md-1">Codigo.</th>
                                                    <?php } ?>        
                                                        <th class="col-md-1">Producto.</th>
                                                        <th class="col-md-1">Presentación.</th>
                                                        <th class="col-md-1">Precio Venta.</th>
                                                        <th class="col-md-1">Cantidad</th>
                                                        <th class="col-md-1">Importes</th>
                                                        <th class="col-md-1">Eliminar</th>
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
                                             <td class="col alert alert-success"><label id="total_sub" class=" pull-right">$</label></td>
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
                                        <table id="tbTotal" class="table">
                                             <tr>
                                             <td>SUBTOTAL:</td>
                                             <td id="sub_total" >$</td>
                                             </tr>
                                             <tr>
                                             <td class="alert alert-success">TOTAL:</td>
                                             <td id="total_sub" class="alert alert-success">$</td>
                                             </tr>
                                        </table>
                                    </div>                               
                                </div>
                            </div>
                    </div> -->
    </div>
</div>


<script src="<?php echo base_url();?>assets/js/adminJS/salidas.js"></script>