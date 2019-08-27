
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Buscar Compras</h4>
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
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" class="form-control" action="<?php echo base_url();?>movimientos/entradas/getResultados" id="formFechas">
                                        <div class="input-group">
                                            <div class='col-md-3'>
                    
                                                    <label>Del:</label>
                                                    <?php if(!empty($fecha1)){ ?>
                                                        <input name='fecha_inicio' id='fecha_inicio' type="date" value="<?php echo $fecha1;?>" class='form-control' >
                                                        </div>
                                                        <div class='col-md-3'>
                                                        <label>Al:</label>
                                                        <input name='fecha_fin' id='fecha_fin' type="date" value="<?php echo $fecha2;?>" class='form-control' >
                                                        </div>
                                                    <?php } else { ?>
                                                        <input name='fecha_inicio' id='fecha_inicio' type="date" value="<?php echo date("Y-m-d");?>" class='form-control' >
                                                        </div>
                                                        <div class='col-md-3'>
                                                            <label>Al:</label>
                                                            <input name='fecha_fin' id='fecha_fin' type="date" value="<?php echo date("Y-m-d");?>" class='form-control' >
                                                        </div>
                                                    <?php }; ?>
                                                    
                                                <div class="col-md-2">
                                                    <br>
                                                    <button class="btn btn-outline-primary mb-3 btnIr" type="submit" >Ir</button>
                                                </div>
                                            </div>
                                                                  
                                        <div class="data-tables">
                                            <table id="example" class="table table-striped table-bordered" style="width:100%">

                                                    <thead>
                                                        <tr>
                                                            <th id="#">#</th>
                                                            <th>Fecha</th>
                                                            <th>Proveedor</th>
                                                            <th>Encargado</th>
                                                            <th>Total</th>
                                                            <th>Estado</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $cont = 0;?>
                                                        <?php if(!empty($entradas)):?>
                                                            <?php foreach($entradas as $entrada):?>
                                                            <?php $cont++;?>
                                                                <tr>
                                                                    <td><?php echo $entrada->id_entrada;?></td>
                                                                    <td><?php echo $entrada->fecha;?></td>
                                                                    <td><?php echo $entrada->id_proveedor;?></td>
                                                                    <td><?php echo $entrada->id_usuario;?></td>
                                                                    <td><?php echo "$ ".$entrada->total;?></td>
                                                                    <?php if($entrada->estado == 1){?>
                                                                        <td>
                                                                            <div class="alert alert-primary" role="alert">
                                                                            <strong>Activo</strong>
                                                                            </div>
                                                                        </td>
                                                                    <?php }else{?>
                                                                        <td>
                                                                            <div class="alert alert-danger" role="alert">
                                                                            <strong>Inactivo</strong>
                                                                        </td>
                                                                    <?php }?>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <?php $data = $entrada->id_entrada?>
                                                                            <button value="<?php echo $entrada->id_entrada;?>" type="button" class="btn btn-info btn-view-entrada" data-toggle="modal" data-target="#Modalview">
                                                                                <span span class="fa fa-search" style="color: #fff"></span>
                                                                            </button>
                                                                                <button name='eliminar' id="<?php echo $entrada->id_entrada;?>" type="button" class="btn btn-danger eliminar_data" data-toggle="modal" data-target="#eliminar" value="<?php echo $data;?>" >
                                                                                    <span class="fa fa-times" style="color: #fff"></span>
                                                                                </button>                                                                
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                    <?php endforeach;?>
                                                                <?php endif;?>
                                                    </tbody>
                                            </table>
                                                                    </div>
                                        </div>
                                </form>
                            </div>
                       </div>
                    </div>
                </div>

        <!-- main content area end -->

        <?php
    $this->load->view('layouts/alert');
    ?>

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
                                                        </div>
<script src="<?php echo base_url();?>assets/js/adminJS/entradas.js"></script>
<script>//Cargar de manera desc los datos de la tabla
$(window).load(function () {
    document.getElementById("#").click();     
});
</script>