
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
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Lista - Movimientos.</h4>
                                <a href  calss="btn btn-outline-primary mb-3 movimiento" data-toggle="modal" data-target="#movimiento" class="btn btn-outline-primary mb-3" onclick="movimientoModal()">Movimiento +</a>
                                <div class="data-tables">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">

                     <thead  >
                                <tr>
                                    <th>#</th>
                                    <th>Fecha.</th>
                                    <th>Usuario.</th>
                                    <th>Transacción.</th>
                                    <th>Descripción.</th>
                                    <th>Producto.</th>
                                    <th>Cantidad.</th>
                                    <th>Precio.</th>
                                    <th>Total.</th>
                                    <th>Saldo.</th>
                                    <th>Opciones.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($kardex)):?>
                                    <?php foreach($kardex as $kar):?>
                                        <tr>
                                            <td><?php echo $kar->id_kardex;?></td>
                                            <td><?php echo $kar->fecha;?></td>
                                            <td><?php echo $kar->usuario;?></td>
                                            <td><?php echo $kar->movimiento;?></td>
                                            <td><?php echo $kar->descripcion;?></td>
                                            <td><?php echo $kar->producto;?></td>
                                            <td><?php echo $kar->cantidad;?></td>
                                            <td><?php echo $kar->precio;?></td>
                                            <td><?php echo $kar->total;?></td>
                                            <td><?php echo $kar->saldo;?></td>
                                            <td>
                                                  <div class="btn-group">
                                                <?php $data = $kar->id_entrada?>
                                                <button value="<?php echo $kar->id_entrada;?>" type="button" class="btn btn-info btn-view-entrada" data-toggle="modal" data-target="#Modalview">
                                                    <span span class="fa fa-search" style="color: #fff"></span>                                        
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
</div>
</div>

                       </div>
                     </div>
                </div>
            </div>


            </div>
        </div>
        <!-- main content area end -->
         <!-- Modal para movimiento-->
<div id='movimiento' class="modal fade bd-example-modal-lg" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ti-cabeza">Movimiento.</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class='modal-body'>
            <form action="<?php echo base_url();?>movimientos/kardex/addMovimiento" id="movimiento_form"method="POST">
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
                                                    <?php if ($mov->id_movimiento<=4) {
                                                        # code...
                                                    } else{?>
                                                    <option value='<?php echo $mov->id_movimiento;?>'><?php echo $mov->nombre;?></option>
                                                    <?php } ?>
                                                    <?php endforeach;?>
                                                </select>
                                        </div>
                                        <div class="col-md-12"> 
                                            <br>
                                         </div>    

                            <div class="col-md-12"> 
                                <label>Descripción del movimiento:</label>
                                <input name="descripcion" class="form-control" type="text" id="descripcion" require>
                            </div>
                            <div class="col-md-12"> 
                                            <br>
                                         </div>  

                            <div class="col-md-12">
                            <label class="col-form-control">Buscar Producto:</label>
                                            <div class="input-group">
                                                <input name="autocompleteProducto" class="form-control" type="text" id="autocompleteProducto">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-primary" id="btn-agregar-abast" type="button">Agregar</button>
                                                </div>
                                            </div>                         
                            </div>

                            <div class="col-md-12"> 
                                            <br>
                            </div>
                         <div class = "col-md-12">   
                                <table id="tbCompras" class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Código.</th>
                                                            <th>Nombre.</th>
                                                            <th>Cantidad.</th>
                                                            <th>Precio.</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>                               
                                                    </tbody>
                                                </table>                       
                        <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                        <button type='submite'class="btn btn-success">Aceptar</button>
                        </div></div> </form>
                </div>
        </div>
    </div>
  </div>
</div>


 <!-- Modal para asegurar la edicion-->
    <div class="modal fade" id="Modalview">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ti-cabeza">Informacion</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" data-dismiss="modal" class="btn btn-primary">Aceptar</button>
                                           </div>
                                        </div>
                                    </div>
    </div>

<!-- Modal Delete-->
<div class="modal fade" id="eliminar">
<div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ti-cabeza">Eliminar</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                               <form action="<?php echo base_url();?>movimientos/entradas/eliminar" method="POST">
                                               <h4 id="titulo">Está seguro de anular esta compra?</H4>
                                               <input id="id-entrada-delete" name="id-entrada-delete" type="hidden" class="form-control" >
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" id="g-edit" name="g-edit"class="btn btn-primary">Aceptar</button>
                                           </form> </div>
                                        </div>
                                    </div>
    </div>
    
<!-- Modal Active-->
<div class="modal fade" id="modalActive">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form class="form-control" id="formActive">
                <div class='modal-header'>
                    <h5 class='modal-title'>Activar</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <label>Nombre de la categoria</label>
                    <input name='nombreActive' id='nombreActive' type='text' class='form-control'>
                    <input name='idCategoriaActive' id='idCategoriaActive' type='hidden' class='form-control'>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='button' class='btn btn-primary' id="btnActive">Guardar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

    <!-- Modal Exito-->
<div class="modal fade" id="modalExito">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form class="form-control" id="formExito">
                <div class='modal-header'>
                    <h5 class='modal-title'>Exito!</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <label>La operación se realizo con exito</label>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-primary' data-dismiss='modal' id="btnExito">Aceptar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

<!-- Modal Error-->
<div class="modal fade" id="modalError">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form class="form-control" id="formError">
                <div class='modal-header'>
                    <h5 class='modal-title'>Error!</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <label>La operación no pudo compleatarse satisfactoriamente</label>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-primary' data-dismiss='modal' id="btnError">Aceptar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

    <script src="<?php echo base_url();?>assets/js/adminJS/kardex.js"></script>
