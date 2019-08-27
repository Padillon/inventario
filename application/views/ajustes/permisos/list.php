            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Permisos</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Administración</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                         
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
                                <h4 class="header-title">Lista - Permisos</h4>
                                <div class="data-tables">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">

                     <thead  >
                                <tr>
                                    <th>#</th>
                                    <th>Menu.</th>
                                    <th>Rol.</th>
                                    <th>Leer.</th>
                                    <th>Insertar.</th>
                                    <th>Actualizar.</th>
                                    <th>Eliminar.</th>
                                    <th>Opciones.</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $cont = 0;?>
                                <?php if(!empty($permisos_list)):?>
                                    <?php foreach($permisos_list as $per):?>
                                    <?php $cont++;?>
                                        <tr>
                                            <td><?php echo $per->id_permiso;?></td>
                                            <td><?php echo $per->menu;?></td>
                                            <td><?php echo $per->rol;?></td>
                                            <td><?php //echo $permiso->read
                                                if ($per->read==0):?>
                                                    <span class ="fa fa-times"></span>

                                                <?php else: ?>
                                                    <span class ="fa fa-check"></span>

                                               <?php endif;?>
                                            </td>
                                            <td><?php //echo $permiso->read
                                                if ($per->insert==0):?>
                                                    <span class ="fa fa-times"></span>

                                                <?php else: ?>
                                                    <span class ="fa fa-check"></span>

                                               <?php endif;?>
                                            </td>
                                            <td><?php //echo $permiso->read
                                                if ($per->update==0):?>
                                                    <span class ="fa fa-times"></span>

                                                <?php else: ?>
                                                    <span class ="fa fa-check"></span>

                                               <?php endif;?>
                                            </td>
                                            <td><?php //echo $permiso->read
                                                if ($per->delete==0):?>
                                                    <span class ="fa fa-times"></span>

                                                <?php else: ?>
                                                    <span class ="fa fa-check"></span>

                                               <?php endif;?>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                <?php $data = $per->id_permiso.'*'.$per->menu.'*'.$per->rol.'*'.$per->read.'*'.$per->insert.'*'.$per->update.'*'.$per->delete; ?>
                                                <button  id="editar_permiso" wtype="button"  class="btn btn-warning modal_editar" data-toggle="modal" data-target="#modalEditar" onclick="modal_editar()" value="<?php echo $data;?>">
                                                    <span span class="fa fa-pencil" style="color: #fff"></span>
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

                       </div>
                     </div>
                </div>
            </div>
        <!-- main content area end -->

    <!-- Modal Agregar-->
    <div class="modal fade" id="modalAgregar">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form class="form-control" id="formAgregar">
                <div class='modal-header'>
                    <h5 class='modal-title'>Agregar</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <label>Nombre de la categoria</label>
                    <input name='name' id="name" type='text' class='form-control' placeholder='Ingrese nombre'>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='button' class='btn btn-primary' id="btnGuardar">Guardar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modalEditar">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form class="form-control" id="formEditar"  action="<?php echo base_url();?>ajustes/permisos/store" method='POST' >
                <div class='modal-header'>
                    <h5 class='modal-title' id="titulo_rol">Editar</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <label id="titulo_menu">Nombre de la categoria</label>
                    <div class="btn-group"> 
                                            <div><input type="hidden" id="id_permiso" name="id_permiso"></div>
                                            <label>Leer</label>                     
                                            <div class="s-swtich">                          
                                                <input type="checkbox" id="radio_leer" name="radio_leer" class="form-check-input condicion_leer" >
                                                <label for="radio_leer" class="form-check-label">Perecedero.</label>
                                            </div>
                                            <p>&ensp;&ensp;</p>

                                            <label>Insertar</label>                     
                                            <div class="s-swtich">                          
                                                <input type="checkbox" id="radio_insertar" name="radio_insertar" class="form-check-input condicion_insertar" >
                                                <label for="radio_insertar" class="form-check-label">Perecedero.</label>
                                            </div>
                                            <p>&ensp;&ensp;</p>
                                                                              
                                            <label>Actualizar</label>                     
                                            <div class="s-swtich">                          
                                                <input type="checkbox" id="radio_actualizar" name="radio_actualizar" class="form-check-input condicion_actualizar" >
                                                <label for="radio_actualizar" class="form-check-label">Perecedero.</label>
                                            </div>
                                            <p>&ensp;&ensp;</p>
                                        
                                            <label>Eliminar</label>                     
                                            <div class="s-swtich">                          
                                                <input type="checkbox" id="radio_eliminar" name="radio_eliminar" class="form-check-input condicion_eliminar" >
                                                <label for="radio_eliminar" class="form-check-label">Perecedero.</label>
                                            </div>                                      
                        </div>                

                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='submit' class='btn btn-primary' id="btnEditar">Guardar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

<!-- Modal Delete-->
<div class="modal fade" id="modalDelete">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form class="form-control" id="formDelete">
                <div class='modal-header'>
                    <h5 class='modal-title'>Eliminar</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <label>Nombre de la categoria</label>
                    <input name='nombre' id='nombre' type='text' class='form-control'>
                    <input name='idCategoriaDelete' id='idCategoriaDelete' type='hidden' class='form-control'>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='button' class='btn btn-danger' id="btnDelete">Borrar</button>
                </div>
            </form>
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

<script src="<?php echo base_url();?>assets/js/adminJS/permisos.js"></script>
