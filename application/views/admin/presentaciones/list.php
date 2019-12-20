

            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Presentaciones</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Mantenimiento</span></li>
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

if ($permisos->update == 1) {
    $habilitado_update ="enabled";
}

if ($permisos->delete == 1) {
    $habilitado_delete = "enabled";
}
if ($permisos->insert == 1) {
    $habilitado_insert = "enabled";
}

?>

<div class="main-content-inner">
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                            
                                <h4 class="header-title">Lista - Presentaciones</h4>
                                <div class="input-group">
                                    <div class="col-md-2">
                                         <button type="button" class="btn btn-outline-primary mb-3" <?php echo $habilitado_insert?> data-toggle="modal" data-target="#add"> Agregar+</button>
                                    </div>
                                </div>                           
                                <div class="data-tables">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                            
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Presentacion</th>
                                          
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php $cont = 0;?>
                                        <?php if(!empty($presentacion)):?>
                                            <?php  foreach($presentacion as $pre):?>
                                            <?php $cont++;?>
                                                <tr> 
                                                    <td><?php echo $cont;?></td>
                                                    <td><?php echo $pre->nombre;?></td>
                                                   
                                                    <?php $presentacionData = $pre->id_presentacion."*".$pre->nombre; ?>
                                                    <?php if($pre->estado == 1){?>
                                                    <td>
                                                        <span class="badge badge-success">Activo</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button id="up_presentacion<?php echo $cont; ?>" onclick="presentacionUpdate(<?php echo $cont; ?>)" <?php echo $habilitado_update ?> type="button" class="btn btn-warning btn-view-producto" data-toggle="modal" data-target="#edit_presentacion" value="<?php echo $presentacionData;?>">
                                                                <span span class="fa fa-pencil" style="color: #fff"></span>
                                                            </button>                           
                                                            <button id="del_presentacion<?php echo $cont; ?>" onclick="presentacionDelete(<?php echo $cont; ?>)" <?php echo $habilitado_delete ?> type="button" class="btn btn-danger btn-remove" data-toggle="modal" data-target="#delete_presentacion" value="<?php echo $presentacionData;?>" >
                                                                <span class="fa fa-times" style="color: #fff"></span>
                                                            </button>                  
                                                        </div>
                                                    </td>
                                                    <?php } ?>
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
    <?php
    $this->load->view('layouts/alert');
    ?>

        <!-- Modal add-->
            <div class="modal fade" id="add">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Agregar</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                        <form action="<?php echo base_url();?>mantenimiento/presentaciones/store" method="POST">
                            <div class='form-group'><label >Nombre de la presentacion.</label>
                            <input name="name" type="text" class="form-control" placeholder="Ingrese nombre"></div>
                            <div class='form-group'><label>Equivalencia en unidades:</label>
                            <input name='equi' id='equi' type='number' class='form-control' ></div>                               
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary"   >Guardar</button>
                        </form> 
                        </div>
                    </div>
                </div>
            </div>
        <!-- Modal delete-->
        <div class="modal fade" id="delete_presentacion">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Eliminar</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                               <form action="<?php echo base_url();?>mantenimiento/presentaciones/delete" method="POST">
                                               <h4>Está seguro de eliminar la presentacion?</H4>
                                               <input id="id_presentacion_delete" name="id_presentacion_delete" type="hidden" class="form-control" >
                                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Eliminar</button>
                                           </form> </div>
                                        </div>
                                    </div>
                                </div>

        <!-- Modal update-->
        <div class="modal fade" id="edit_presentacion">
            <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Actualizar</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo base_url();?>mantenimiento/presentaciones/update" method="POST">
                                <input id="id_presentacion_update" name="id_presentacion_update" type="hidden" class="form-control" >
                                <div class='form-group'><label>Nombre:</label>
                                <input id="nombre_presentacion_update" name="nombre_presentacion_update" class="form-control"></div>
                                <div class='form-group'><label>Equivalencia en unidades:</label>
                                <input name='equi_update' id='equi_update' type='number' class='form-control' ></div> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar cambio</button>
                            </form> 
                            </div>
                    </div>
            </div>
        </div>
</div>
</div>

<script src="<?php echo base_url();?>assets/js/adminJS/presentaciones.js"></script>

    
