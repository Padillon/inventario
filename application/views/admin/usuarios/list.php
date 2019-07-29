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
                            <h4 class="page-title pull-left">Usuarios</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Registros</span></li>
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
                                <h4 class="header-title">Lista - Usuarios</h4>
                                <button type="button" id="btnAgregar" class="btn btn-outline-primary mb-3" onclick="resete()" data-toggle="modal" data-target="#modalAgregar"> Agregar+</button>
                                <div class="data-tables">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">

                     <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Rol</th>
                                    <th>Usuario</th>
                                    <th>Correo</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $cont = 0;?>
                                <?php if(!empty($usuarios)):?>
                                    <?php foreach($usuarios as $usu):?>
                                    <?php $cont++;?>
                                        <tr>
                                            <td><?php echo $usu->id_usuario;?></td>
                                            <td><?php echo $usu->rol;?></td>
                                            <td><?php echo $usu->usuario;?></td>
                                            <td><?php echo $usu->correo;?></td>
                                            <?php if($usu->estado == 1){?>
                                                <td>
                                                <span class="badge badge-success">Activo</span>
                                                </td>
                                            <?php }else{?>
                                                <td>
                                                <span class="badge badge-danger">Inactivo</span>
                                                </td>
                                            <?php }?>
                                            <td>
                                            <div class="btn-group">
                                            <?php $data = $usu->id_usuario."*".$usu->rol."*".$usu->usuario."*".$usu->correo."*".$usu->estado;?>
                                                <button id="view<?php echo $cont;?>" type="button" onclick="viewCliente(<?php echo $cont;?>)" class="btn btn-info" data-toggle="modal" data-target="#modalView" value="<?php echo $data;?>">
                                                    <span class="fa fa-search" style="color: #fff"></span>
                                                </button>
                                                <button id="edit<?php echo $cont;?>" type="button" onclick="editCliente(<?php echo $cont;?>)"  class="btn btn-warning" data-toggle="modal" data-target="#modalEditar" value="<?php echo $data;?>">
                                                    <span span class="fa fa-pencil" style="color: #fff"></span>
                                                </button>
                                                <?php if($usu->estado == 1){?>
                                                    <button id="delete<?php echo $cont; ?>" onclick="usuarioDelete(<?php echo $cont; ?>)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_usuario" value="<?php echo $data;?>" >
                                                        <span class="fa fa-times" style="color: #fff"></span>
                                                    </button>
                                                <?php }else{?>
                                                    <button id="active<?php echo $cont; ?>" onclick="usuarioActive(<?php echo $cont; ?>)"  type="button" class="btn btn-success" data-toggle="modal" data-target="#activeUsuario" value="<?php echo $data;?>" >
                                                        <span class="fa fa-check" style="color: #fff"></span>
                                                    </button>
                                                <?php }?>
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
    <!-- page container area end -->
 <!-- Modal Agregar-->
 <div class="modal fade" id="modalAgregar">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form method="POST" action="<?php echo base_url();?>admin/usuarios/store">
                <div class='modal-header'>
                    <h5 class='modal-title'>Agregar</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <input name='id_usuario' id='id_usuario' type='hidden' class='form-control'>
                    <div class='form-group'><label>Nombre:</label>
                        <input name='nombre' id='nombre' type='text' class='form-control' ></div>
                                                    
                    <div class='form-group'><label>Correo:</label>
                        <input name='correo' id='correo' type='text' class='form-control' ></div>
                    <div class='form-group'>
                    <div>
                    <input name='cargo_actualE' id='cargo_actualE' type='hidden' class='form-control' ></div>
                    <label for="create_categoriaE">Cargo.</label>         
                                    <select name='cargoE' id='cargoE' class='form-control'  >
                                        <?php foreach($roles as $rol):?>
                                            <option value='<?php echo $rol->id_rol;?>'><?php echo $rol->nombre;?></option>
                                        <?php endforeach;?>
                                    </select>
                    </div>
                    <div class='form-group'><label>Password:</label>
                        <input name='passE' id='passE' type='password' class='form-control' ></div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='submit' id="btnGuardar" class='btn btn-primary'>Guardar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

    <!-- Modal View-->
    <div class="modal fade" id="modalView">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form method="POST">
                <div class='modal-header'>
                    <h5 class='modal-title'>Información</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
            
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='button' id="btnView" data-dismiss='modal' class='btn btn-primary'>Aceptar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modalEditar">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form method="POST" action="<?php echo base_url();?>admin/usuarios/update">
                <div class='modal-header'>
                    <h5 class='modal-title'>Editar</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <input name='id_usuarioE' id='id_usuarioE' type='hidden' class='form-control'>
                    <div class='form-group'><label>Nombre:</label>
                        <input name='nombreE' id='nombreE' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Correo:</label>
                        <input name='correoE' id='correoE' type='text' class='form-control' ></div>
                    <div class='form-group'>
                    <div>
                    <input name='cargo_actualE' id='cargo_actualE' type='hidden' class='form-control' ></div>
                    <label for="create_categoria">Cargo.</label>         
                                    <select name='cargo' id='cargo' class='form-control'  >
                                    <option value=''></option>
                                        <?php foreach($roles as $rol):?>
                                            <option value='<?php echo $rol->id_rol;?>'><?php echo $rol->nombre;?></option>
                                        <?php endforeach;?>
                                    </select>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='submit' id="btnEditar" class='btn btn-primary'>Guardar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

            <!-- Modal delete-->
            <div class="modal fade" id="delete_usuario">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Eliminar</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                               <form action="<?php echo base_url();?>admin/usuarios/delete" method="POST">
                                               <h4>Está seguro de eliminar este usuario?</H4>
                                               <input id="id_usuario_delete" name="id_usuario_delete" type="hidden" class="form-control" >
                                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Eliminar</button>
                                           </form> </div>
                                        </div>
                                    </div>
                                </div>
        
<!-- Modal active-->
<div class="modal fade" id="activeUsuario">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Activar</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                               <form action="<?php echo base_url();?>admin/usuarios/active" method="POST">
                                               <h4>Está seguro de activar este usuario?</H4>
                                               <input id="id_usuario_active" name="id_usuario_active" type="hidden" class="form-control" >
                                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success">Activar</button>
                                           </form> </div>
                                        </div>
                                    </div>
                                </div>

    <script src="<?php echo base_url();?>assets/js/adminJS/usuarios.js"></script>

