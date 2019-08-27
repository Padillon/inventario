
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Salidas</h4>
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
                                <h4 class="header-title">Buscar - Salidas</h4>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class='col-md-3'>
                                            <form method="POST"  action="<?php echo base_url();?>movimientos/salidas/getResultados" id="formFechas">
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
                                            </form>
                                        </div>
                                </div>
                    <div class="data-tables">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                     <thead>
                                <tr>
                                <th id="#">#</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Encargado</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $cont = 0;?>
<?php if(!empty($salidas)):?>
    <?php foreach($salidas as $sal):?>
        <?php $cont++;?>
                                        <tr>
                                            <td><?php echo $cont?></td>
                                            <td><?php echo $sal->fecha;?></td>
                                            <td><?php echo $sal->nombre." ".$sal->apellido;?></td>
                                            <td><?php echo $sal->usuario;?></td>
                                            <td><?php echo "$ ".$sal->total;?></td>
                                            <?php if($sal->estado == 1){?>
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
                                                <?php $data = $sal->id_salida; ?>
                                                <button value="<?php echo $sal->id_salida;?>" type="button" class="btn btn-info btn-view-salida" data-toggle="modal" data-target="#modalView">
                                                    <span span class="fa fa-search" style="color: #fff"></span>
                                                </button>
                                                <button name='eliminar' id="<?php echo $sal->id_salida;?>" type="button" class="btn btn-danger eliminar_data" data-toggle="modal" data-target="#eliminar" >
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

<!-- Modal ver-->
<div class="modal fade" id="modalView">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form-control" id="formEditar">
                <div class='modal-header'>
                    <h5 class='modal-title'>Informacion</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                   
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>
                </div>
            </form>
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
                <form action="<?php echo base_url();?>movimientos/salidas/eliminar" method="POST">
                    <h4 id="titulo">Está seguro de anular esta venta?</H4>
                    <input id="id-salida-delete" name="id-salida-delete" type="hidden" class="form-control" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="g-edit" name="g-edit"class="btn btn-primary">Aceptar</button>
                </form> 
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/adminJS/salidas.js"></script>

<script>//Cargar de manera desc los datos de la tabla
$(window).load(function () {
    document.getElementById("#").click();     
});
</script>