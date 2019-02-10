
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
                            <h4 class="page-title pull-left">Clientes</h4>
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
                                <h4 class="header-title">Lista - Clientes</h4>
                                <button type="button" id="btnAgregar" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#modalCliente"> Agregar+</button>
                                <div class="data-tables">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">

                     <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Direccion</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $cont = 0;?>
                                <?php if(!empty($clientes)):?>
                                    <?php foreach($clientes as $cli):?>
                                    <?php $cont++;?>
                                        <tr>
                                            <td><?php echo $cli->id_cliente;?></td>
                                            <td><?php echo $cli->nombre;?></td>
                                            <td><?php echo $cli->apellido;?></td>
                                            <td><?php echo $cli->direccion;?></td>
                                            <?php if($cli->estado == 1){?>
                                                <td>
                                                    <div class="alert alert-primary" role="alert">
                                                    <strong>Activo</strong>
                                                    </div>
                                                </td>
                                            <?php }else{?>
                                                <td>
                                                    <div class="alert alert-danger" role="alert">
                                                    <strong>Inactivo</strong>
                                                    </div>
                                                </td>
                                            <?php }?>
                                            <td>
                                                <div class="btn-group">
                                                <?php $data = $cli->id_cliente."*".$cli->nombre."*".$cli->apellido.
                                                    "*".$cli->nit."*".$cli->telefono."*".$cli->registro."*".$cli->direccion."*".$cli->estado; ?>
                                                <button id="view<?php echo $cont;?>" type="button" onclick="viewCliente(<?php echo $cont;?>)" class="btn btn-info" data-toggle="modal" data-target="#modalCliente" value="<?php echo $data;?>">
                                                    <span class="fa fa-search" style="color: #fff"></span>
                                                </button>
                                                <button id="edit<?php echo $cont;?>" type="button" onclick="editCliente(<?php echo $cont;?>)" class="btn btn-warning" data-toggle="modal" data-target="#modalCliente" value="<?php echo $data;?>">
                                                    <span span class="fa fa-pencil" style="color: #fff"></span>
                                                </button>
                                                <?php if($cli->estado == 1){?>
                                                    <button id="delete<?php echo $cont; ?>" onclick="deleteCliente(<?php echo $cont; ?>)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCliente" value="<?php echo $data;?>" >
                                                        <span class="fa fa-times" style="color: #fff"></span>
                                                    </button>
                                                <?php }else{?>
                                                    <button id="active<?php echo $cont; ?>" onclick="activeCliente(<?php echo $cont; ?>)" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCliente" value="<?php echo $data;?>" >
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

    <!-- Modal Categorias-->
    <div class="modal fade" id="modalCliente">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">

        </div>
     </div>
    </div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/adminJS/clientes.js"></script>
