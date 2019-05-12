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
                                <?php if(!empty($usuarios)):?>
                                    <?php foreach($usuarios as $usu):?>
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
                                                <?php $data = $usu->id_usuario."*".$usu->rol."*".$usu->usuario.
                                                    "*".$usu->correo;?>
                                                <button type="button" onclick="viewCliente(<?php echo $data;?>)" class="btn btn-info" data-toggle="modal" data-target="#modalView">
                                                    <span class="fa fa-search" style="color: #fff"></span>
                                                </button>
                                                <button id="edit<?php ?>" type="button" onclick="" class="btn btn-warning" data-toggle="modal" data-target="#modalEditar" value="<?php echo $data;?>">
                                                    <span span class="fa fa-pencil" style="color: #fff"></span>
                                                </button>
                                                <?php if($usu->estado == 1){?>
                                                    <button id="delete<?php  ?>" onclick=""type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" value="<?php echo $data;?>" >
                                                        <span class="fa fa-times" style="color: #fff"></span>
                                                    </button>
                                                <?php }else{?>
                                                    <button id="active<?php  ?>" onclick="activeCliente(<?php echo $cont; ?>)" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalActive" value="<?php echo $data;?>" >
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
            <form class="form-control" id="formAgregar" action="<?php echo base_url();?>mantenimiento/usuarios/store" method='POST'>
                <div class='modal-header'>
                    <h5 class='modal-title'>Agregar</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <div class='form-group'><label>Usuario:</label>
                        <input id="usuario" name='usuario' required type='text' class='form-control' ></div>
                    <div class='form-group'><label>Correo: </label>
                        <input id="correo" name='correo' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Rol:</label>
                    <select name='id_rol' id='id_rol' class='custom-select' required>
                                                    <?php foreach($roles as $rol):?>
                                                    <option value='<?php echo $rol->id_rol;?>'><?php echo $rol->nombre;?></option>
                                                    <?php endforeach;?>
                     </select>
                     </div>
                    <div class='form-group'><label>Contraseña:</label>
                        <input name="passwordU"  id="passwordU" name="password" type='password' class='form-control pass' ></div>
                    <div class='form-group'><label>Verifique contraseña:</label>
                        <input name="cfmPassword" id="cfmPassword" type='password' class='form-control pass' ></div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type="submit" id="btnGuardar" disabled="true" class='btn btn-primary'>Guardar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

    <!-- Modal View-->
    <div class="modal fade" id="modalView">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form class="form-control" id="formView">
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
            <form class="form-control" id="formEditar">
                <div class='modal-header'>
                    <h5 class='modal-title'>Editar</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <input name='idCliente' id='idCliente' type='hidden' class='form-control'>
                    <div class='form-group'><label>Nombre:</label>
                        <input name='nombre' id='nombre' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Apellidos: </label>
                        <input name='apellido' id='apellido' type='text' class='form-control' ></div>
                    <div class='form-group'><label>NIT:</label>
                        <input name='nit' id='nit' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Telefono:</label>
                        <input name='telefono' id='telefono' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Registro</label>
                        <input name='registro' id='registro' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Dirección:</label>
                        <input name='direccion' id='direccion' type='text' class='form-control' ></div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='button' id="btnEditar" class='btn btn-primary'>Guardar</button>
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
                    <input name='idClienteDelete' id='idClienteDelete' type='hidden' class='form-control'>
                    <div class='form-group'><label>Nombre:</label>
                        <input name='nombreDelete' id='nombreDelete' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Apellidos: </label>
                        <input name='apellidoDelete' id='apellidoDelete' type='text' class='form-control' ></div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='button' id="btnDelete" class='btn btn-danger'>Eliminar</button>
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
                    <input name='idClienteActive' id='idClienteActive' type='hidden' class='form-control'>
                    <div class='form-group'><label>Nombre:</label>
                        <input name='nombreActive' id='nombreActive' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Apellidos: </label>
                        <input name='apellidoActive' id='apellidoActive' type='text' class='form-control' ></div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='button' id="btnActive" class='btn btn-success'>Activar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

    <script src="<?php echo base_url();?>assets/js/adminJS/usuarios.js"></script>

