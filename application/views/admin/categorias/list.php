

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
                            <h4 class="page-title pull-left">Categorias</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Mantenimiento</span></li>
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
                                <h4 class="header-title">Lista - Categorias</h4>
                                <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#modalAgregar"> Agregar+</button>

                                <div class="data-tables">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">

                                    <thead  >
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $cont = 0;?>
                                    <?php if($categoria != " "){?>
                                        <?php foreach($categoria as $cat):?>
                                        <?php $cont++;?>
                                            <tr>
                                                <td><?php echo $cat->id_categoria;?></td>
                                                <td><?php echo $cat->nombre;?></td>
                                                <?php $data = $cat->id_categoria."*".$cat->nombre ?>
                                                <?php if($cat->estado == 1){?>
                                                    <td>
                                                    <span class="badge badge-success">Activo</span>
                                                    </td>
                                                    <td>
                                                    <div class="btn-group">
                                                    <button id="edit<?php echo $cont;?>" type="button" onclick="editCategoria(<?php echo $cont;?>)" class="btn btn-info" data-toggle="modal" data-target="#modalEditar" value="<?php echo $data;?>">
                                                        <span span class="fa fa-pencil" style="color: #fff"></span>
                                                    </button>
                                                        <button id="delete<?php echo $cont; ?>" onclick="deleteCategoria(<?php echo $cont; ?>)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" value="<?php echo $data;?>" >
                                                            <span class="fa fa-times" style="color: #fff"></span>
                                                        </button>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                            <?php }; ?>
                                                <?php endforeach; ?>
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
        <!-- main content area end -->
    <?php
    $this->load->view('layouts/alert');
    ?>
    <!-- Modal Agregar-->
    <div class="modal fade" id="modalAgregar">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form class="form-control" action="<?php echo base_url();?>mantenimiento/categorias/store" method="POST">
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
                    <button type='submit' class='btn btn-primary'>Guardar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modalEditar">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <form class="form-control" action="<?php echo base_url();?>mantenimiento/categorias/update" method="POST">
                <div class='modal-header'>
                    <h5 class='modal-title'>Editar</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <label>Nombre de la categoria</label>
                    <input name='editName' id='editName' type='text' class='form-control'>
                    <input name='idCategoria' id='idCategoria' type='hidden' class='form-control'>
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
            <form class="form-control" action="<?php echo base_url();?>mantenimiento/categorias/delete" method="POST">
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
                    <button type='submit' class='btn btn-danger' id="btnDelete">Borrar</button>
                </div>
            </form>
        </div>
     </div>
    </div>

<script src="<?php echo base_url();?>assets/js/adminJS/categorias.js"></script>
