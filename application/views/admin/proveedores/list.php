
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
                            <h4 class="page-title pull-left">Proveedores</h4>
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
                                <h4 class="header-title">Lista - Proveedores</h4>
                                <button type="button" id="btnAgregar" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#modalAgregar"> Agregar+</button>
                                <div class="data-tables">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">

                     <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Empresa</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $cont = 0;?>
                                <?php if(!empty($proveedores)):?>
                                    <?php foreach($proveedores as $pro):?>
                                    <?php $cont++;?>
                                        <tr>
                                            <td><?php echo $pro->id_proveedor;?></td>
                                            <td><?php echo $pro->nombre;?></td>
                                            <td><?php echo $pro->empresa;?></td>
                                            <td><?php echo $pro->telefono;?></td>
                                            <?php if($pro->estado == 1){?>
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
                                                <?php $data = $pro->id_proveedor."*".$pro->nombre."*".$pro->empresa.
                                                    "*".$pro->telefono."*".$pro->estado; ?>
                                                <button id="view<?php echo $cont;?>" type="button" onclick="viewProveedor(<?php echo $cont;?>)" class="btn btn-info" data-toggle="modal" data-target="#modalView" value="<?php echo $data;?>">
                                                    <span class="fa fa-search" style="color: #fff"></span>
                                                </button>
                                                <button id="edit<?php echo $cont;?>" type="button" onclick="editProveedor(<?php echo $cont;?>)" class="btn btn-warning" data-toggle="modal" data-target="#modalEditar" value="<?php echo $data;?>">
                                                    <span span class="fa fa-pencil" style="color: #fff"></span>
                                                </button>
                                                <?php if($pro->estado == 1){?>
                                                    <button id="delete<?php echo $cont; ?>" onclick="deleteProveedor(<?php echo $cont; ?>)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" value="<?php echo $data;?>" >
                                                        <span class="fa fa-times" style="color: #fff"></span>
                                                    </button>
                                                <?php }else{?>
                                                    <button id="active<?php echo $cont; ?>" onclick="activeProveedor(<?php echo $cont; ?>)" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalActive" value="<?php echo $data;?>" >
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
    <?php
    $this->load->view('layouts/alert');
    ?>
    <!-- Modal Agregar-->
    <div class="modal fade" id="modalAgregar">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form method="POST" action="<?php echo base_url();?>mantenimiento/proveedores/store">
                <div class='modal-header'>
                    <h5 class='modal-title'>Agregar</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <div class='form-group'><label>Nombre:</label>
                        <input name='nombre' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Empresa: </label>
                        <input name='empresa' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Telefono:</label>
                        <input name='telefono' type='text' class='form-control' ></div>
                </div>
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
            <form method="POST" action="<?php echo base_url();?>mantenimiento/proveedores/update">
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
            <form method="POST" action="<?php echo base_url();?>mantenimiento/proveedores/update">
                <div class='modal-header'>
                    <h5 class='modal-title'>Editar</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <input name='idProveedor' id='idProveedor' type='hidden' class='form-control'>
                    <div class='form-group'><label>Nombre:</label>
                        <input name='nombre' id='nombre' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Empresa: </label>
                        <input name='empresa' id='empresa' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Telefono:</label>
                        <input name='telefono' id='telefono' type='text' class='form-control' ></div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='submit' id="btnEditar" class='btn btn-primary'>Guardar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

    <!-- Modal Delete-->
    <div class="modal fade" id="modalDelete">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form method="POST" action="<?php echo base_url();?>mantenimiento/proveedores/delete">
                <div class='modal-header'>
                    <h5 class='modal-title'>Eliminar</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <input name='idProveedorDelete' id='idProveedorDelete' type='hidden' class='form-control'>
                    <div class='form-group'><label>Nombre:</label>
                        <input name='nombreDelete' id='nombreDelete' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Empresa: </label>
                        <input name='empresaDelete' id='empresaDelete' type='text' class='form-control' ></div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='submit' id="btnDelete" class='btn btn-danger'>Eliminar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

    <!-- Modal Active-->
    <div class="modal fade" id="modalActive">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form method="POST" action="<?php echo base_url();?>mantenimiento/proveedores/active">
                <div class='modal-header'>
                    <h5 class='modal-title'>Activar</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <input name='idProveedorActive' id='idProveedorActive' type='hidden' class='form-control'>
                    <div class='form-group'><label>Nombre:</label>
                        <input name='nombreActive' id='nombreActive' type='text' class='form-control' ></div>
                    <div class='form-group'><label>Empresa: </label>
                        <input name='empresaActive' id='empresaActive' type='text' class='form-control' ></div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='submit' id="btnActive" class='btn btn-success'>Activar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

<script src="<?php echo base_url();?>assets/js/adminJS/proveedores.js"></script>