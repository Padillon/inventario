            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Kardex</h4>
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
<!--permisos ***************************************** -->
<?php if ($permisos->read!=1) {
    # code...
    redirect(base_url(),"dashboard");
}
$habilitado_insert ="disabled";
$habilitado_update="disabled";
$habilitado_delete="disabled";
$habilitado_edit = "disabled";

if ($permisos->update == 1) {
    $habilitado_update ="enabled";
}

if ($permisos->delete == 1) {
    $habilitado_delete = "enabled";
}
if ($permisos->insert == 1) {
    $habilitado_insert = "enabled";
}

if ($permisos->update == 1){
    $habilitado_edit = "enabled";
}

?>
<div class="main-content-inner">
                    <div class="row">
                        <!-- busqueda de producto -->
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="input-group">
                                        <div class="col-md-3">
                                        <a href  calss="btn btn-outline-primary mb-3 movimiento" data-toggle="modal" data-target="#movimiento" <?php echo $habilitado_insert?> class="btn btn-outline-primary mb-3" onclick="movimientoModal()">Movimiento +</a>
                                        </div>
                                        <div class="col-md-3">
                                        <a href  calss="btn btn-outline-primary mb-3 convertir" data-toggle="modal" data-target="#converitr" <?php echo $habilitado_insert?> class="btn btn-outline-primary mb-3">Convertir producto </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="<?php echo base_url();?>movimientos/kardex/buscar" class="btn btn-outline-primary mb-3">Buscar Producto</a>
                                        </div>
                                        <div class="col-md-3">
                                            <a id="btnReporte" class="btn btn-success" data-toggle="modal" onclick="movimientoModal()" data-target="#mdReporte">Reporte</a>
                                        </div>
                                    </div>


                                    <div class="data-tables">
                                            <table id="example" class="table table-striped table-bordered " style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Fecha</th>
                                                        <th>Tipo</th>
                                                        <th>Producto</th>
                                                        <th>Presentación</th>
                                                        <th>Descripción</th>
                                                        <th>Cantidad</th>
                                                        <th>Encargado</th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                <?php if($kardex != " "){ ?>
                                                     <?php foreach($kardex as $kar){ ?>
                                                     <tr>
                                                        <td><?php echo $kar->id_kardex;?></td>
                                                        <td><?php echo $kar->fecha;?></td>
                                                        <td><?php echo $kar->movimiento;?></td> 
                                                        <td><?php echo $kar->nombre;?></td>
                                                        <td><?php echo $kar->nombre_presentacion;?></td>
                                                        <td><?php echo $kar->descripcion;?></td>
                                                        <td><?php echo $kar->cantidad;?></td>
                                                        <td><?php echo $kar->usuario; ?></td> 
                                                    </tr>
                                                    <?php }; ?> 
                                                <?php }; ?> 
                                                </tbody>
                                            </table>
                                        </div> 
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
</div>


   <!-- Modal para movimiento-->
   <div id='movimiento' class="modal fade bd-example-modal-lg" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ti-cabeza">Movimiento.</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>

            <div class='modal-body'>
                <form action="<?php echo base_url();?>movimientos/kardex/addMovimiento" id="movimiento_form" method="POST">
                    <div class='row'>  
                        <div class="col-md-12 mt-4">
                            <div class='input-group'>
                                <div class="col-md-4">
                                    <label>Fecha:</label>
                                    <input name='fecha' type="date" value="<?php echo date("Y-m-d");?>" class='form-control' >
                                </div>
                                <div class="col-md-4">
                                    <label for="id_movimiento">Movimientos: </label>         
                                    <select name='id_movimiento' id='id_movimiento' class='custom-select' required>
                                        <?php foreach($movimientos as $mov):?>
                                                <?php if ($mov->id_movimiento >4) {?>
                                                 <option value='<?php echo $mov->id_movimiento."*".$mov->tipo_transaccion;?>'><?php echo $mov->nombre;?></option>
                                                   
                                               <?php }?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <!--  <div class='col-md-4'>
                                        <label>Cliente / Proveedor: </label>
                                        <input name='valorCliente' required id='autocompleteCliente' type='text' class='form-control' >
                                        <input type="hidden" id="idCliente" name="idCliente" >
                                        <input name='valorProveedor' required id='autocompleteProveedor' require type='hidden' class='form-control' >
                                        <input type="hidden" id="idProveedor" name="idProveedor" >
                                </div>
                                -->
                                <div class="col-md-12"> 
                                    <br>
                                </div>    
                                <div class="col-md-12"> 
                                    <label>Descripción del movimiento:</label>
                                    <input name="descripcion" class="form-control" type="text" id="descripcion" required>
                                </div>
                                <div class="col-md-12"> 
                                    <br>
                                </div>  
                                <div class="col-md-12">
                                <label class="col-form-control">Buscar Producto:</label>
                                    <div class="input-group">
                                        <input name="autocompleteProducto2" class="form-control" type="text" id="autocompleteProducto2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" id="btn-agregar-abast" type="button">Agregar</button>
                                        </div>
                                    </div>                         
                                </div>
                                <div class="col-md-12"> 
                                    <br>
                                </div>
                                <div class = "table-responsive-sm col-md-12"> 
                                
                                    <table  id="tbCompras" class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th class="col-md-1">Código</th>
                                                <th class="col-md-2">Nombre</th>
                                                <th class="col-md-2">Presentación</th>
                                                <th class="col-md-1">Precio</th>
                                                <th class="col-md-1">Cantidad</th>
                                                <th class="col-md-1">Importe</th>
                                                <th class="col-md-1">Fecha de caducidad</th>

                                                <th class="col-md-1">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>                               
                                        </tbody>
                                    </table>
                                    <table id="tbTotal" class="table table-striped  table-responsive table-bordered">
                                             <tr>
                                             <td class="alert alert-success">TOTAL:</td>
                                             <td class="col alert alert-success"><input type="hidden" id="total" name="total"> <label id="total_sub" class=" pull-right">$</label></td>
                                             </tr>
                                        </table>             
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                        <button type='button' onclick="validarFormulario()" class="btn btn-success">Aceptar</button>
                                    </div>
                            </div> 
                         </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal para conversion-->
<div id='converitr' class="modal fade bd-example-modal-lg" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ti-cabeza">Movimiento.</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>

            <div class='modal-body'>
                <form action="<?php echo base_url();?>movimientos/kardex/addConversion" id="tranformacion_form" method="POST">
                    <div class='row'>  
                        <div class="col-md-12 mt-4">
                            <div class='input-group'>
                                <div class="col-md-4">
                                    <label>Fecha:</label>
                                    <input name='fechaT' type="date" value="<?php echo date("Y-m-d");?>" class='form-control' >
                                </div>
                                <div class="col-md-12">
                                <br>
                                </div>
                               
                                <div class="col-md-6">
                                <label class="col-form-control">Buscar Producto origen:</label>
                                    <div class="input-group">
                                        <input name="autcocomplete_origen" required class="form-control" type="text" id="autcocomplete_origen">
                                        <input name="autcocomplete_origenValue"required class="form-control" type="hidden" id="autcocomplete_origenValue">
                                        
                                    </div>                         
                                </div>
                                <div class="col-md-6">
                                <label class="col-form-control">Buscar Producto destino:</label>
                                    <div class="input-group">
                                        <input name="autocomplete_destino" required class="form-control" type="text" id="autocomplete_destino">
                                        <input name="autocomplete_destinoValue" required class="form-control" type="hidden" id="autocomplete_destinoValue">
                                        
                                    </div>                         
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-control">Valor de origen:</label>
                                    <input name="can_origen" pattern='^[0-9]+' min='0' value= 0 required class="form-control" type="number" id="can_origen">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-control">Valor de equivalencia:</label>
                                    <input name="can_destino" pattern='^[0-9]+' min='0' value= 0  required class="form-control" type="number" id="can_destino">
                                </div>
                                <div class="col-md-12">
                                <br>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <p id="CantidadMax">Cantidad máxima de transformación:</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-control">Ingrese la cantidad a convertir:</label>
                                    <input name="cant_convert" pattern='^[0-9]+' min='0' required class="form-control" type="number" id="cant_convert">
                                </div>
                                <div class = "table-responsive-sm col-md-12"> 

                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                        <button type='button' onclick=inviarT() class="btn btn-success">Aceptar</button>
                                    </div>
                            </div> 
                         </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


 <!-- Modal para elegir Fechas-->
 <div class="modal fade" id="mdReporte">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ti-cabeza">Reporte</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-auto">
                    <label for="elegirMarca">Del:</label>        
                    <input type="date" class="form-control" id="fecha1" required>
                </div>
                <div class="col-md-auto">
                    <label for="elegirMarca">Al:</label>        
                    <input type="date" class="form-control" id="fecha2" required>
                </div>
                <div class='col-md-auto'>
                    <label class="col-form-control">Buscar Producto:</label>
                    <input class="form-control" type="text" id="autocompleteProducto3">
                    <input type="hidden" id="txtProducto"> 
                    <input type="hidden" id="txtPresenProducto"> 
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnResumen" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>


    <script src="<?php echo base_url();?>assets/js/adminJS/kardex.js"></script>
